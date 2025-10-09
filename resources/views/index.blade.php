<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen bg-green-100">


    <form class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your email</label>
            <input type="email" id="email" tabindex="1"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg

                transition duration-300 ease-in-out 
                focus:ring-3 focus:ring-green-500/75 focus:border-green-500
                block w-full p-2.5"
                placeholder="marijo" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Your password</label>
            <input type="password" id="password" tabindex="2"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required />
        </div>
        <button type="submit" tabindex="3"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>
<script>
    /*Añadir un evento al ultimo elemento tabulable para que al terminar las tabulaciones se vuelva al primer elemento*/
</script>
</body>

</html>
