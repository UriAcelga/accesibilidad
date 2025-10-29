<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js"></script>
</head>

<body class="w-screen h-screen bg-verde-azulado">

    <div class=" lg-w-40% mx-auto">
        <form class="max-w-lg mx-auto">
            <div class="mb-5">
                <x-dropdown-badges
                    :facultades="$facultades"
                    prompt="Selecciona una facultad"
                    field_name="facultad"></x-dropdown-badges>
            </div>
            <div class="flex flex-row">

                <div class="mb-5 w-1/2">
                <x-dropdown-interno
                        :facultades="$facultades"
                        prompt="Selecciona una carrera"
                        field_name="carrera"></x-dropdown-interno>
                    </div>
                <div class="mb-5 w-1/2">
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
                <label for="cud" class="block mb-2 text-lg font-medium text-white ">CUD:</label>
                <input type="tel" id="cud" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    required inputmode="numeric" maxlength="12"/>
            </div>
            <div class="mb-5 flex justify-center">
                <button type="submit" tabindex="0"
                    class="text-white bg-coral hover:bg-coral-oscuro focus:ring-4 focus:outline-none focus:ring-blue-900 font-medium rounded-lg text-md w-5/6 sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </div>  
        </form>
    </div>
</body>

</html>
