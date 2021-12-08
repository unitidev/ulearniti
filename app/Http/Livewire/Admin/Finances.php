<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Finances extends Component
{
    public $page; 
    
    public function render()
    {
        return view('livewire.admin.finances')
        ->layout('layouts.admin', ['page' => 'Welcome Admin', 'navigation' => 'Finances']);
    }

    public function mount()
    {
        
    }
}
