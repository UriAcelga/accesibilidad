@props(['texto' => 'Usuario', 'texto_hover' => 'Cerrar Sesión', 'route' => route('logout')])

<a href="{{ route('logout') }}" tabindex="0"
    x-data="{
        es_hover: false,
        activar_hover() {
            this.es_hover = true
        },
        desactivar_hover() {
            this.es_hover = false
        },
    }"
    x-on:mouseenter="es_hover = true"
    x-on:mouseleave="es_hover = false"
    x-on:focus="es_hover = true"
    x-on:blur="es_hover = false"
    class="w-48 h-28 md:h-full flex items-center justify-end transition duration-300 ease-in-out text-coral"
    
    >
    <div class="relative w-48 h-full">
        <span class="font-bold text-xl text-right w-full absolute top-1/2 transform-gpu -translate-y-1/2 left-0">
            <span class="md:hidden">{{$texto_hover}} ({{$texto}})</span>
            <span class="hidden md:inline" x-text="es_hover ? '{{$texto_hover}}' : '{{$texto}}'"></span>
        </span>
    </div>
    <div class="relative w-12 h-full">
        <img src="{{ asset('icons/profile-circle-coral.svg') }}" class="w-full absolute top-1/2 -translate-y-1/2 left-0">
    </div>
</a>
