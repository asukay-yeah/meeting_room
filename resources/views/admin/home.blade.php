<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

</head>

<body class="font-[outfit]">

    @include('component.sidebar')

    <div id="content" class="content-shifted transition-all duration-300 ease-in-out p-5 lg:pt-6">
        <div id="content-area">
            <div class="flex flex-col relative bg-white md:w-full w-full md:h-80 h-52">
                <div class="relative w-full h-full bg-red-400 rounded-xl">
                    <img class="w-full h-full object-cover rounded-xl" src="{{ asset('assets/expoert.png') }}" alt="">
                </div>
                <div class="absolute inset-0 bg-blue-900 opacity-40 rounded-xl"></div>

                <div class="absolute w-full h-full flex flex-col justify-between md:p-5 p-4">
                    <p class="text-white md:text-base text-sm">{{ Auth::user()->role}} / Dasboard</p>
                    <p class=" md:text-6xl text-[28px] leading-tight text-white drop-shadow-md">Reservasi Ruang
                        Rapat<br>Balmon Jakarta</p>
                </div>
            </div>
            <div class="flex w-full justify-between ">
                <p class="md:my-8 my-6 text-center md:text-[40px] text-2xl text-[#1b1b1b]">Status Ruang Rapat <span
                        class="text-blue-800">Hari Ini</span></p>
                <div class="flex items-center justify-center gap-2">
                    <!-- Simple Dashboard Stats Widgets -->
                    <div class="grid md:grid-cols-2 gap-4 mb-6 mt-6">
                        <!-- Total Request Widget -->
                        <div class="bg-white border border-stone-200 rounded-lg shadow-sm p-4">
                            <div class="flex items-center mb-2">
                                <i data-feather="bar-chart-2" class="h-5 w-5 text-blue-800 mr-2"></i>
                                <p class="text-[#1b1b1b] font-medium">Total Request</p>
                            </div>
                            <p class="text-2xl font-semibold text-[#1b1b1b]">{{ $totalRequest }}</p>
                        </div>

                        <!-- Rooms Booked Widget -->
                        <div class="bg-white border border-stone-200 rounded-lg shadow-sm p-4">
                            <div class="flex items-center mb-2">
                                <i data-feather="calendar" class="h-5 w-5 text-red-600 mr-2"></i>
                                <p class="text-[#1b1b1b] font-medium">Ruangan Dibooking Hari Ini</p>
                            </div>
                            <p class="text-2xl font-semibold text-[#1b1b1b]">{{ $totalBookToday }} <span
                                    class="text-sm font-normal text-neutral-500">dari {{ $totalRooms }} ruangan</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                @foreach($rooms as $room)
                <div
                    class="h-auto bg-white w-full md:py-4 md:px-6 py-3 px-4 border border-stone-200 rounded-lg shadow-[#44444420] shadow-lg md:mt-0 mt-10 ">
                    <div class="flex justify-between items-center">
                        <p class="font-medium md:text-xl text-base text-[#1b1b1b]">{{ $room->name }}</p>
                        @if($room->bookings->isEmpty())
                        <div class="kiri flex items-center text-[#1b1b1b]">
                            <div class="md:w-3 md:h-3 h-2 w-2 bg-green-600 rounded-full mr-2"></div>
                            <p class="md:text-base text-sm">Tersedia</p>
                        </div>
                        @else
                        <div class="kiri flex items-center text-[#1b1b1b]">
                            <div class="md:w-3 md:h-3 h-2 w-2 bg-red-600 rounded-full mr-2"></div>
                            <p class="md:text-base text-sm">Booked</p>
                        </div>
                        @endif
                    </div>
                    <img class="w-full md:h-60 h-32 object-cover md:my-3 my-2 rounded-md"
                        src="{{ asset('assets/expoert.png') }}" alt="">
                    <!-- <div class="flex justify-between px-1">
                        <a class="text-neutral-500 md:text-base text-sm hover:underline flex items-center">See Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div> -->
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        
    </script>
</body>

</html>