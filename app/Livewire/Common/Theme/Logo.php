<?php

namespace App\Livewire\Common\Theme;

use Livewire\Component;

class Logo extends Component
{
    public $url;

    public function mount($url = null)
    {
        // If no URL is passed, default to home
        $this->url = $url ?? route('home');
    }

    public function render()
    {
        return view('livewire.common.theme.logo');
    }
}