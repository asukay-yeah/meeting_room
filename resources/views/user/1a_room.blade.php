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
        <button onclick="window.history.back()" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="font-medium">Back to Previous Page</span>
        </button>
    </div>
    <div class="w-full flex flex-col md:flex-row md:px-12">
        
        <div class="text-area w-full md:w-[40%] md:pr-10">
            <div class="flex items-center">
                <p class="text-3xl text-[#333333] mr-3 md:mt-5">1A Floor Room</p>
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
                <div id="calendarGrid" class="grid grid-cols-7 gap-1">
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
                    <h2 class="text-2xl font-medium text-gray-800">Booking Ruangan 1A</h2>
                    <p class="text-gray-500 mt-1 font-light">Floor Room Reservation</p>
                </div>
            
                <div class="space-y-5">
                    <!-- Baris pertama: Nama dan Tanggal berdampingan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div class="group">
                            <label for="booking-name" class="block text-sm font-normal text-gray-700 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" id="booking-name"
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
                                <input type="date" id="booking-date"
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
                        <label for="booking-needs" class="block text-sm font-normal text-gray-700 mb-2">Kebutuhan</label>
                        <div class="relative">
                            <textarea id="booking-needs" rows="3"
                                class="w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"></textarea>
                        </div>
                    </div>
            
                    <!-- Tombol konfirmasi dengan efek hover yang elegan -->
                    <div class="mt-8">
                        <button id="confirm-booking"
                            class="w-full bg-[#333333] hover:bg-[#222222] text-white py-3.5 rounded-lg transition-all duration-200 font-normal shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Konfirmasi Booking
                        </button>
                    </div>
                </div>
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
                    <span class="text-gray-800 font-normal">4 Guests</span>
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
                    <span class="text-gray-800 font-normal">2 Air Conditioner</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-gray-700" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M21.6618 12.705C21.4392 11.8723 21.0219 11.1044 20.4442 10.4647C19.8665 9.82495 19.145 9.33173 18.3392 9.02571C17.5334 8.71968 16.6663 8.60961 15.8096 8.70458C14.9529 8.79954 14.131 9.09682 13.4118 9.57189C13.3471 9.53346 13.2796 9.49689 13.2112 9.46408L14.7918 3.15283C14.8205 3.03859 14.8125 2.91823 14.7691 2.80873C14.7257 2.69923 14.6491 2.60612 14.5499 2.54252C13.9281 2.1458 13.232 1.87975 12.5041 1.76055C11.7762 1.64136 11.0316 1.67151 10.3157 1.84918C9.59981 2.02685 8.92754 2.34831 8.33981 2.79402C7.75208 3.23972 7.26118 3.80035 6.89698 4.44178C6.53277 5.08321 6.30288 5.79204 6.22129 6.52513C6.1397 7.25822 6.20812 8.00025 6.42238 8.70606C6.63664 9.41188 6.99227 10.0667 7.46762 10.6307C7.94297 11.1948 8.52811 11.6562 9.18743 11.9869V12C9.18743 12.0722 9.18743 12.1444 9.1968 12.2156L2.94087 14.0025C2.8272 14.0345 2.72647 14.1014 2.65294 14.1937C2.57941 14.2861 2.53681 14.3993 2.53118 14.5172C2.50359 15.2513 2.62504 15.9834 2.8882 16.6692C3.15135 17.3551 3.55075 17.9805 4.06229 18.5077C4.57382 19.035 5.18689 19.4531 5.86448 19.7369C6.54208 20.0206 7.27014 20.1641 8.00473 20.1587C8.73932 20.1534 9.4652 19.9992 10.1386 19.7055C10.8119 19.4118 11.4188 18.9848 11.9225 18.4501C12.4263 17.9154 12.8165 17.2842 13.0695 16.5945C13.3226 15.9049 13.4333 15.1711 13.3949 14.4375C13.4606 14.4 13.5252 14.3597 13.5881 14.3166L18.2634 18.8438C18.3483 18.9256 18.4568 18.9787 18.5736 18.9956C18.6903 19.0124 18.8094 18.9921 18.914 18.9375C20.014 18.3669 20.886 17.4376 21.3857 16.3037C21.8854 15.1697 21.9828 13.8991 21.6618 12.7022V12.705ZM10.3124 12C10.3124 11.6663 10.4114 11.34 10.5968 11.0625C10.7822 10.785 11.0458 10.5687 11.3542 10.441C11.6625 10.3132 12.0018 10.2798 12.3291 10.3449C12.6565 10.4101 12.9572 10.5708 13.1932 10.8068C13.4292 11.0428 13.5899 11.3435 13.655 11.6708C13.7201 11.9981 13.6867 12.3374 13.559 12.6458C13.4313 12.9541 13.215 13.2177 12.9375 13.4031C12.6599 13.5885 12.3337 13.6875 11.9999 13.6875C11.5524 13.6875 11.1232 13.5097 10.8067 13.1933C10.4902 12.8768 10.3124 12.4476 10.3124 12ZM7.31243 7.12502C7.3122 6.38528 7.50225 5.65793 7.86433 5.01286C8.2264 4.36779 8.74831 3.82671 9.37991 3.44162C10.0115 3.05652 10.7315 2.84036 11.4708 2.81393C12.2101 2.78749 12.9437 2.95165 13.6012 3.29064L12.1237 9.18752H11.9999C11.4588 9.18778 10.9293 9.34412 10.4749 9.63778C10.0204 9.93144 9.66031 10.35 9.43774 10.8431C8.78933 10.4633 8.25185 9.9201 7.87893 9.26769C7.50601 8.61528 7.31068 7.87649 7.31243 7.12502ZM10.1249 18.4969C9.48434 18.8678 8.75904 19.0676 8.01886 19.0771C7.27868 19.0865 6.54853 18.9053 5.89868 18.5508C5.24884 18.1963 4.70119 17.6805 4.30844 17.053C3.91569 16.4256 3.69106 15.7076 3.65618 14.9681L9.50524 13.2975C9.74266 13.7541 10.1008 14.1368 10.5407 14.404C10.9806 14.6711 11.4853 14.8124 11.9999 14.8125C12.0939 14.8127 12.1877 14.808 12.2812 14.7985C12.2762 15.5496 12.0746 16.2863 11.6962 16.9352C11.3179 17.5841 10.7762 18.1226 10.1249 18.4969ZM20.1468 16.2694C19.8025 16.8654 19.3203 17.3702 18.7406 17.7413L14.369 13.5113C14.6721 13.0377 14.8259 12.484 14.8104 11.9219C14.7948 11.3599 14.6107 10.8155 14.2818 10.3594C15.105 9.89325 16.0586 9.7107 16.9957 9.83988C17.9328 9.96906 18.8015 10.4028 19.4679 11.0743C20.1342 11.7457 20.5613 12.6177 20.6833 13.5558C20.8053 14.4939 20.6155 15.4461 20.1431 16.2656L20.1468 16.2694Z"
                                fill="black" />
                        </svg>
                    </div>
                    <span class="text-gray-800 font-normal">3 Fan</span>
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
                <img class="w-full object-cover rounded-[25px] md:rounded-[40px] md:h-[550px]" src="../../images/expoert.png" alt="">
                <div class="flex w-full md:py-5 py-3">
                    <img class="w-[48%] md:w-[49%] object-cover rounded-[16px] md:rounded-[30px] h-auto mr-[4%] md:mr-[2%]" src="../../images/expoert.png" alt="">
                    <img class="w-[48%] md:w-[49%] object-cover rounded-[16px] md:rounded-[30px] h-auto " src="../../images/expoert.png" alt="">
                </div>
                <img class="w-full object-cover rounded-[25px] md:rounded-[40px] md:h-[550px]" src="../../images/expoert.png" alt="">

            </div>
        </div>
    </div>
    <script src="{{ asset('js/floor-room.js') }}">

    </script>

</body>

</html>