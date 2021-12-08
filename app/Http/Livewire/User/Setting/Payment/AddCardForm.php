<?php

namespace App\Http\Livewire\User\Setting\Payment;

use Livewire\Component;

class AddCardForm extends Component
{
    public $name_on_card, $card_number, $cvv, $month, $year;

    public function render()
    {
        return view('livewire.user.setting.payment.add-card-form');
    }

    public function addCard()
    {
        
    }
}
