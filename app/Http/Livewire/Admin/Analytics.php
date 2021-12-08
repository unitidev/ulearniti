<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Analytics extends Component
{
    public $page;

    public function render()
    {
        return view('livewire.admin.analytics')
            ->layout('layouts.admin', ['page' => 'Welcome Admin', 'navigation' => 'Analytics']);
    }

    public function mount()
    {
        
    }
}
