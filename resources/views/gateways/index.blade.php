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

        <li> <!-- Izzy Pay-->
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://izzypay.hu/wp-content/uploads/2022/02/izzylogo.png" alt="IzzyPay logo">
          </button>
        </li>

        <li> <!-- Niubiz-->
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://capsource-bucket.s3.us-west-2.amazonaws.com/wp-content/uploads/2020/05/08180959/cropped-logo-niubiz.png" alt="Niubiz logo">
          </button>
        </li>

        <li> <!-- PayPal-->
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c530.png" alt="PayPal logo">
          </button>
        </li>

        <li> <!-- Mercadopago-->
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://metaverso-virtual.com/wp-content/uploads/2023/12/mercado-pago.png" alt="Mercadopago logo">
          </button>
        </li>

        <li> <!-- PayU-->
          <button class="w-full flex justify-center bg-gray-200 py-2 rounded-lg shadow-lg">
            <img class="h-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/PayU.svg/1200px-PayU.svg.png" alt="PayU logo">
          </button>
        </li>

      </ul>

    </div>

  </x-container>

</x-app-layout>