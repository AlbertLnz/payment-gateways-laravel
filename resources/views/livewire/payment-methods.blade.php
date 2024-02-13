<div>

    <section class="bg-white rounded shadow-lg">
        <div class="px-8 py-6">

            <h1 class="text-gray-700 text-lg font-semibold mb-4">Agregar método de pago</h1>

            <div class="flex">

                <p class="text-gray-600 mr-6">Información de tarjeta</p>

                <div class="flex-1">
                    <input id="card-holder-name" class="form-control mb-4" placeholder="Nombre del titular de la tarjeta">
 
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control"></div>
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
            const stripe = Stripe('stripe-public-key');
        
            const elements = stripe.elements();
            const cardElement = elements.create('card');
        
            cardElement.mount('#card-element');
        </script>
    @endpush

</div>
