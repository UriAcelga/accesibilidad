@props(['titulos' => ['Accesibilidad UNSL'], 'titulosHrefUrl' => [false], 'selected' => 'Accesibilidad UNSL'])
<div class="w-full bg-white">
    <nav class="flex flex-col md:flex-row justify-between items-center border-b-2 border-coral space-y-4 md:space-y-0">
        <img src="{{ asset('logo.png') }}" class="w-2/5 md:w-48" alt="logo">
        <div class="flex flex-col md:flex-row h-full w-full md:w-1/2 items-center justify-center space-y-2 md:space-y-0 md:space-x-8">
            @for ($i = 0; $i < sizeof($titulos); $i++)
                @if ($titulosHrefUrl[$i])
                <a tabindex="0" href="{{$titulosHrefUrl[$i]}}" class="{{$selected === $titulos[$i] ? 'underline underline-offset-4 decoration-coral decoration-2' : ''}} order-3 md:order-2 font-bold text-center text-3xl text-coral w-full md:w-auto">{{ $titulos[$i] }}</a>
                @else
                <h2 class="{{$selected === $titulos[$i] ? 'underline underline-offset-4 decoration-coral decoration-2' : ''}} order-3 md:order-2 font-bold text-center text-3xl text-coral w-2/5 md:w-auto">{{ $titulos[$i] }}</h2>
                @endif                
            @endfor
                
        </div>
        <x-logout-button :texto="Auth::user()->name"></x-logout-button>
    </nav>
</div>
