<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;

class PageHeader extends Component
{
    public $title;
    public $subtitle;
    public $badge;

    public function mount($title = 'Default Title', $subtitle = '', $badge = '')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->badge = $badge;
    }

    public function render()
    {
        return view('livewire.frontend.components.page-header');
    }
}
