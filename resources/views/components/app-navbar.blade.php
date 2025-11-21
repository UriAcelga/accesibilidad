@props(['titulos' => ['Accesibilidad UNSL'], 'titulosHrefUrl' => [false], 'selected' => 'Accesibilidad UNSL'])
<div class="w-full bg-white">
    <nav class="flex h-48 md:h-16 flex-wrap justify-between items-center border-b-2 border-coral">
        <img src="{{ asset('logo.png') }}" class="w-48 whitespace-nowrap" alt="logo">
        <div class="flex h-full w-1/2 items-center justify-center space-x-8">
            @for ($i = 0; $i < sizeof($titulos); $i++)
                @if ($titulosHrefUrl[$i])
                <a tabindex="0" href="{{$titulosHrefUrl[$i]}}" class="{{$selected === $titulos[$i] ? 'underline underline-offset-4 decoration-coral decoration-2' : ''}} order-3 md:order-2 font-bold text-center text-3xl text-coral w-full md:w-auto">{{ $titulos[$i] }}</a>
                @else
                <h2 class="{{$selected === $titulos[$i] ? 'underline underline-offset-4 decoration-coral decoration-2' : ''}} order-3 md:order-2 font-bold text-center text-3xl text-coral w-full md:w-auto">{{ $titulos[$i] }}</h2>
                @endif                
            @endfor
                
        </div>
        <x-logout-button :texto="Auth::user()->name"></x-logout-button>
    </nav>
</div>
