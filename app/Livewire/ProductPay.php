<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;

class ProductPay extends Component
{

    public $product;
    public $paymentMethodSelected;

    protected $listeners = ['paymentMethodSelected' => 'render'];

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

    // Copy of 'PaymentMethods.php' -> Function explained in 'PaymentMethods.php' file
    public function addPaymentMethod($paymentMethodId) {

        auth()->user()->addPaymentMethod($paymentMethodId);
        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);

        $this->paymentMethodSelected = $paymentMethodId; // <-- To ensure that the inserted, will be the selected
        $this->purchaseProduct(); // <------------------------- And realize the buy automatically
        return redirect()->route('thanks'); // <--------------- And redirect to thanks page
    }

    public function render()
    {
        return view('livewire.product-pay', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods()
        ]);
    }
}
