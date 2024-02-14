<?php

namespace App\Livewire;

use Livewire\Component;

class ProductPay extends Component
{

    public $product;
    public $paymentMethodSelected;

    public function __construct() {
        $this->paymentMethodSelected = $this->getDefaultPaymentMethodProperty()->id; // At started, the value of $paymentMethodSelected will be the default payment method
    }

    // Computed property
    public function getDefaultPaymentMethodProperty() {
        return auth()->user()->defaultPaymentMethod();
    }

    public function render()
    {
        return view('livewire.product-pay', [
            'paymentMethods' => auth()->user()->paymentMethods()
        ]);
    }
}
