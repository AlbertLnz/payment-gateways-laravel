<x-app-layout>

  <x-container class="mt-10">

    <div class="space-y-6">
      @foreach ($articles as $article)
          
        <div class="bg-white rounded shadow-lg">
          <img class="w-full h-40 object-cover object-center" src="{{ $article->image }}" alt="">

          <div class="px-6 py-4">

            <h1 class="font-semibold mb-2 text-xl">
              {{ $article->title }}
            </h1>

            {{ $article->extract }}
          </div>

        </div>

      @endforeach
    </div>

    <div class="py-8">
      {{ $articles->links() }}
    </div>

  </x-container>

</x-app-layout>