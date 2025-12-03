@php
    $estilosThTexto =
        'w-full h-full bg-azul-oscuro print:bg-transparent text-white print:text-black font-bold';
    $estilosThNum =
        'py-1 pl-2 pr-4 align-text-bottom text-left md:text-right bg-azul-oscuro print:bg-transparent text-white print:text-black font-bold';
    $estilosTdTexto =
        'py-1 pl-2 pr-4 align-text-bottom md:align-text-top text-left text-white print:text-black grid grid-cols-[8em_auto] gap-y-[1em] gap-x-[0.5em] md:block md:table-cell before:font-bold before:inline md:before:hidden print:bg-transparent';
    $estilosTdNum =
        'py-1 pl-2 pr-4 align-text-bottom md:align-text-top text-left md:text-right text-white print:text-black grid grid-cols-[8em_auto] gap-y-[1em] gap-x-[0.5em] md:block md:table-cell before:font-bold before:inline md:before:hidden print:bg-transparent';
    $estilosTdLink =
        'py-1 pl-2 pr-4 align-text-bottom md:align-text-top text-left md:text-center text-white print:text-black grid grid-cols-[8em_auto] gap-y-[1em] gap-x-[0.5em] md:block md:table-cell before:font-bold before:inline md:before:hidden print:bg-transparent';
    $estilosTr = 'print:!bg-transparent even:bg-azul-marino odd:bg-azul-marino-alterno print:border-b-1';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js"></script>
</head>

