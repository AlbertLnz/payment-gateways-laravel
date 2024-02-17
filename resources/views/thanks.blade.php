<x-app-layout>

  <div class="py-12">
    <div class="h-screen w-screen flex flex-col items-center justify-center">

      <h1 class="text-4xl">¡Gracias por realizar su compra!</h1>
    
      <div class="flex flex-col">

        @if (session('niubizOK'))
      
          @php
              // $data = session('niubiz')['response'];
              $textDescription = session('niubizOK')['textDescription'];
              $purchaseNumber = session('niubizOK')['purchaseNumber'];
              $transactionTime = session('niubizOK')['transactionTime'];
              $cardNumber = session('niubizOK')['cardNumber'];
              $cardBrand = strtoupper(session('niubizOK')['cardBrand']);
              $transactionAmount = session('niubizOK')['transactionAmount'];
              $transactionCurrency = session('niubizOK')['transactionCurrency'];
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

        @if (request()->gateway === 'payu')
            
          <div class="p-4 my-4 bg-slate-200">

            <!-- Example from: https://developers.payulatam.com/latam/es/docs/integrations/webcheckout-integration/response-page.html -->
            <?php
              $ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
              $merchant_id = $_REQUEST['merchantId'];
              $referenceCode = $_REQUEST['referenceCode'];
              $TX_VALUE = $_REQUEST['TX_VALUE'];
              $New_value = number_format($TX_VALUE, 1, '.', '');
              $currency = $_REQUEST['currency'];
              $transactionState = $_REQUEST['transactionState'];
              $firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
              $firmacreada = md5($firma_cadena);
              $firma = $_REQUEST['signature'];
              $reference_pol = $_REQUEST['reference_pol'];
              $cus = $_REQUEST['cus'];
              $extra1 = $_REQUEST['description'];
              $pseBank = $_REQUEST['pseBank'];
              $lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
              $transactionId = $_REQUEST['transactionId'];
              
              if ($_REQUEST['transactionState'] == 4 ) {
                $estadoTx = "Transacción aprobada";
              }
              
              else if ($_REQUEST['transactionState'] == 6 ) {
                $estadoTx = "Transacción rechazada";
              }
              
              else if ($_REQUEST['transactionState'] == 104 ) {
                $estadoTx = "Error";
              }
              
              else if ($_REQUEST['transactionState'] == 7 ) {
                $estadoTx = "Pago pendiente";
              }
              
              else {
                $estadoTx=$_REQUEST['mensaje'];
              }
            
            if (strtoupper($firma) == strtoupper($firmacreada)) { ?>
              <h2 class="text-lg font-semibold">Resumen de la transacción</h2>
              <table>
                <tr>
                  <td>Estado de la transacción</td>
                  <td><?php echo $estadoTx; ?></td>
                </tr>
                <tr>
                <tr>
                  <td>ID de la transacción</td>
                  <td><?php echo $transactionId; ?></td>
                </tr>
                <tr>
                  <td>Referencia de venta</td>
                  <td><?php echo $reference_pol; ?></td>
                </tr>
                <tr>
                  <td>Referencia de la transacción</td>
                  <td><?php echo $referenceCode; ?></td>
                </tr>
                <tr>

                <?php if($pseBank != null) { ?>
                  <tr>
                    <td>cus </td>
                    <td><?php echo $cus; ?> </td>
                  </tr>
                  <tr>
                    <td>Banco </td>
                    <td><?php echo $pseBank; ?> </td>
                  </tr>
                <?php } ?>

                <tr>
                  <td>Valor total</td>
                  <td>$<?php echo number_format($TX_VALUE); ?></td>
                </tr>
                <tr>
                  <td>Moneda</td>
                  <td><?php echo $currency; ?></td>
                </tr>
                <tr>
                  <td>Descripción</td>
                  <td><?php echo ($extra1); ?></td>
                </tr>
                <tr>
                  <td>Entidad:</td>
                  <td><?php echo ($lapPaymentMethod); ?></td>
                </tr>
              </table>
            
            <?php
            }
            
            else{
              ?>
                <h1>Error validando la firma digital.</h1>
              <?php
            }
              ?>

          </div>
        
        @endif


      </div>

    </div>
  </div>
  
</x-app-layout>
