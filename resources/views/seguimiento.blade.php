<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguimiento</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js"></script>
</head>

<body class="w-screen h-screen bg-verde-azulado text-white text-lg">
    <x-app-navbar :titulos="['<< Volver a estudiantes']" :titulosHrefUrl="[route('home')]" selected="<< Volver a estudiantes"></x-app-navbar>
    <div class="h-full md:h-5/6 flex justify-center flex-col-reverse md:flex-row">
        <section class="w-full md:w-1/2 my-10 md:my-0 flex items-center md:mx-2">
            <div x-data="{ activeTab: 'actualizar' }"
                class="w-full h-5/6 my-auto flex flex-col border border-white items-center justify-start">
                <ul role="tablist"
                    class="w-full md:h-1/6 flex flex-row font-bold items-center border-b border-white text-center">
                    <li role="none" class="w-1/2 h-full border-r border-white flex justify-center items-center">
                        <button type="button" id="actualizar-tab" class="h-full w-full" role="tab"
                            aria-controls="actualizar" tabindex="0" x-bind:aria-selected="activeTab === 'actualizar'"
                            x-on:click="activeTab = 'actualizar'"
                            :class="activeTab === 'actualizar' ? 'bg-white text-verde-azulado' :
                                'hover:bg-white focus:bg-white hover:text-verde-azulado focus:text-verde-azulado transition'"><span>Actualizar</span></button>
                    </li>
                    <li role="none"
                        class="w-1/2 h-full flex justify-center items-center hover:bg-white hover:text-verde-azulado focus:text-verde-azulado transition">
                        <button type="button" id="cerrar-tab" class="w-full h-full" role="tab"
                            aria-controls="cerrar" aria-selected="false" tabindex="0"
                            x-bind:aria-selected="activeTab === 'cerrar'" x-on:click="activeTab = 'cerrar'"
                            :class="activeTab === 'cerrar' ? 'bg-white text-verde-azulado' :
                                'hover:bg-white focus:bg-white hover:text-verde-azulado focus:text-verde-azulado transition'"><span>Cerrar</span></button>
                    </li>
                </ul>
                <div id="tab-content" class="w-full h-5/6">
                    <div class="w-full h-full" id="actualizar" role="tabpanel" aria-labelledby="actualizar-tab"
                        x-show="activeTab === 'actualizar'">
                        <div class="h-1/4 w-full border-b border-white text-center">
                            <span>NOTA: Efectuar el cambio realizará una actualización a la ficha del estudiante.
                                Quedará
                                registrado tanto el nombre del usuario de personal como la fecha de la
                                actualización.</span>
                        </div>
                        <div class="w-5/6 my-4 mx-auto">
                            <form action="{{route('actualizar', $id)}}" method="post">
                                @csrf
                                <label for="asunto">Asunto:</label>
                                <textarea name="asunto" tabindex="0"
                                    class="resize-none bg-gray-50 border-2 border-gray-400 font-source-code-pro text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                                    maxlength="4000" rows="5" required></textarea>
                                <div class="my-5 flex justify-center">
                                    <button type="submit" tabindex="0"
                                        class="text-white bg-coral hover:bg-coral-oscuro focus:ring-4 focus:outline-none focus:ring-blue-900 font-medium rounded-lg text-md w-5/6 sm:w-auto px-5 py-4 md:py-2.5 text-center">
                                        Nuevo asunto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="w-full" id="cerrar" role="tabpanel" aria-labelledby="cerrar-tab"
                        x-show="activeTab === 'cerrar'">
                        <div class="h-1/4 w-full border-b border-white text-center">
                            <span>IMPORTANTE: El cierre de la ficha es PERMANENTE. Una ficha cerrada ya no podrá
                                modificarse
                                por este medio.</span>
                        </div>
                        <div class="w-5/6 my-4 mx-auto">
                            <form action="{{route('cerrar', $id)}}" method="post">
                                @csrf
                                <label for="causa" class="">Causa de cierre:</label>
                                <textarea name="causa" tabindex="0"
                                    class="resize-none bg-gray-50 border-2 border-gray-400 font-source-code-pro text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                                    maxlength="4000" rows="5" required></textarea>
                                <div class="my-5 flex justify-center">
                                    <button type="submit" tabindex="0"
                                        class="text-white bg-coral hover:bg-coral-oscuro focus:ring-4 focus:outline-none focus:ring-blue-900 font-medium rounded-lg text-md w-5/6 sm:w-auto px-5 py-4 md:py-2.5 text-center">
                                        Cerrar Ficha</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <section class="w-full md:w-1/2 my-10 md:my-0 flex flex-col items-center justify-center">
            <a href="{{route('descargar', $id)}}" class="w-2/5 h-1/3 mx-auto my-8 border hover:bg-white focus:bg-white hover:text-verde-azulado focus:text-verde-azulado border-white flex flex-col items-center justify-center text-center"
                tabindex="0">
                <span class="text-xl font-bold my-2">Descargar Ficha</span>
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-10" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z">
                        </path>
                    </g>
                </svg>
            </a>
        </section>
    </div>
    <x-footer></x-footer>
</body>

</html>
