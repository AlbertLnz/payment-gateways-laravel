<x-app-layout>

  <x-container class="my-12">

    <h1 class="text-4xl font-semibold text-gray-700 mb-2">
      {{ $article->title }}
    </h1>

    <p class="text-lg text-gray-600 mb-4">
      {{ $article->extract }}
    </p>

    <figure>
      <img class="w-full h-80 object-cover object-center" src="{{ $article->image }}" alt="">
    </figure>

    <p class="text-base text-gray-600 mt-4">
      {{ $article->body }}
    </p>

  </x-container>

</x-app-layout>