<body class="w-screen h-screen bg-verde-azulado print:text-sm print:bg-white print:text-black">
    <x-app-navbar :titulos="['Estudiantes', 'Solicitudes']" :titulosHrefUrl="[route('home'), route('solicitud')]" selected="Estudiantes"></x-app-navbar>
    {{-- Filtros de busqueda --}}
    <div
        class="w-5/6 lg:w-4/5 mx-auto flex mt-8 md:mt-12  print:m-0 font-roboto w-full border-2 rounded-lg border-azul-oscuro">
        <div class="h-full w-full flex flex-col">
            <span class="text-white w-full bg-azul-oscuro text-center text-lg">Filtros de búsqueda</span>
            <form method="GET" class="p-4 bg-azul-marino-alterno flex space-x-4">
                <div>
                    <label for="buscar" class="block mb-2 text-lg font-medium text-white">Buscar:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" name="filter[buscar]" value="{{ request('filter.buscar') }}"
                            placeholder="Buscar estudiante..."
                            class="block w-full h-12 pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="w-1/3">
                    <x-dropdown-badges :facultades="$facultades" prompt="Filtrar por Facultad"
                        field_name="filter[facultad.codigo]" label="Facultad"></x-dropdown-badges>
                </div>
                <div class="w-1/3">
                    <x-dropdown-interno :facultades="$facultades" prompt="Filtrar por Carrera" field_name="filter[carrera.id]"
                        label="Carrera"></x-dropdown-interno>
                </div>
                <button type="submit"
                    class="px-4 py-2 h-12 bg-coral text-white rounded-md hover:bg-coral-oscuro focus:outline-none focus:ring-2 focus:ring-coral">
                    Filtrar
                </button>
                <a href="{{ route('home') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Limpiar
                </a>
            </form>
        </div>
    </div>
    {{-- Listado de Estudiantes --}}
    <div role="region" aria-labelledby="Cap1" tabindex="0"
        class="w-5/6 lg:w-4/5 mx-auto flex flex-col pt-8 md:pt-12 print:m-0 font-roboto ">
        <table id="registros">
            <caption id="Cap1"
                class="text-lg pl-2 md:pl-0 md:ml-4 text-left md:text-center font-medium text-white print:text-black bg-azul-oscuro print:bg-transparent md:bg-transparent font-bold md:font-normal">
                Alumnos solicitantes de apoyo</caption>
            <tr class="hidden md:table-row print:border-b-2">
                <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="apellido" field="Apellido">
                </x-table-header-sorter>
                <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="nombre" field="Nombre">
                </x-table-header-sorter>
                <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="facultad_codigo" field="Facultad">
                </x-table-header-sorter>
                <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="carrera_id" field="Carrera">
                </x-table-header-sorter>

                
                
                @if (auth()->user()?->is_admin)
                    <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="email" field="Email">
                    </x-table-header-sorter>
                    <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="telefono" field="Nro. Telefónico">
                    </x-table-header-sorter>
                @endif
                <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="cud" field="CUD">
                </x-table-header-sorter>
                <x-table-header-sorter thstyles="{{ $estilosThTexto }}" :currentSort="request('sort')" sortby="created_at" field="Fecha Solicitud">
                </x-table-header-sorter>
                @if (auth()->user()?->is_admin)
                    <th colspan="2" class="{{ $estilosThTexto }}" scope="col" aria-sort="none">
                        Ficha Académica</th>
                @endif
            </tr>
            @foreach ($estudiantes as $estudiante)
                <tr class="{{ $estilosTr }}">
                    <td class="before:content-['Apellido:_'] {{ $estilosTdTexto }}">{{ $estudiante->apellido }}</td>
                    <td class="before:content-['Nombre:_'] {{ $estilosTdTexto }}">{{ $estudiante->nombre }}</td>
                    <td class="before:content-['Facultad:_'] {{ $estilosTdTexto }}">
                        {{ $estudiante->facultad->codigo }}</td>
                    <td class="before:content-['Carrera:_'] {{ $estilosTdTexto }}">{{ $estudiante->carrera->nombre }}
                    </td>
                    @if (auth()->user()?->is_admin)
                        <td class="before:content-['Email:_'] {{ $estilosTdTexto }}">{{ $estudiante->email }}</td>
                        <td class="before:content-['Teléfono:_'] {{ $estilosTdNum }}">{{ $estudiante->telefono }}</td>
                    @endif
                    <td class="before:content-['CUD:_'] {{ $estilosTdNum }}">{{ $estudiante->cud }}</td>
                    <td class="before:content-['Fecha_Solicitud:_'] {{ $estilosTdNum }}">
                        {{ $estudiante->created_at->format('d-m-Y') }}</td>
                    @if (auth()->user()?->is_admin)
                        <td class="before:content-['Modificar_Ficha_Académica:_'] {{ $estilosTdLink }}">
                            <a href="{{ route('seguimiento', $estudiante->id) }}"
                                class="underline text-yellow-300 print:text-black hover:text-yellow-600">modificar</a>
                        </td>
                        <td class="before:content-['Descargar_Ficha_Académica:_'] {{ $estilosTdLink }}">
                            <a href="{{ route('descargar', $estudiante->id) }}"
                                class="underline text-yellow-300 print:text-black hover:text-yellow-600">descargar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            <tr class="{{ $estilosTr }}">
                <td class="before:content-['Apellido:_'] {{ $estilosTdTexto }}">Gomez</td>
                <td class="before:content-['Nombre:_'] {{ $estilosTdTexto }}">Pepe</td>
                <td class="before:content-['Facultad:_'] {{ $estilosTdTexto }}">FCS</td>
                <td class="before:content-['Carrera:_'] {{ $estilosTdTexto }}">Licenciatura en Enfermería</td>
                @if (auth()->user()?->is_admin)
                    <td class="before:content-['Email:_'] {{ $estilosTdTexto }}">krugereffect@correo.com</td>
                    <td class="before:content-['Teléfono:_'] {{ $estilosTdNum }}">2664111111</td>
                @endif
                <td class="before:content-['CUD:_'] {{ $estilosTdNum }}">1010101010</td>
                <td class="before:content-['Fecha_Solicitud:_'] {{ $estilosTdNum }}">01-01-1990</td>
                @if (auth()->user()?->is_admin)
                    <td class="before:content-['Ficha_Académica:_'] {{ $estilosTdLink }}">
                        <a href="#"
                            class="underline text-yellow-300 print:text-black hover:text-yellow-600">modificar</a>
                    </td>
                    <td class="before:content-['Descargar_Ficha_Académica:_'] {{ $estilosTdLink }}">
                        <a href="#"
                            class="underline text-yellow-300 print:text-black hover:text-yellow-600">descargar</a>
                    </td>
                @endif
            </tr>
        </table>
        {{-- Mensaje si no hay registros --}}
        @if ($estudiantes->isEmpty())
            <span class="w-full bg-azul-marino text-center text-white text-lg">
                No hay estudiantes registrados con esos filtros.</span>
        @endif
        {{-- Paginación --}}
        @if ($estudiantes->hasPages())
            <div class="bg-azul-oscuro w-full border-t border-white">
                {{ $estudiantes->links() }}
            </div>
        @endif

    </div>
</body>

</html>
