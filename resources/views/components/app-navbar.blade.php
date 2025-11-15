@props(['titulo' => 'Accesibilidad UNSL'])
<div class="w-full bg-white">
    <nav class="flex h-16 flex-wrap justify-between items-center border-b-2 border-coral">
        <img src="{{ asset('logo.png') }}" class="w-48 md:order-1" alt="logo">
        <x-logout-button :texto="Auth::user()->name"></x-logout-button>

        <h2 class="font-bold text-center text-3xl text-coral w-full md:w-auto md:order-2 m-4 md:m-0">{{ $titulo }}
        </h2>
    </nav>
</div>
