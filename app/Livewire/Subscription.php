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
        // dd($this->defaultPaymentMethod);

        if ($this->defaultPaymentMethod === null) { // means user hasn't a default payment

            // USING A VARIABLE SESSION:
            // session()->flash('error', 'No tienes una tarjeta de pago por defecto');

            // USING A EMIT (LiveWire v2) // DISPATCH (LiveWire v3) EVENT:
            $this->dispatch('error', '¡No tienes una tarjeta de pago por defecto!');

        }else{


            try {

                auth()->user()->newSubscription('Suscripciones blog', $planId)->create($this->defaultPaymentMethod->id);

                // EXPLICATIONS:
                // newSubscription('nameOfProduct', 'planId') <- If planId it's not inserted, it configure default plan from Stripe
                // create($this->defaultPaymentMethod->id) <---- Card selected will be the default card ('Predeterminado')  

            } catch (\Exception $e) {
                
                // Payment Method card rejected -> Enough founds, stolen...
                $this->dispatch('error', $e->getMessage());
            
            }
        }
    }

    public function render()
    {
        return view('livewire.subscription');
    }
}
