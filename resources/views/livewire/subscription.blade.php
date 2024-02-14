<div class="mb-6">
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Designed for business teams like yours</h2>
                <p class="mb-5 font-light text-gray-500 sm:text-xl">Description of my product</p>
            </div>
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                <!-- Pricing Card -->
                <div class="flex flex-col p-6 mx-auto min-w-80 max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow xl:p-8">
                    <h3 class="mb-4 text-2xl font-semibold">Starter</h3>
                    <p class="font-light text-gray-500 sm:text-lg">Description 1</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$9.99</span>
                        <span class="text-gray-500">/month</span>
                    </div>
                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            <span>Option 1.1</span>
                        </li>
                    </ul>

                    @if (auth()->user()->subscribedToPrice('price_1OjPZXC1gEKeiBoQR6tzFG81', 'Suscripciones blog'))
                        Suscrito
                    @else
                        
                        <x-button wire:click="newSubscription('price_1OjPZXC1gEKeiBoQR6tzFG81')" wire:target="newSubscription('price_1OjPZXC1gEKeiBoQR6tzFG81')" wire:loading.attr="disabled">
                            
                            <div class="justify-center" wire:target="newSubscription('price_1OjPZXC1gEKeiBoQR6tzFG81')" wire:loading>
                            
                                <!-- Spinner -->
                                <x-spinner size="4"/>
                            
                            </div>   
                            
                            Suscribirse
                        </x-button>

                    @endif

                </div>
                <!-- Pricing Card -->
                <div class="flex flex-col p-6 mx-auto min-w-80 max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow xl:p-8">
                    <h3 class="mb-4 text-2xl font-semibold">Company</h3>
                    <p class="font-light text-gray-500 sm:text-lg">Description 2</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$24.99</span>
                        <span class="text-gray-500">/3 months</span>
                    </div>
                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            <span>Option 2.1</span>
                        </li>
                    </ul>

                    @if (auth()->user()->subscribedToPrice('price_1OjPa3C1gEKeiBoQrc7V1ayY', 'Suscripciones blog'))
                       Suscrito 
                    @else
                        
                        <x-button wire:click="newSubscription('price_1OjPa3C1gEKeiBoQrc7V1ayY')" wire:target="newSubscription('price_1OjPa3C1gEKeiBoQrc7V1ayY')" wire:loading.attr="disabled">
                            
                            <div class="justify-center" wire:target="newSubscription('price_1OjPa3C1gEKeiBoQrc7V1ayY')" wire:loading>
                            
                                <!-- Spinner -->
                                <x-spinner size="4"/>
                            
                            </div>   
                            
                            Suscribirse
                        </x-button>

                    @endif


                </div>
                <!-- Pricing Card -->
                <div class="flex flex-col p-6 mx-auto min-w-80 max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow xl:p-8">
                    <h3 class="mb-4 text-2xl font-semibold">Enterprise</h3>
                    <p class="font-light text-gray-500 sm:text-lg">Description 3</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$79.99</span>
                        <span class="text-gray-500">/year</span>
                    </div>
                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            <span>Option 3.1</span>
                        </li>
                    </ul>

                    @if (auth()->user()->subscribedToPrice('price_1OjPaXC1gEKeiBoQ4CndZvpQ', 'Suscripciones blog'))


                        @if (auth()->user()->subscription('Suscripciones blog')->onGracePeriod()) <!-- Grace period -->
                            
                            <x-secondary-button wire:click="resumeSubscription" wire:target="resumeSubscription" wire:loading.attr="disabled">
                                
                                <div class="justify-center" wire:target="resumeSubscription" wire:loading>
                                
                                    <!-- Spinner -->
                                    <x-spinner size="4"/>
                                
                                </div>

                                Reanudar
                            </x-secondary-button>

                        @else
                            
                            <x-danger-button wire:click="cancelSubscription" wire:target="cancelSubscription" wire:loading.attr="disabled">

                                <div class="justify-center" wire:target="cancelSubscription" wire:loading>
                                
                                    <!-- Spinner -->
                                    <x-spinner size="4"/>
                                
                                </div>  

                                Cancelar

                            </x-danger-button>

                        @endif



                    @else
                        
                        <x-button wire:click="newSubscription('price_1OjPaXC1gEKeiBoQ4CndZvpQ')" wire:target="newSubscription('price_1OjPaXC1gEKeiBoQ4CndZvpQ')" wire:loading.attr="disabled">
                            
                            <div class="justify-center" wire:target="newSubscription('price_1OjPaXC1gEKeiBoQ4CndZvpQ')" wire:loading>
                            
                                <!-- Spinner -->
                                <x-spinner size="4"/>
                            
                            </div>   
                            
                            Suscribirse
                        </x-button>

                    @endif

                </div>
            </div>
        </div>
      </section>

<!-- SESSION VARIABLE -->
    {{-- @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "No tienes un método de pago registrado!",
            });
        </script>
    @endif --}}


<!-- DISPACH EVENT (LiveWire v3) -->
    @push('js')
        
        <script>

            Livewire.on('error', function (message) {

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: message,
                });

            });

        </script>

    @endpush
  
</div>