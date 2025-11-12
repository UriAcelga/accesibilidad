<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen bg-verde-azulado font-roboto">
    <div class="content mx-auto flex flex-col pt-8 md:pt-12 w-4/5 md:w-2/3">
        <img src="{{ asset('logoBlanco.png') }}" class="w-full md:w-2/5 mx-auto" alt="logo">
        <form method="POST" action="{{ route('register')}}" class="w-full md:w-3/5 mx-auto">
            @csrf
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="bg-red-200 flex flex-row space-x-2 outline-red-800 outline-1 items-center">
                        <img src="{{ asset('icons/warning.svg')}}" class="w-8" ><span class="text-red-800">{{ $error }}</span>
                    </div>
                @endforeach
            @endif
            <fieldset class="mb-5">
                <legend for="rol" class="block text-lg font-medium text-white ">Tipo de Usuario:</label>
                    <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-8">
                        <div class="has-[:focus]:outline-2 has-[:focus]:outline-dotted">
                            <label for="usuario"><input type="radio" value="usuario" tabindex="0" name="rol"
                                    class="bg-gray-50" maxlength="30" checked required /><span
                                    class="ml-2 text-white">Usuario</span></label>
                        </div>
                        <div class="has-[:focus]:outline-2 has-[:focus]:outline-dotted">

                            <label for="ETA"><input type="radio" value="ETA" tabindex="0" name="rol"
                                    class="bg-gray-50 border-2" maxlength="30" /><span
                                    class="ml-2 text-white">ETA</span></label>
                        </div>
                    </div>
            </fieldset>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-lg font-medium text-white ">Nombre de usuario:</label>
                <input type="text" name="name" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    placeholder="Nombre de usuario" maxlength="40" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-lg font-medium text-white ">Contraseña: (mínimo 8 caracteres)</label>
                <input type="password" name="password" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    placeholder="Tu contraseña" maxlength="30" required />
            </div>
            <div class="mb-5">
                <label for="confirmpwd" class="block mb-2 text-lg font-medium text-white ">Confirmar Contraseña:</label>
                <input type="password" name="confirmpwd" tabindex="0"
                    class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5"
                    placeholder="Tu contraseña" maxlength="30" required />
            </div>
            <div class="mb-5 flex justify-center">
                <button type="submit" tabindex="0"
                    class="text-white bg-coral hover:bg-coral-oscuro focus:ring-4 focus:outline-none focus:ring-blue-900 font-medium rounded-lg text-md w-4/5 md:w-3/5 px-5 py-2.5 text-center">
                    <span class="shadow-2xl">Crear Nuevo Usuario</span></button>
            </div>
        </form>
        <div id="registro" class="w-full md:w-3/5 mx-auto pb-18">
            <div class="mb-5 flex flex-row justify-between">
                <div class="w-1/4 h-px bg-white my-4"></div>
                <span class="text-md text-white">Ya tenés una cuenta?</span>
                <div class="w-1/4 h-px bg-white my-4"></div>
            </div>
            <span></span>
            <div class="w-full flex justify-center">
                <a href="{{ route('inicio') }}" tabindex="0"
                    class="w-4/5 md:w-3/5 text-coral text-lg font-bold bg-white outline-2 outline-coral hover:bg-coral hover:text-white focus:bg-coral focus:text-white focus:ring-4 focus:outline-none focus:ring-blue-900 rounded-lg px-5 py-2.5 text-center inline-block transition duration-150 ease-in-out">
                    <span class="shadow-2xl">Iniciar Sesión</span>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
