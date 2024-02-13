<div>

    <section class="bg-white rounded shadow-lg">
        <div class="px-8 py-6">

            <h1 class="text-gray-700 text-lg font-semibold mb-4">Agregar método de pago</h1>

            <div class="flex">

                <p class="text-gray-600 mr-6">Información de tarjeta</p>

                <div class="flex-1" wire:ignore>
                    <input id="card-holder-name" class="form-control mb-4" placeholder="Nombre del titular de la tarjeta">
 
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control"></div>

                    <span id="card-error-message" class="text-red-600 text-sm mt-2"></span>
                </div>

            </div>
            
        </div>

        <footer class="px-8 py-6 bg-gray-50 border-t border-gray-200">

            <div class="flex justify-end">
                
                <!-- Using Button component from Jetstream -->
                <x-button id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </x-button>

            </div>

        </footer>

    </section>


    <!-- push to Stack JS  -->
    @push('js')
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

                } else {
                    // The card has been verified successfully...

                    console.log(setupIntent.payment_method)
                    @this.addPaymentMethod(setupIntent.payment_method)
                }
            });
        </script>

    @endpush

</div>
