@props(['texto' => 'Usuario', 'texto_hover' => 'Cerrar Sesión', 'route' => route('logout')])

<a href="{{ route('logout') }}" tabindex="0"
    class="order-2 md:order-3 w-48 h-28 md:h-full whitespace-nowrap flex items-center justify-end hover:bg-coral focus:bg-coral text-coral hover:text-white focus:text-white transition duration-300 ease-in-out"
    x-data="{
        es_hover: false,
        activar_hover() {
            this.es_hover = true
        },
        desactivar_hover() {
            this.es_hover = false
        },
    }"
    x-on:mouseenter="activar_hover()"
    x-on:focus="activar_hover()"

    x-on:mouseleave="desactivar_hover()"
    x-on:blur="desactivar_hover()"
    >
    <div class="relative w-48 h-full">
        <span class="font-bold text-xl text-right w-full absolute top-1/2 transform-gpu -translate-y-1/2 left-0" x-show="! es_hover" x-transition >{{$texto}}</span>
        <span class="font-bold text-xl text-right w-full absolute top-1/2 transform-gpu -translate-y-1/2 left-0" x-show="es_hover" x-transition>{{$texto_hover}}</span>
    </div>
    <div class="relative w-12 h-full">
        <img src="{{ asset('icons/profile-circle-coral.svg') }}" class="w-full absolute top-1/2 transform-gpu -translate-y-1/2 left-0" x-show="! es_hover" x-transition>
        <img src="{{ asset('icons/profile-circle-blanco.svg') }}" class="w-full absolute top-1/2 transform-gpu -translate-y-1/2 left-0" x-show="es_hover" x-transition>
    </div>
</a>
