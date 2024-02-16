<x-app-layout>

  <div class="py-12">
    <div class="h-screen w-screen flex flex-col items-center justify-center">

      <h1 class="text-4xl">¡Gracias por realizar su compra!</h1>
    
      <div class="flex flex-col">

        @if (session('niubiz'))
      
          @php
              // $data = session('niubiz')['response'];
              $textDescription = session('niubiz')['textDescription'];
              $purchaseNumber = session('niubiz')['purchaseNumber'];
              $transactionTime = session('niubiz')['transactionTime'];
              $cardNumber = session('niubiz')['cardNumber'];
              $cardBrand = strtoupper(session('niubiz')['cardBrand']);
              $transactionAmount = session('niubiz')['transactionAmount'];
              $transactionCurrency = session('niubiz')['transactionCurrency'];
          @endphp

          <!-- Alert Tailwind -->
          <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ $textDescription }}</span>
          </div>

          <p class="mb-2"><b>Número de pedido: </b>{{ $purchaseNumber }}</p>
          <p class="mb-2"><b>Fecha y hora de pedido: </b>{{ now()->createFromFormat('ymdHis', $transactionTime)->format('d/m/Y H:i:s') }}</p>
          <p class="mb-2"><b>Tarjeta: </b>{{ $cardNumber }} - {{ $cardBrand }}</p>
          <p class="mb-2"><b>Importe pagado: </b>{{ $transactionAmount . ' ' . $transactionCurrency}}</p>

        @endif

      </div>

    </div>
  </div>
  
</x-app-layout>
