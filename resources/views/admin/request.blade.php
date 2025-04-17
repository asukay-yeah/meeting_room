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
            <div class="w-full md:px-5 py-2">
                <div class="w-full justify-between flex flex-col md:flex-row md:px-5 mb-6">
                    <div class="flex justify-start flex-col">
                        <p class="text-2xl text-[#333333]">Request</p>
                        <p class="font-light text-[#555555]">Accept & Reject Meeting Room Permissions</p>
                    </div>
                    <!-- <div class="flex items-center md:mt-0 mt-5">
                        Search Input (Larger)
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" placeholder="Search..."
                                    class="md:w-80 w-full pl-4 pr-10 h-11 border border-stone-300 placeholder:text-stone-300 text-sm text-[#555555] rounded-md focus:outline-none focus:ring-0 focus:border-stone-500 hover:border-stone-500 hover:bg-gray-50">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <hr>

                <div class="w-full">
                    <!-- Header Row - Hanya terlihat pada layar medium ke atas -->
                    <div
                        class="hidden md:grid md:grid-cols-5 md:gap-4 px-4 py-3 text-sm font-medium text-neutral-400 border-b">
                        <div>Nama</div>
                        <div>Kebutuhan</div>
                        <div>Tanggal</div>
                        <div>Ruangan</div>
                        <div class="text-center">Status</div>
                    </div>

                    <!-- Data Row foreach -->
                    @foreach($request as $req)
                    <div class="border-b py-4">
                        <div class="md:grid md:grid-cols-5 md:gap-4 px-4 items-center">
                            <!-- Nama dengan Avatar - Selalu terlihat -->
                            <div class="flex items-center mb-3 md:mb-0">
                                <div
                                    class="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-500 font-medium">{{ substr($req->user->name, 0, 1) . (strpos($req->user->name, ' ') ? substr($req->user->name, strpos($req->user->name, ' ') + 1, 1) : '') }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-gray-900 font-medium">{{ $req->nama_kantor }}</div>
                                    <div class="text-gray-500 text-sm">{{ $req->user->name }}</div>
                                </div>
                            </div>

                            <!-- Informasi lain - Pada layar kecil ditampilkan sebagai grid 2 kolom -->
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 mb-3 md:mb-0">
                                <div class="text-neutral-400 text-sm md:hidden">Kebutuhan:</div>
                                <div class="text-gray-700">{{ $req->purpose }}</div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 mb-3 md:mb-0">
                                <div class="text-neutral-400 text-sm md:hidden">Tanggal:</div>
                                <div class="text-gray-700">
                                    {{ \Carbon\Carbon::parse($req->booking_date)->format('d M Y') }}</div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 mb-3 md:mb-0">
                                <div class="text-neutral-400 text-sm md:hidden">Ruangan:</div>
                                <div class="text-gray-700">{{ $req->room->name }}</div>
                            </div>

                            <!-- Tombol Status - Ditengahkan pada semua ukuran layar -->
                            <div class="flex justify-center items-center space-x-5 mt-4 md:mt-0">
                                <form action="{{ route('admin.approve', $req->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button
                                        class="bg-green-500 flex justify-center items-center hover:bg-green-600 text-white w-10 h-10 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.reject', $req->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button
                                        class="bg-red-500 flex justify-center items-center hover:bg-red-600 text-white w-10 h-10 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

</body>

</html>