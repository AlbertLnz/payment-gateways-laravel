<x-app-layout>

  <x-container class="py-10">
    

    <div class="flex items-center mb-8">

      <p class="font-semibold text-2xl">Monto a pagar:</p>

      <div class="text-2xl font-bold ml-2 text-blue-800 rounded-lg" role="alert">
        <span class="font-medium">100 USD</span>
      </div>

    </div>

    <div>

      <p class="font-semibold text-2xl mb-6">Seleccione un método de pago:</p>

      <ul class="space-y-6">

         <!-- IziPay-->
        <li x-data="{open: false}">
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg" x-on:click="open = !open">
            <img class="h-8" src="https://micuenta.izipay.pe/_nuxt/img/logo_reverse.8bcf6e9.png" alt="IziPay logo">
          </button>

          <div class="pt-6 pb-4 flex justify-center" x-show="open" style="display: none">

            {{-- Form: --}}
            <div class="kr-embedded" kr-form-token="{{ $iziPay_formToken }}">
              
              <div class="kr-pan"></div>
              <div class="kr-expiry"></div>
              <div class="kr-security-code"></div>

              <div class="kr-payment-button"></div>

              <div class="kr-form-error"></div>
            </div>

          </div>

        </li>

         <!-- Niubiz-->
        <li>
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://capsource-bucket.s3.us-west-2.amazonaws.com/wp-content/uploads/2020/05/08180959/cropped-logo-niubiz.png" alt="Niubiz logo">
          </button>
        </li>
        
        <!-- PayPal-->
        <li x-data="{open: false}">
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg" x-on:click="open = !open">
            <img class="h-8" src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c530.png" alt="PayPal logo">
          </button>

          <div class="pt-6 pb-4" x-show="open" style="display: none">

            <select>
              <option value="">Form</option>
              <option value="">Modal</option>
            </select>

          </div>

        </li>

         <!-- Mercadopago-->
        <li>
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://metaverso-virtual.com/wp-content/uploads/2023/12/mercado-pago.png" alt="Mercadopago logo">
          </button>
        </li>

         <!-- PayU-->
        <li>
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/PayU.svg/1200px-PayU.svg.png" alt="PayU logo">
          </button>
        </li>

      </ul>

    </div>

  </x-container>
  
  @push('iziPay')
    <script type="text/javascript"
            src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
            kr-public-key={{ config('services.izipay.public_key') }}
            kr-post-url-success="{{ route('paid.izipay') }}";>
    </script>
  
    <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon-reset.min.css">
  
    <script type="text/javascript" src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon.js"></script>
  @endpush

</x-app-layout>