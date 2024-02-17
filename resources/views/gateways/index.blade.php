<x-app-layout>

  <x-container class="py-10">
    
    <!-- PAYMENT ERROR MESSAGE -->
    @if (session('niubizERROR'))

      @php
        // $data = session('niubizERROR')['response'];
        $message = session('niubizERROR')['message'];
      @endphp

      <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
        <span class="font-medium">ERROR - {{ $message }}</span>
      </div>
    @endif


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
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg" onclick="VisanetCheckout.open();">
            <img class="h-8" src="https://capsource-bucket.s3.us-west-2.amazonaws.com/wp-content/uploads/2020/05/08180959/cropped-logo-niubiz.png" alt="Niubiz logo">
          </button>
        </li>
        
        <!-- PayPal-->
        <li x-data="{open: false}">
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg" x-on:click="open = !open">
            <img class="h-8" src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c530.png" alt="PayPal logo">
          </button>

          <div class="pt-6 pb-4 flex justify-center" x-show="open" style="display: none">

            <div id="paypal-button-container"></div>

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
          <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
            <input name="merchantId"      type="hidden"  value="{{ config('services.payu.merchant_id') }}" >
            <input name="accountId"       type="hidden"  value="{{ config('services.payu.account_id') }}" >
            <input name="description"     type="hidden"  value="Método de pago a través de PayU" >
            <input name="referenceCode"   type="hidden"  value="{{ $payu_referenceCode_and_signature['referenceCode'] }}" >
            <input name="amount"          type="hidden"  value="{{ $payu_referenceCode_and_signature['amount'] }}" >
            <input name="tax"             type="hidden"  value="0"  > <!-- No tax -->
            <input name="taxReturnBase"   type="hidden"  value="0" > <!-- No tax -->
            <input name="currency"        type="hidden"  value="USD" >
            <input name="signature"       type="hidden"  value="{{ $payu_referenceCode_and_signature['signature'] }}"  >
            <input name="test"            type="hidden"  value="1" > <!-- 0: production / 1: test-->
            <input name="buyerEmail"      type="hidden"  value="{{ auth()->user()->email }}" >
            <input name="responseUrl"     type="hidden"  value="{{ route('thanks') }}?gateway=payu" > <!-- route: /thanks/gateway=payu-->
            <input name="confirmationUrl" type="hidden"  value="{{ route('paid.payu') }}" >
            <button name="Submit" type="submit" value="Enviar" class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
              <img class="h-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/PayU.svg/1200px-PayU.svg.png" alt="PayU logo">
            </button>
          </form>
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

  @push('jsNiubiz')
    <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>

    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function(event){

        const purchaseNumber = Math.floor(Math.random() * 1000);
        const amountValue = 100;

        VisanetCheckout.configure({
          sessiontoken: "{{ $niubiz_sessionToken }}",
          channel: 'web',
          merchantid: "{{ config('services.niubiz.merchant_id') }}",
          purchasenumber: purchaseNumber, // in this case, number random
          amount: amountValue,
          expirationminutes: '20', // 20 minutes
          timeouturl: " {{ route('web.home') }} ",  // redirect if 'expirationminutes' expire
          merchantlogo: 'img/comercio.png',  // default logo, platanitos logo
          formbuttoncolor: '#6875F5', // button color
          action: "{{ route('paid.niubiz') }}" + `?purchaseNumber=${purchaseNumber}` + `&amount=${amountValue}`, // POST route to validate the pay
          complete: function(params) {
            alert(JSON.stringify(params));
          }
        });
      })
    </script>

  @endpush

  @push('jsPaypal')
    <script src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}&currency=USD"></script>
    <script>
      window.paypal.Buttons({ 
        createOrder: function() {
          return axios.post("{{route('paid.paypal')}}", {
            amount: 100
          }).then(function(response) {
            return response.data.id
          }).catch(function(error){
            console.log(error)
          })
        },

        onApprove: function(data) {
          return axios.post(("/paid/capture-paypal-order"), {
            orderID: data.orderID
          }).then(function(response) {
            window.location.href = "{{route('thanks')}}"
          }).catch(function(error) {
            console.log(error)
          })

        }

      }).render("#paypal-button-container");
    </script>    
  @endpush
</x-app-layout>