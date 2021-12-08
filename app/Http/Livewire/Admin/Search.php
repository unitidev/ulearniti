<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Search extends Component
{
    public $page;
    
    public function render()
    {
        return view('livewire.admin.search')
        ->layout('layouts.admin', ['page' => 'Welcome Admin', 'navigation' => 'Search']);
    }

    public function mount()
    {
        
    }
}
