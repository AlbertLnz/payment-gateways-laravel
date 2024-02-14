<div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">

        <div class="px-8 py-6">

            <div class="flex justify-between items-center mb-4">

                <h1 class="text-lg font-semibold text-gray-800">Método de pago</h1>

                <img class="h-8 " src="https://codersfree.com/img/payments/credit-cards.png" alt="">

            </div>

            <ul>

                @foreach ($paymentMethods as $paymentMethod)
                    
                    <li>
                        <label>
                            <input type="radio" name="paymentMethod" value="{{ $paymentMethod->id }}" wire:model="paymentMethodSelected" wire:click="$set('paymentMethodSelected', '{{ $paymentMethod->id }}')"> <!-- wire:model connected with: public $paymentMethodSelected; -->

                            {{ $paymentMethod->billing_details->name }}
                            (xxxx-xxxx-xxxx-{{ $paymentMethod->card->last4 }})

                        </label>
                    </li>

                @endforeach

            </ul>

            <p>selected: {{ $paymentMethodSelected }}</p>

        </div>
        
    </div>

</div>
