<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $page, $users, $instructors;
    
    public function render()
    {
        return view('livewire.admin.users')
        ->layout('layouts.admin', ['page' => 'Welcome Admin', 'navigation' => 'Users']);
    }

    public function mount()
    {
        $users = User::get();
    }
}
