<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        .loader {
            margin-top: 20px;
            position: relative;
            border-radius: 50%;
            border: 1px solid;
            width: 30px;
            height: 30px;
            color: #1b1b1b;
        }

        .loader::after {
            position: absolute;
            width: 0px;
            height: 10px;
            display: block;
            border-left: 1px solid #1b1b1b;
            content: '';
            left: 14px;
            border-radius: 1px;
            top: 4px;
            animation-duration: 1s;
        }

        .loader::before {
            position: absolute;
            width: 0px;
            height: 10px;
            display: block;
            border-left: 1px solid #1b1b1b;
            content: '';
            left: 14px;
            border-radius: 1px;
            top: 4px;
            animation-duration: 40s;
        }

        .loader::before,
        .loader::after {
            transform-origin: bottom;
            animation-name: dial;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes dial {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .calendar-day {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 3rem;
            width: 3rem;
            border-radius: 50%;
            font-weight: 400;
            font-size: 1rem;
            margin: 0.25rem auto;
            transition: background-color 0.2s;
        }

        .calendar-day:hover:not(.empty) {
            background-color: #f3f4f6;
        }

        .booked {
            background-color: #e0edff;
            color: #1e40af;
        }

        .today {
            background-color: #3b82f6;
            color: white;
        }

        .empty {
            visibility: hidden;
        }

        .month-title {
            font-size: 1.5rem;
            font-weight: 500;
        }

        .day-name {
            font-weight: 500;
            color: #6b7280;
            font-size: 1rem;
            padding: 0.5rem 0;
        }

        .nav-button {
            font-size: 1.5rem;
            padding: 0.5rem;
            font-weight: 300;
        }

        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            right: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        /* Pastikan ikon kustom tetap terlihat */
        .icon-container {
            z-index: 1;
            pointer-events: none;
        }

        @media (max-width: 767px) {
            .loader {
                margin-top: 0px;
            }

            .calendar-day {
                height: 2.5rem;
                width: 2.5rem;
            }
        }
    </style>
</head>

<body class="font-[outfit] p-6 lg:pt-6">
    <div class="w-full md:mb-4 mb-6">
        <a href="{{ url('user/home') }}"
            class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="font-medium">Back to Home</span>
        </a>
    </div>
    <div class="w-full flex flex-col md:flex-row md:px-12">

        <div class="text-area w-full md:w-[40%] md:pr-10">

            @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 w-fit">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4 w-fit">{{ session('error') }}</div>
            @endif

            <div class="flex items-center">
                <p class="text-3xl text-[#333333] mr-3 md:mt-5">{{ $room->name }}</p>
                <div class="loader"></div>
            </div>
            <p class="mt-1 text-[#555555] font-light">Balai Monitor Spektrum Frekuensi Radio Kelas I Jakarta</p>

            <div class="my-6">
                <!-- Header dengan bulan dan tahun serta tombol navigasi -->
                <div class="flex justify-between items-center mb-6">
                    <button id="prevMonth" class="nav-button p-2 hover:bg-gray-100 transition-colors">
                        &lt;
                    </button>
                    <h2 id="monthYearDisplay" class="month-title text-center"></h2>
                    <button id="nextMonth" class="nav-button p-2 hover:bg-gray-100 transition-colors">
                        &gt;
                    </button>
                </div>

                <!-- Grid untuk hari-hari dalam seminggu -->
                <div class="grid grid-cols-7 gap-1 mb-2">
                    <div class="day-name text-center">Min</div>
                    <div class="day-name text-center">Sen</div>
                    <div class="day-name text-center">Sel</div>
                    <div class="day-name text-center">Rab</div>
                    <div class="day-name text-center">Kam</div>
                    <div class="day-name text-center">Jum</div>
                    <div class="day-name text-center">Sab</div>
                </div>

                <!-- Grid untuk tanggal-tanggal -->
                <div id="calendarGrid" class="grid grid-cols-7 gap-1"
                    data-booked-dates="{{ json_encode($bookedDates) }}">
                    <!-- Calendar days will be inserted here via JavaScript -->
                </div>

                <!-- Legenda -->
                <div class="mt-6 mb-6 text-gray-600 flex items-center text-sm">
                    <div class="w-4 h-4 rounded-full bg-blue-100 mr-2"></div>
                    <span class="mr-6">Sudah dibooking</span>
                    <div class="w-4 h-4 rounded-full bg-blue-500 mr-2"></div>
                    <span>Hari ini</span>
                </div>
            </div>



            <div class="card-booking w-full mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                <div class="mb-6">
                    <h2 class="text-2xl font-medium text-gray-800">Booking {{ $room->name }}</h2>
                    <p class="text-gray-500 mt-1 font-light">Floor Room Reservation</p>
                </div>

                <form class="space-y-5" action="/user/rooms/{{ $room->id }}/book" method="POST">
                    {{ csrf_field() }}
                    <!-- Baris pertama: Nama dan Tanggal berdampingan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div class="group">
                            <label for="booking-name" class="block text-sm font-normal text-gray-700 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" id="booking-name" name="nama_kantor"
                                    class="w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-400 group-hover:text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="group">
                            <label for="booking-date" class="block text-sm text-gray-700 mb-2">Tanggal</label>
                            <div class="relative">
                                <input type="date" id="booking-date" name="booking_date"
                                    class="w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-400 group-hover:text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Baris kedua: Kebutuhan -->
                    <div class="group">
                        <label for="booking-needs"
                            class="block text-sm font-normal text-gray-700 mb-2">Kebutuhan</label>
                        <div class="relative">
                            <textarea id="booking-needs" rows="3" name="purpose"
                                class="w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"></textarea>
                        </div>
                    </div>

                    <!-- Tombol konfirmasi dengan efek hover yang elegan -->
                    <div class="mt-8">
                        <button id="confirm-booking" type="submit"
                            class="w-full bg-[#333333] hover:bg-[#222222] text-white py-3.5 rounded-lg transition-all duration-200 font-normal shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Konfirmasi Booking
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex flex-wrap justify-around my-6">
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-gray-800 font-normal">{{ $room->capacity }} Guests</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" viewBox="0 0 22 21"
                            fill="none">
                            <path
                                d="M21 9V1.6C21 1.44087 20.9368 1.28826 20.8243 1.17574C20.7117 1.06321 20.5591 1 20.4 1H1.6C1.44087 1 1.28826 1.06321 1.17574 1.17574C1.06321 1.28826 1 1.44087 1 1.6V9M21 9H1M21 9L20.21 11.584C20.0849 11.9936 19.8317 12.3523 19.4875 12.6072C19.1433 12.8621 18.7263 12.9998 18.298 13H17M1 9L1.79 11.584C1.91507 11.9936 2.16834 12.3523 2.51254 12.6072C2.85674 12.8621 3.27369 12.9998 3.702 13H5M17 5H18M8.5 12.5C8.5 12.5 8.5 19.5 5 19.5M13.5 12.5C13.5 12.5 13.5 19.5 17 19.5M11 12.5V19.5"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span class="text-gray-800 font-normal">{{ $room->ac }} Air Conditioner</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 100 100" width="40" height="40">
                            <g class="ldl-scale">
                                <g class="ldl-ani">
                                    <g class="ldl-layer">
                                        <g class="ldl-ani"
                                            style="transform-origin:50px 50px;transform:matrix(1.00333, 0, 0, 1.00333, 0, 0);animation-duration:1s;animation-timing-function:linear;animation-delay:-0.666667s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:forwards;animation-play-state:paused;animation-name:animate;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;transform-box:view-box;;animation:none">
                                            <path stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round"
                                                stroke-width="10" stroke="#323232" fill="none"
                                                d="M85.991 67.091H14.009A4.01 4.01 0 0 1 10 63.082V19.683a4.01 4.01 0 0 1 4.009-4.009H85.99a4.01 4.01 0 0 1 4.009 4.009v43.399a4.008 4.008 0 0 1-4.008 4.009z"
                                                style="stroke-width:3px;stroke:rgb(50, 50, 50);fill:none;;animation:none" />
                                        </g>
                                    </g>
                                    <g class="ldl-layer">
                                        <g class="ldl-ani"
                                            style="transform-origin:50px 50px;transform:matrix(0.935119, 0, 0, 0.935119, 0, 0);animation-duration:1s;animation-timing-function:linear;animation-delay:-0.833333s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:forwards;animation-play-state:paused;animation-name:animate;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;transform-box:view-box;;animation:none">
                                            <path d="M50 67.091v17.235" stroke-miterlimit="10" stroke-linejoin="round"
                                                stroke-linecap="round" stroke-width="10" stroke="#323232" fill="none"
                                                style="stroke-width:3px;stroke:rgb(50, 50, 50);fill:none;;animation:none" />
                                        </g>
                                    </g>
                                    <g class="ldl-layer">
                                        <g class="ldl-ani"
                                            style="transform-origin:50px 50px;transform:matrix(0.91, 0, 0, 0.91, 0, 0);animation-duration:1s;animation-timing-function:linear;animation-delay:-1s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:forwards;animation-play-state:paused;animation-name:animate;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;transform-box:view-box;;animation:none">
                                            <path d="M35.532 84.326h28.936" stroke-miterlimit="10"
                                                stroke-linejoin="round" stroke-linecap="round" stroke-width="10"
                                                stroke="#323232" fill="none"
                                                style="stroke-width:3px;stroke:rgb(50, 50, 50);fill:none;;animation:none" />
                                        </g>
                                    </g>
                                    <metadata xmlns:d="https://loading.io/stock/" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="text-gray-800 font-normal">{{ $room->screen }} </span>
                </div>
            </div>

            <!-- Room Description -->
            <div class="mb-4">
                <p class="text-gray-700 leading-relaxed text-justify">
                    Other Facility :
                </p>
            </div>

            <!-- Amenities -->
            <div class="grid grid-cols-2 gap-3 mt-6 md:mb-0 mb-10">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Comfortable</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Wi-Fi</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Bright Lights</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Large TV</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Mic</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Speaker</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Boardroom Table</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Whiteboard</span>
                </div>
            </div>
        </div>


        <div class="flex image-area w-full md:w-[60%] md:pl-10">
            <div class="w-full">
                <img class="w-full object-cover rounded-[25px] md:rounded-[40px] md:h-[550px]"
                    src="{{ asset('assets/expoert.png') }}" alt="">
                <div class="flex w-full md:py-5 py-3">
                    <img class="w-[48%] md:w-[49%] object-cover rounded-[16px] md:rounded-[30px] h-auto mr-[4%] md:mr-[2%]"
                        src="{{ asset('assets/expoert.png') }}" alt="">
                    <img class="w-[48%] md:w-[49%] object-cover rounded-[16px] md:rounded-[30px] h-auto "
                        src="{{ asset('assets/expoert.png') }}" alt="">
                </div>
                <img class="w-full object-cover rounded-[25px] md:rounded-[40px] md:h-[550px]"
                    src="{{ asset('assets/expoert.png') }}" alt="">

            </div>
        </div>
    </div>
    <script src="{{ asset('js/floor-room.js') }}">

    </script>

</body>

</html>