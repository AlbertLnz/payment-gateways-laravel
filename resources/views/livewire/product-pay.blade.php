<div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">

        <div class="px-8 py-6">

            <div class="flex justify-between items-center mb-4">

                <h1 class="text-lg font-semibold text-gray-800">Método de pago</h1>

                <img class="h-8" src="https://codersfree.com/img/payments/credit-cards.png" alt="">

            </div>

        
            <div class="my-8">
                <div>

                    <input id="card-holder-name" class="form-control mb-4" placeholder="Nombre del titular de la tarjeta">
    
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control"></div>
    
                    <span id="card-error-message" class="text-red-600 text-sm mt-2"></span>
    
                </div>
                    
                <!-- Using Button component from Jetstream -->
                <x-button class="w-full mt-4" id="card-button" data-secret="{{ $intent->client_secret }}" wire:target="addPaymentMethod" wire:loading.attr="disabled">
                    
                    <div class="justify-center" wire:target="addPaymentMethod" wire:loading>
                                
                        <!-- Spinner -->
                        <x-spinner size="4"/>
                    
                    </div> 
                    
                    Add Payment Method
                </x-button>
            </div>

        

            <ul class="my-8 space-y-2">

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

    <!-- push to Stack JS  -->
    @push('js')

        <script>

            Livewire.on('errorProduct', function (message) {

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: message,
                });

            });

        </script>

        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        
            const elements = stripe.elements();
            const cardElement = elements.create('card');
        
            cardElement.mount('#card-element');
        </script>

        <script>
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            
            cardButton.addEventListener('click', async (e) => {

                // Button disabled -> true
                cardButton.disabled = true

                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );
            
                if (error) {
                    // Display "error.message" to the user...

                    // console.log(error.message)
                    let span = document.getElementById('card-error-message')
                    span.textContent = error.message

                    // Button disabled -> false
                    cardButton.disabled = false

                } else {
                    // The card has been verified successfully...

                    // console.log(setupIntent.payment_method)
                    @this.addPaymentMethod(setupIntent.payment_method)
                                        
                    // Clean form
                    cardHolderName.value = ''
                    cardElement.clear()

                    // Button disabled -> false
                    cardButton.disabled = false
                }
            });
        </script>

    @endpush

</div>
