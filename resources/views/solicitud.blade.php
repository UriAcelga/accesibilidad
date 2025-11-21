<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Universidad y Discapacidad</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js"></script>
</head>

<body class="w-screen h-screen bg-verde-azulado">
    <x-app-navbar :titulos="['Estudiantes', 'Solicitudes']" :titulosHrefUrl="[ route('home'),route('solicitud')]" selected="Solicitudes"></x-app-navbar>

    <div class=" lg-w-40% mx-auto mt-8">
        <form method="POST" action="#" class="w-2/3 mx-auto">
        @csrf
            <div class="mb-5">
                <label for="apellido" class="block mb-2 text-lg font-medium text-white ">Apellido:</label>
                <input type="text" id="apellido" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    placeholder="Apellido" maxlength="15"/>
            </div>
            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-lg font-medium text-white ">Nombre:</label>
                <input type="text" id="nombre" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    placeholder="Nombre" maxlength="30"/>
            </div>
            <div class="mb-5">
                <x-dropdown-badges
                    :facultades="$facultades"
                    prompt="Selecciona una facultad"
                    field_name="facultad"></x-dropdown-badges>
            </div>
            <div class="flex flex-col md:flex-row md:gap-x-4">

                <div class="mb-5 md:flex-1 min-w-0">
                <x-dropdown-interno
                        :facultades="$facultades"
                        prompt="Selecciona una carrera"
                        field_name="carrera"></x-dropdown-interno>
                    </div>
                <div class="mb-5 md:flex-1 min-w-0">
                    <x-dropdown-interno
                        :facultades="$facultades"
                        prompt="Selecciona un departamento"
                        field_name="departamento"
                        elements="departamentos"></x-dropdown-interno>
                </div>
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-lg font-medium text-white ">Correo Electrónico:</label>
                <input type="email" id="email" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    placeholder="tu_email@ejemplo.com" required />
            </div>
            <div class="mb-5">
                <label for="tel" class="block mb-2 text-lg font-medium text-white ">Nro. Telefónico:</label>
                <input type="tel" id="tel" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    required inputmode="numeric" maxlength="12"/>
            </div>
            <div class="mb-5">
                <label for="cud" class="block mb-2 text-lg font-medium text-white ">CUD:</label>
                <input type="number" id="cud" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    required inputmode="numeric" maxlength="10"/>
            </div>
            <div class="mb-5">
                <label for="apoyo" class="block mb-2 text-lg font-medium text-white ">Apoyo (opcional):</label>
                <textarea id="apoyo" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 font-source-code-pro text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    maxlength="4000" rows="5"></textarea>
            </div>
            <div class="mb-5">
                <label for="situacion" class="block mb-2 text-lg font-medium text-white ">Situación (opcional):</label>
                <textarea id="situacion" tabindex="0"
                class="bg-gray-50 border-2 border-gray-400 font-source-code-pro text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                maxlength="4000" rows="5"></textarea>
            </div>
            <div class="mb-5">
                <label for="descripcion" class="block mb-2 text-lg font-medium text-white ">Descripción (opcional):</label>
                <textarea id="descripcion" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 font-source-code-pro text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    maxlength="4000" rows="5"></textarea>
            </div>
            <div class="mb-5 flex justify-center">
                <button type="submit" tabindex="0"
                    class="text-white bg-coral hover:bg-coral-oscuro focus:ring-4 focus:outline-none focus:ring-blue-900 font-medium rounded-lg text-md w-5/6 sm:w-auto px-5 py-4 md:py-2.5 text-center">Inscribir alumno</button>
            </div>  
        </form>
    </div>
    <x-footer></x-footer>
</body>

</html>
