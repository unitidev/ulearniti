<?php

namespace App\Http\Livewire\Ui;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Nav extends Component
{
    public $auth;
    
    public function render()
    {
        return view('livewire.ui.nav');
    }

    public function mount()
    {
        $this->auth = Auth::user();
        //$user = User::where('id',Auth::id())->first();
        //$this->instructor = Auth::user()->instructor;
    }
}
