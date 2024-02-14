<x-app-layout>

  <x-container class="my-12">

    <div class="grid grid-cols-12 gap-8">

      <div class="col-span-7">

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

          <div class="px-8 py-6">

            <div class="flex">

              <figure>

                <img class="w-48 h-28 rounded object-cover object-center" src="{{ $product->image }}" alt="">
  
              </figure>

              <div class="flex-1 ml-4">

                <h1 class="text-xl text-gray-600 font-semibold">{{ $product->title }}</h1>
                <p class="text-md text-gray-500 font-semibold">{{ $product->price }} USD</p>
                
              </div>

            </div>

            <hr class="my-4"/>

            <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit debitis voluptas minus odio autem voluptatem voluptatum rem sapiente delectus repudiandae eos dolor sed eius accusamus eum tempore tenetur magni libero sequi fuga, cumque amet!</p>

          </div>

        </div>

      </div>

      <div class="col-span-5">

        @livewire('product-pay', ['product' => $product]) <!-- Pass a variable from Blade Page to LiveWire component -->

      </div>

    </div>

  </x-container>

</x-app-layout>