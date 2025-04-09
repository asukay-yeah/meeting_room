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

                <div class="{{ Route::is('admin.home') ? 'border-l-[3px] border-[#1d4ed8] bg-[#1d4ed8]/10 text-blue-800' : 'hover:border-l-[3px] border-[#1d4ed8] hover:bg-[#1d4ed8]/10 text-stone-600 hover:text-blue-800' }} duration-300 my-1 rounded-lg overflow-hidden menu-item-animation">
                    <span class="select-none flex items-center px-4 py-3 cursor-pointer">
                        <i data-feather="layout" class="w-5 h-5 text-gray-500 mr-3"></i>
                        <a href="{{ url('admin/home') }}"
                            class="flex items-center flex-grow text-[1.05rem]  ">Dashboard</a>
                    </span>
                </div>

                <div class="menu-item my-1 rounded-lg overflow-hidden menu-item-animation">
                    <span class="select-none flex items-center px-4 py-3 cursor-pointer">
                        <i data-feather="bell" class="w-5 h-5 text-gray-500 mr-3"></i>
                        <a href="#"
                            class="flex items-center flex-grow text-[1.05rem] text-stone-600 hover:text-blue-800">Request</a>
                    </span>
                </div>

                <div class="menu-item my-1 rounded-lg overflow-hidden menu-item-animation">
                    <span class="select-none flex items-center px-4 py-3 cursor-pointer">
                        <i data-feather="clock" class="w-5 h-5 text-gray-500 mr-3"></i>
                        <a href="#"
                            class="flex items-center flex-grow text-[1.05rem] text-stone-600 hover:text-blue-800">History</a>
                    </span>
                </div>

            </div>
        </div>

        <!-- Profile info moved to bottom of sidebar with improved styling -->
        <div class="mt-auto border-t border-gray-100">
            <div class="flex items-center p-4 bg-gray-50 rounded-lg m-3">
                <div class="relative">
                    <img class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm"
                        src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/avatars/avatar1.jpg"
                        alt="avatar image">
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