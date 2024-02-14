<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;

class ProductPay extends Component
{

    public $product;
    public $paymentMethodSelected;

    // OPTION 1 -> Construct
    public function __construct() {
        $this->paymentMethodSelected = $this->getDefaultPaymentMethodProperty()->id; // At started, the value of $paymentMethodSelected will be the default payment method
    }

    // OPTION 2 -> Mount
    // public function mount() {
    //     $this->paymentMethodSelected = $this->getDefaultPaymentMethodProperty()->id; // At started, the value of $paymentMethodSelected will be the default payment method
    // }

    // Computed property
    public function getDefaultPaymentMethodProperty() {
        return auth()->user()->defaultPaymentMethod();
    }

    public function purchaseProduct() {

        try{

            auth()->user()->charge($this->product->price * 100, $this->paymentMethodSelected); // charge( price in cents, paymentMethodId )

            redirect()->route('thanks');

        }catch(Exception $e) {

            $this->addError('paymentMethodSelected', $e->getMessage());
            $this->dispatch('errorProduct', $e->getMessage());  // <-- Send error (English Version)

        }

    }

    public function render()
    {
        return view('livewire.product-pay', [
            'paymentMethods' => auth()->user()->paymentMethods()
        ]);
    }
}
