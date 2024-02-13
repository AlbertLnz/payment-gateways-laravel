<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethods extends Component
{
    
    public function addPaymentMethod($paymentMethod) {

        auth()->user()->addPaymentMethod($paymentMethod);

    }

    public function deletePaymentMethod($paymentMethodId) {
        
        // dd($paymentMethodId);
    
        auth()->user()->deletePaymentMethod($paymentMethodId);
    }


    public function render()
    {
        return view('livewire.payment-methods', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods()
        ]);
    }
}
