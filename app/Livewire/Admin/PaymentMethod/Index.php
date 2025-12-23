<?php

namespace App\Livewire\Admin\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $name, $slug, $type = 'manual', $account_number, $qr_code, $instruction;
    public $driver, $config = ['api_key' => '', 'api_secret' => '', 'mode' => 'sandbox'];
    public $status = 1, $sort_order = 0;

    public $existing_qr; // For edit mode display
    public $methodId;
    public $isEditMode = false;
    public $isOpen = false;

    // Table State
    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:payment_methods,slug,' . $this->methodId,
            'type' => 'required|in:manual,gateway',
            'account_number' => 'nullable|required_if:type,manual',
            'qr_code' => 'nullable|image|max:1024', // 1MB Max
            'driver' => 'nullable|required_if:type,gateway',
            'status' => 'required',
            'sort_order' => 'required|integer',
        ];
    }

    // Auto-generate slug when name changes
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetFields()
    {
        $this->reset([
            'name',
            'slug',
            'type',
            'account_number',
            'qr_code',
            'instruction',
            'driver',
            'config',
            'status',
            'sort_order',
            'methodId',
            'isEditMode',
            'existing_qr'
        ]);
        $this->status = 1;
        $this->type = 'manual';
        $this->config = ['api_key' => '', 'api_secret' => '', 'mode' => 'sandbox'];
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'account_number' => $this->account_number,
            'instruction' => $this->instruction,
            'driver' => $this->driver,
            'config' => $this->type === 'gateway' ? $this->config : null,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ];

        if ($this->qr_code) {
            $data['qr_code'] = $this->qr_code->store('payments', 'public');
        }

        if ($this->isEditMode) {
            PaymentMethod::find($this->methodId)->update($data);
            $this->dispatch('notify', message: 'Payment Method updated!', type: 'success');
        } else {
            PaymentMethod::create($data);
            $this->dispatch('notify', message: 'Payment Method created!', type: 'success');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $this->methodId = $id;
        $this->name = $method->name;
        $this->slug = $method->slug;
        $this->type = $method->type;
        $this->account_number = $method->account_number;
        $this->instruction = $method->instruction;
        $this->existing_qr = $method->qr_code;
        $this->driver = $method->driver;
        $this->config = $method->config ?? ['api_key' => '', 'api_secret' => '', 'mode' => 'sandbox'];
        $this->status = $method->status ? 1 : 0;
        $this->sort_order = $method->sort_order;

        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        PaymentMethod::find($id)->delete();
        $this->dispatch('notify', message: 'Method deleted!', type: 'danger');
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function render()
    {
        $methods = PaymentMethod::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.payment-method.index', ['methods' => $methods]);
    }
}
