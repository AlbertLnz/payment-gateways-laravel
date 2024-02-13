<?php

namespace App\Livewire;

use Livewire\Component;

class Subscription extends Component
{
    public function newSubscription($plan) {

        dd($plan);

    }

    public function render()
    {
        return view('livewire.subscription');
    }
}
