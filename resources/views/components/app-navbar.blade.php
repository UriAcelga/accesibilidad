@props(['titulo' => 'Accesibilidad UNSL', 'tituloHrefUrl' => false])
<div class="w-full bg-white">
    <nav class="flex h-48 md:h-16 flex-wrap justify-between items-center border-b-2 border-coral">
        <img src="{{ asset('logo.png') }}" class="w-48 whitespace-nowrap" alt="logo">
        @if ($tituloHrefUrl)
        <a tabindex="0" href="{{$tituloHrefUrl}}" class="order-3 md:order-2 font-bold text-center text-3xl text-coral w-full md:w-auto m-4 md:m-0">{{ $titulo }}</a>
        @else
        <h2 class="order-3 md:order-2 font-bold text-center text-3xl text-coral w-full md:w-auto m-4 md:m-0">{{ $titulo }}</h2>
        @endif
        <x-logout-button :texto="Auth::user()->name"></x-logout-button>
    </nav>
</div>
