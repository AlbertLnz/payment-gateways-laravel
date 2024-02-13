<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethods extends Component
{
    
    // Computed property
    public function getDefaultPaymentMethodProperty() {
        return auth()->user()->defaultPaymentMethod();
    }

    public function addPaymentMethod($paymentMethodId) {

        auth()->user()->addPaymentMethod($paymentMethodId);

        // return true when I DON'T HAVE a default payment method. I don't know why...
        // if (!auth()->user()->hasDefaultPaymentMethod()) {

        //     auth()->user()->updateDefaultPaymentMethod($paymentMethodId);

        // }

        // ALTERNATIVE --> The new payment Method, converts to the default
        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);
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
