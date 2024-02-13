<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethods extends Component
{
    
    // Computed property
    public function getDefaultPaymentMethodProperty() {
        return auth()->user()->defaultPaymentMethod();
    }

    public function addPaymentMethod($paymentMethod) {

        auth()->user()->addPaymentMethod($paymentMethod);

    }

    public function deletePaymentMethod($paymentMethodId) {
        
        // dd($paymentMethodId);
    
        auth()->user()->deletePaymentMethod($paymentMethodId);
    }

    public function defaultPaymentMethod($paymentMethodId) {

        // dd($paymentMethodId);

        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);

    }


    public function render()
    {
        return view('livewire.payment-methods', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods()
        ]);
    }
}
