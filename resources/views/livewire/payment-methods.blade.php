<div>

    <div class="bg-white rounded shadow-lg">
        <div class="px-8 py-6">

            <input id="card-holder-name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
 
            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>
            
            <button id="card-button" data-secret="{{ $intent->client_secret }}">
                Update Payment Method
            </button>

        </div>
    </div>


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
