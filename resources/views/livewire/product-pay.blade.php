<div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">

        <div class="px-8 py-6">

            <div class="flex justify-between items-center mb-4">

                <h1 class="text-lg font-semibold text-gray-800">Método de pago</h1>

                <img class="h-8 " src="https://codersfree.com/img/payments/credit-cards.png" alt="">

            </div>

            <ul class="mb-4">

                @foreach ($paymentMethods as $paymentMethod)
                    
                    <li>
                        <label>
                            <input type="radio" name="paymentMethod" value="{{ $paymentMethod->id }}" wire:model="paymentMethodSelected" wire:click="$set('paymentMethodSelected', '{{ $paymentMethod->id }}')"> <!-- wire:model connected with: public $paymentMethodSelected; -->

                            {{ $paymentMethod->billing_details->name }}
                            (xxxx-xxxx-xxxx-{{ $paymentMethod->card->last4 }})

                            @if ($this->defaultPaymentMethod->id == $paymentMethod->id)
                                        
                                <span class="ml-2 bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Predeterminado</span>

                            @endif

                        </label>
                    </li>

                @endforeach

            </ul>

            <x-danger-button wire:click="purchaseProduct" wire:target="purchaseProduct" wire:loading.attr="disabled">

                <div class="justify-center" wire:target="purchaseProduct" wire:loading>
                                
                    <!-- Spinner -->
                    <x-spinner size="4"/>
                
                </div> 
                
                Pagar

            </x-danger-button>

        </div>
        
    </div>

</div>
