<div class="container flex flex-col mx-auto">
    <!-- Backdrop for all screen sizes -->
    <div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-30"></div>

    <!-- Floating hamburger for all screen sizes -->
    <button id="hamburger" class="floating-hamburger">
        <div class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>

    <aside id="sidebar"
        class="sidebar-initial-hidden flex flex-col shrink-0 lg:w-[300px] w-[280px] transition-all duration-300 ease-in-out m-0 fixed z-40 inset-y-0 left-0 bg-white border-r border-r-dashed border-r-neutral-200 shadow-lg shadow-gray-200/50">
        <div class="flex shrink-0 px-6 items-center justify-center h-[80px] border-b border-gray-100">
            <a class="transition-colors duration-200 ease-in-out flex items-center" href="">
                <img alt="Logo" src="{{ asset('assets/balmon_logo.png') }}" class="h-16">
            </a>

            <!-- Close button for all screen sizes -->
            <button id="close-sidebar" class="p-2">
            </button>
        </div>

        <div class="relative px-3 py-4 overflow-y-auto flex-grow">
            <div id="menu-items-container" class="flex flex-col w-full font-medium">

                <!-- Applications Header -->
                <div class="block pb-[.15rem]">
                    <div class="px-4 py-[.65rem]">
                        <span class="font-semibold text-[0.95rem] uppercase text-gray-500">REWEL Balmon</span>
                    </div>
                </div>

                <div
                    class="{{ Route::is('user.home') ? 'border-l-[3px] border-[#1d4ed8] bg-[#1d4ed8]/10 text-blue-800' : 'hover:border-l-[3px] border-[#1d4ed8] hover:bg-[#1d4ed8]/10 text-stone-600 hover:text-blue-800' }} duration-300 my-1 rounded-lg overflow-hidden menu-item-animation">
                    <span class="select-none flex items-center px-4 py-3 cursor-pointer">
                        <i data-feather="home" class="w-5 h-5 text-gray-500 mr-3"></i>
                        <a href="{{ url('user/home') }}" class="flex items-center flex-grow text-[1.05rem] ">Home</a>
                    </span>
                </div>

                <!-- Reserve Room with Submenu -->
                <div
                    class="hover:border-l-[3px] border-[#1d4ed8] hover:bg-[#1d4ed8]/10 text-stone-600 hover:text-blue-800 duration-300 my-1 rounded-lg overflow-hidden menu-item-animation">
                    <span class="select-none flex items-center px-4 py-3 cursor-pointer" id="reserve-room-toggle">
                        <i data-feather="mouse-pointer" class="w-5 h-5 text-gray-500 mr-3"></i>
                        <p class="flex items-center flex-grow text-[1.05rem] text-stone-600 hover:text-blue-800">
                            Reserve Room</p>
                        <i data-feather="chevron-down" class="w-5 h-5 text-gray-500"></i>
                    </span>
                    <!-- Floor Options Submenu -->
                    <div id="floor-options" class="pl-12 hidden">
                        @foreach($rooms as $room)
                        <div class="py-2 transition-all duration-200 flex items-center">
                            <i data-feather="codepen" class="w-4 h-4 text-gray-500 mr-2"></i>
                            <a href="{{ url('user/rooms/' . $room->id) }}"
                                class="text-stone-600 hover:text-blue-800 block py-1 w-full">{{ $room->name }}</a>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div
                    class="{{ Route::is('user.history') ? 'border-l-[3px] border-[#1d4ed8] bg-[#1d4ed8]/10 text-blue-800' : 'hover:border-l-[3px] border-[#1d4ed8] hover:bg-[#1d4ed8]/10 text-stone-600 hover:text-blue-800' }} duration-300 my-1 rounded-lg overflow-hidden menu-item-animation">
                    <span class="select-none flex items-center px-4 py-3 cursor-pointer">
                        <i data-feather="clock" class="w-5 h-5 text-gray-500 mr-3"></i>
                        <a href="{{ url('user/history') }}"
                            class="flex items-center flex-grow text-[1.05rem]">History</a>
                    </span>
                </div>

            </div>
        </div>

        <!-- Profile info moved to bottom of sidebar with improved styling -->
        <div class="mt-auto border-t border-gray-100">
            <div class="flex items-center p-4 bg-gray-50 rounded-lg m-3">
                <div class="relative">
                    <div class="h-10 w-10 flex-shrink-0 bg-blue-800 rounded-full flex items-center justify-center">
                        <span class="text-white font-medium">{{ substr(Auth::user()->name, 0, 1) . (strpos(Auth::user()->name, ' ') ? substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : '') }}</span>
                    </div>
                    <span
                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                </div>
                <div class="ml-3 flex-grow">
                    <a href="javascript:void(0)"
                        class="text-[1rem] font-medium text-gray-800 hover:text-blue-800 transition-colors">{{ Auth::user()->name }}</a>
                    <span class="text-gray-500 font-medium block text-sm">Role: {{ Auth::user()->role }}</span>
                </div>
                <!-- Settings dropdown -->
                <div class="relative">
                    <button id="settings-button" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                        <i data-feather="settings" class="w-5 h-5 text-gray-500"></i>
                    </button>
                    <!-- Settings Menu -->
                    <div id="settings-menu"
                        class="absolute right-0 bottom-full mb-2 w-32 bg-white rounded-lg shadow-lg hidden">
                        <div class="py-2">
                            <a href="javascript:;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i data-feather="user" class="w-4 h-4 inline mr-2"></i>Profile
                            </a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100">
                                <i data-feather="log-out" class="w-4 h-4 inline mr-2"></i>Logout
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>


<script>
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