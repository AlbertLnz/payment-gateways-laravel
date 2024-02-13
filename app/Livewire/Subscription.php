<?php

namespace App\Livewire;

use Livewire\Component;

class Subscription extends Component
{

    // Computed property
    public function getDefaultPaymentMethodProperty() {
        return auth()->user()->defaultPaymentMethod();
    }

    public function newSubscription($planId) {

        // dd($planId);

        auth()->user()->newSubscription('Suscripciones blog', $planId)
            ->create($this->defaultPaymentMethod->id); 
        
        // EXPLICATIONS:
        // newSubscription('nameOfProduct', 'planId') <- If planId it's not inserted, it configure default plan from Stripe
        // create($this->defaultPaymentMethod->id) <---- Card selected will be the default card ('Predeterminado')
    }

    public function render()
    {
        return view('livewire.subscription');
    }
}
