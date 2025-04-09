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
    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <style>
        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
        }
    </style>
</head>

<body class="font-[outfit]">
    
    @include('component.sidebar-user')

    <div id="content" class="content-shifted transition-all duration-300 ease-in-out p-5 lg:pt-6">
        <div id="content-area">
            <div class="flex flex-col relative bg-white md:w-full w-full md:h-80 h-52">
                <div class="relative w-full h-full bg-red-400 rounded-xl">
                    <img class="w-full h-full object-cover rounded-xl" src="{{ asset('assets/expoert.png') }}" alt="">
                </div>
                <div class="absolute inset-0 bg-blue-900 opacity-40 rounded-xl"></div>
        
                <div class="absolute w-full h-full flex flex-col justify-between md:p-5 p-4">
                    <p class="text-white md:text-base text-sm">Home / Dasboard</p>
                    <p class=" md:text-6xl text-[28px] leading-tight text-white drop-shadow-md">Reservasi Ruang Rapat<br>Balmon Jakarta</p>
                </div>
            </div>
            <p class="md:my-8 my-6 text-center md:text-4xl text-2xl text-[#1b1b1b]">Status Ruang Rapat <span class="text-blue-800">Hari Ini</span></p>
        
            <div class="card-area md:flex md:mt-8 mt-6">
                <a>
                    <div class="card h-auto bg-white md:w-1/2 w-full md:py-4 md:px-6 py-3 px-4 border border-stone-200 rounded-lg shadow-[#44444420] shadow-lg md:mr-10 ">
                        <div class="flex justify-between items-center">
                            <p class="font-medium md:text-xl text-base text-[#1b1b1b]">1A Floor Room</p>
                            <p class="text-neutral-400 md:text-sm text-xs">4 Seats</p>
                        </div>
                        <img class="w-full md:h-60 h-32 object-cover md:my-3 my-2 rounded-md" src="{{ asset('assets/expoert.png') }}" alt="">
                        <div class="flex justify-between px-1">
                            <div class="kiri flex items-center text-[#1b1b1b]">
                                <div class="md:w-3 md:h-3 h-2 w-2 bg-green-600 rounded-full mr-2"></div>
                                <p class="md:text-base text-sm">Tersedia</p>
                            </div>
                            <a class="text-neutral-500 md:text-base text-sm hover:underline flex items-center">See Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                  </svg>
                            </a>
                        </div>
                    </div>
                </a>
                
                <a>
                    <div class="card h-auto bg-white md:w-1/2 w-full md:py-4 md:px-6 py-3 px-4 border border-stone-200 rounded-lg shadow-[#44444420] shadow-lg md:mt-0 mt-10">
                        <div class="flex justify-between items-center">
                            <p class="font-medium md:text-xl text-base text-[#1b1b1b]">1B Floor Room</p>
                            <p class="text-neutral-400 md:text-sm text-xs">4 Seats</p>
                        </div>
                        <img class="w-full md:h-60 h-32 object-cover md:my-3 my-2 rounded-md" src="{{ asset('assets/expoert.png') }}" alt="">
                        <div class="flex justify-between px-1">
                            <div class="kiri flex items-center text-[#1b1b1b]">
                                <div class="md:w-3 md:h-3 h-2 w-2 bg-red-600 rounded-full mr-2"></div>
                                <p class="md:text-base text-sm">Booked</p>
                            </div>
                            <a class="text-neutral-500 md:text-base text-sm hover:underline flex items-center">See Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                  </svg>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="card-area md:flex mt-10">
                <a>
                    <div class="card h-auto bg-white md:w-1/2 w-full md:py-4 md:px-6 py-3 px-4 border border-stone-200 rounded-lg shadow-[#44444420] shadow-lg md:mr-10 ">
                        <div class="flex justify-between items-center">
                            <p class="font-medium md:text-xl text-base text-[#1b1b1b]">2rd Floor Room</p>
                            <p class="text-neutral-400 md:text-sm text-xs">4 Seats</p>
                        </div>
                        <img class="w-full md:h-60 h-32 object-cover md:my-3 my-2 rounded-md" src="{{ asset('assets/expoert.png') }}" alt="">
                        <div class="flex justify-between px-1">
                            <div class="kiri flex items-center text-[#1b1b1b]">
                                <div class="md:w-3 md:h-3 h-2 w-2 bg-green-600 rounded-full mr-2"></div>
                                <p class="md:text-base text-sm">Tersedia</p>
                            </div>
                            <a class="text-neutral-500 md:text-base text-sm hover:underline flex items-center">See Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                  </svg>
                            </a>
                        </div>
                    </div>
                </a>
                
                <a>
                    <div class="card h-auto bg-white md:w-1/2 w-full md:py-4 md:px-6 py-3 px-4 border border-stone-200 rounded-lg shadow-[#44444420] shadow-lg md:mt-0 mt-10">
                        <div class="flex justify-between items-center">
                            <p class="font-medium md:text-xl text-base text-[#1b1b1b]">3rd Floor Room</p>
                            <p class="text-neutral-400 md:text-sm text-xs">4 Seats</p>
                        </div>
                        <img class="w-full md:h-60 h-32 object-cover md:my-3 my-2 rounded-md" src="{{ asset('assets/expoert.png') }}" alt="">
                        <div class="flex justify-between px-1">
                            <div class="kiri flex items-center text-[#1b1b1b]">
                                <div class="md:w-3 md:h-3 h-2 w-2 bg-green-600 rounded-full mr-2"></div>
                                <p class="md:text-base text-sm">Tersedia</p>
                            </div>
                            <a class="text-neutral-500 md:text-base text-sm hover:underline flex items-center">See Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                  </svg>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Modified JavaScript for the dashboard
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();

            const hamburger = document.getElementById('hamburger');
            const hamburgerIcon = hamburger.querySelector('.hamburger-icon');
            const closeSidebar = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const content = document.getElementById('content');
            const menuItemsContainer = document.getElementById('menu-items-container');

            // Reserve Room Toggle Elements
            const reserveRoomToggle = document.getElementById('reserve-room-toggle');
            const floorOptions = document.getElementById('floor-options');

            // Settings Menu Elements
            const settingsButton = document.getElementById('settings-button');
            const settingsMenu = document.getElementById('settings-menu');

            // Toggle Floor Options
            reserveRoomToggle.addEventListener('click', function () {
                if (floorOptions.classList.contains('hidden')) {
                    floorOptions.classList.remove('hidden');
                    // Gunakan selector yang lebih umum, tidak hanya mencari data-feather
                    const chevronIcon = this.querySelector('i:last-child') ||
                        this.querySelector('svg:last-child');
                    if (chevronIcon) {
                        chevronIcon.classList.add('rotate-180');
                    }
                } else {
                    floorOptions.classList.add('hidden');
                    const chevronIcon = this.querySelector('i:last-child') ||
                        this.querySelector('svg:last-child');
                    if (chevronIcon) {
                        chevronIcon.classList.remove('rotate-180');
                    }
                }
                // Refresh icons jika diperlukan
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            });

            // Toggle Settings Menu
            settingsButton.addEventListener('click', function (e) {
                e.stopPropagation();
                settingsMenu.classList.toggle('hidden');
            });

            // Close settings menu when clicking elsewhere
            document.addEventListener('click', function (e) {
                if (!settingsButton.contains(e.target) && !settingsMenu.contains(e.target)) {
                    settingsMenu.classList.add('hidden');
                }
            });

            // Get all menu items
            const menuItems = document.querySelectorAll('.menu-item');

            function resetMenuItemAnimations() {
                menuItems.forEach(item => {
                    item.classList.remove('menu-item-animation');
                    // Trigger reflow
                    void item.offsetWidth;
                    item.classList.add('menu-item-animation');
                });
            }

            function openSidebar() {
                hamburgerIcon.classList.add('open');
                hamburger.classList.add('spin-animation');

                // Remove initial hidden state if present
                sidebar.classList.remove('sidebar-initial-hidden');

                // Apply visible state with animation
                sidebar.classList.remove('sidebar-hidden');
                sidebar.classList.add('sidebar-visible');

                // Show backdrop
                backdrop.classList.add('active');

                // Adjust content margin on large screens
                if (window.innerWidth >= 1024) {
                    if (content) {
                        content.style.marginLeft = '300px';
                    }
                }

                // Prevent scrolling
                document.body.style.overflow = 'hidden';

                // Reset menu item animations for staggered entrance
                resetMenuItemAnimations();
            }

            function closeSidebarFunc() {
                hamburgerIcon.classList.remove('open');

                // Apply hiding animation
                sidebar.classList.remove('sidebar-visible');
                sidebar.classList.add('sidebar-hidden');

                // Hide backdrop
                backdrop.classList.remove('active');

                // Reset content margin
                if (content) {
                    content.style.marginLeft = '0';
                }

                // Restore scrolling
                document.body.style.overflow = '';

                // After animation completes, add the initial hidden class
                setTimeout(() => {
                    if (!sidebar.classList.contains('sidebar-visible')) {
                        sidebar.classList.add('sidebar-initial-hidden');
                    }
                }, 500);
            }

            hamburger.addEventListener('click', function () {
                hamburger.classList.remove('spin-animation');
                void hamburger.offsetWidth; // Trigger reflow to restart animation

                if (sidebar.classList.contains('sidebar-hidden') || sidebar.classList.contains(
                        'sidebar-initial-hidden')) {
                    openSidebar();
                } else {
                    closeSidebarFunc();
                }
            });

            closeSidebar.addEventListener('click', closeSidebarFunc);
            backdrop.addEventListener('click', closeSidebarFunc);

            // Handle window resize
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    if (sidebar.classList.contains('sidebar-visible') && content) {
                        content.style.marginLeft = '300px';
                    }
                } else if (content) {
                    content.style.marginLeft = '0';
                }
            });

            // CHANGE: Initial setup - Always start with sidebar closed
            sidebar.classList.add('sidebar-initial-hidden');

            // Menu navigation - Prevent page reload and update content
            const allMenuItems = document.querySelectorAll(".menu-item span a, #floor-options a");

            // CHANGE: Highlight Home menu as active by default
            const homeMenuItem = document.querySelector('.menu-item:first-of-type');
            highlightActiveMenu(homeMenuItem);

            // Function to highlight active menu
            function highlightActiveMenu(activeItem) {
                // Remove active class from all menu items
                menuItems.forEach(item => {
                    item.classList.remove('active-menu');
                    item.style.backgroundColor = '';
                    item.style.borderLeftColor = '';
                });

                // Add active class to clicked menu item
                if (activeItem) {
                    activeItem.classList.add('active-menu');
                    activeItem.style.backgroundColor = 'rgba(79, 70, 229, 0.1)';
                    activeItem.style.borderLeftColor = '#1d4ed8';
                    activeItem.style.borderLeftWidth = '3px';
                    activeItem.style.borderLeftStyle = 'solid';
                }
            }
        });
    </script>
</body>

</html>