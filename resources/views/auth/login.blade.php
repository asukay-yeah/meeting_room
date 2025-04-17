<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/sofia-pro" rel="stylesheet">

</head>

<body class="font-[outfit]">
    <div class="flex justify-center items-center h-screen bg-white md:p-8">
        <div class="relative w-full h-full">
            <!-- Container untuk slideshow -->
            <div class="relative w-full h-full overflow-hidden md:rounded-xl">
                <div class="flex w-full h-full">
                    <img src="{{ asset('assets/expoert.png') }}" class="object-cover w-full h-full" alt="">

                </div>
            </div>

            <div class="absolute inset-0 bg-blue-900 opacity-40 md:rounded-xl"></div>

            <div class="card flex justify-center items-center absolute inset-0 w-full h-full">
                <div class="left md:w-[45%] md:h-full md:p-12 w-full h-full p-5">
                    <div class="w-full h-full bg-white rounded-lg">
                        <div class="flex w-full justify-center items-center flex-col">
                            <div class="flex justify-between md:pt-8 md:px-12 pt-5 px-5">

                                <img src="https://standar.sdmdigital.id/media/logos/logo_komdigi_horizontal_loading.png"
                                    class="h-full md:w-[28%] w-[35%]" alt="">
                                <img src="{{ asset('assets/balmon_logo.png') }}" class="h-full md:w-1/3 w-[40%]" alt="">


                            </div>
                            <div class="flex flex-col justify-center w-full px-10 md:p-10 md:mt-[12px] mt-6">
                                <div class="w-full flex justify-center md:justify-start">
                                    <img src="{{ asset('assets/icon.png') }}" class="w-auto md:h-20 h-14 mb-5 items-center">
                                </div>
                                <p class="text-center text-2xl font-normal md:leading-tight md:text-left md:text-3xl">
                                    REWEL BALMON</p>
                                <p class="mt-2 text-center md:text-base text-sm md:text-left text-gray-400">Welcome to Reservasi Waktu &
                                    Lokasi Meeting Balmon - Please login to
                                    your account.</p>
                                <hr class="border-t-1 border-gray-300 md:my-10 my-5">
                                <form class="flex flex-col items-stretch" action="{{ route('login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="flex flex-col">
                                        <label for="email"
                                            class="md:text-sm text-xs text-[#444444] font-normal mb-1 ml-1">Username</label>
                                        <div
                                            class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-800 border-gray-200 hover:border-blue-800">
                                            <input type="text" id="login-email" name="email"
                                                class="w-full flex-shrink appearance-none border-gray-700 bg-white py-2 px-4 md:text-base text-sm text-gray-600 placeholder-gray-300 focus:outline-none"
                                                placeholder="" />
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-col pt-4">
                                        <label for="password"
                                            class="md:text-sm text-xs text-[#444444] font-normal mb-1 ml-1">Password</label>
                                        <div
                                            class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-800 border-gray-200 hover:border-blue-800">
                                            <input type="password" id="login-password" name="password"
                                                class="w-full flex-shrink appearance-none bg-white py-2 px-4 md:text-base text-sm text-gray-600 placeholder-gray-300 focus:outline-none"
                                                placeholder="" />
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class=" w-full rounded-md bg-blue-800 px-4 py-2 mt-5 text-center md:text-base text-sm font-normal text-white hover:text-blue-800 shadow-md border border-blue-600 ring-blue-600 ring-offset-2 transition-colors duration-300 hover:bg-white focus:ring-2">Login</button>
                                </form>
                                <!-- <div class="text-center md:my-4 my-2">
                                    <p class="whitespace-nowrap font-normal text-gray-900 underline underline-offset-4 md:text-base text-sm">
                                        or</p>
                                </div>
                                <a href="register.html">
                                    <button type="submit"
                                        class="mt-2 w-full rounded-md bg-white px-4 py-2 text-center md:text-base text-sm font-normal text-blue-800 hover:text-white shadow-md border border-blue-600 ring-blue-600 ring-offset-2 transition-colors duration-300 hover:bg-blue-800 focus:ring-2">Register
                                    </button>
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>