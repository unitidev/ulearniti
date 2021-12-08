<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class Plyr extends ModalComponent
{
    protected $listeners = [ 'setVideoUrl' ];
    public $uid;

    public function render()
    {
        return view('livewire.modals.plyr');
    }

    public function mount()
    {
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function setVideoUrl($uid)
    {
        $this->uid = $uid;
        $this->emit('mountVideo', $this->uid);
    }
}
