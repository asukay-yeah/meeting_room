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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        /* Custom styles for checkboxes */
        .checkbox-filter:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Add z-index to prevent cards from overlapping the dropdown */
        .card {
            position: relative;
            z-index: 10;
        }

        /* Status badge styles */
        .badge-approved {
            background-color: #16a34a;
        }

        .badge-pending {
            background-color: #3b82f6;
        }

        .badge-rejected {
            background-color: #ef4444;
        }
    </style>
</head>

<body class="font-[outfit]">


    @include('component.sidebar')

    <div id="content" class="content-shifted transition-all duration-300 ease-in-out p-5 lg:pt-6">
        <div id="content-area">
            <div class="w-full justify-between flex flex-col md:flex-row md:px-10 py-2">
                <div class="flex justify-start flex-col">
                    <p class="text-2xl text-[#333333]">History</p>
                    <p class="font-light text-[#555555]">History of All Meeting Room Bookings.</p>
                </div>
                <div class="flex items-center md:mt-0 mt-5">
                    <!-- Filter Component -->
                    <div class="relative md:w-52 w-2/5 mr-4 ">
                        <button type="button" id="filterButton"
                            class="flex items-center justify-between w-full px-3 h-11 bg-white border border-stone-300 focus:border-stone-500 hover:border-stone-500 rounded-md shadow-sm text-sm text-[#555555] hover:bg-gray-50">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: none;
                                            }
                                        </style>
                                    </defs>
                                    <title>Filter</title>
                                    <g data-name="Layer 2" id="Layer_2">
                                        <path d="M28,9H11a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z" />
                                        <path d="M7,9H4A1,1,0,0,1,4,7H7A1,1,0,0,1,7,9Z" />
                                        <path d="M21,17H4a1,1,0,0,1,0-2H21a1,1,0,0,1,0,2Z" />
                                        <path d="M11,25H4a1,1,0,0,1,0-2h7a1,1,0,0,1,0,2Z" />
                                        <path
                                            d="M9,11a3,3,0,1,1,3-3A3,3,0,0,1,9,11ZM9,7a1,1,0,1,0,1,1A1,1,0,0,0,9,7Z" />
                                        <path
                                            d="M23,19a3,3,0,1,1,3-3A3,3,0,0,1,23,19Zm0-4a1,1,0,1,0,1,1A1,1,0,0,0,23,15Z" />
                                        <path
                                            d="M13,27a3,3,0,1,1,3-3A3,3,0,0,1,13,27Zm0-4a1,1,0,1,0,1,1A1,1,0,0,0,13,23Z" />
                                        <path d="M28,17H25a1,1,0,0,1,0-2h3a1,1,0,0,1,0,2Z" />
                                        <path d="M28,25H15a1,1,0,0,1,0-2H28a1,1,0,0,1,0,2Z" />
                                    </g>
                                    <g id="frame">
                                        <rect class="cls-1" height="32" width="32" />
                                    </g>
                                </svg>
                                <span id="filterButtonText">Filter</span>
                            </div>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Filter Dropdown with Checkboxes -->
                        <div id="filterDropdown"
                            class="absolute mt-1 w-full bg-white border border-stone-300 rounded-md shadow-lg z-50 hidden">
                            <div class="px-4 py-3">
                                <div class="flex items-center mb-2">
                                    <input id="approved" type="checkbox" value="approved"
                                        class="h-4 w-4 rounded border border-gray-300 focus:ring-0 checkbox-filter appearance-none checked:bg-green-500 checked:border-transparent">
                                    <label for="approved" class="ml-2 text-sm text-gray-700">Approved</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input id="pending" type="checkbox" value="pending"
                                        class="h-4 w-4 rounded border border-gray-300 focus:ring-0 checkbox-filter appearance-none checked:bg-blue-500 checked:border-transparent">
                                    <label for="pending" class="ml-2 text-sm text-gray-700">Pending</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="rejected" type="checkbox" value="rejected"
                                        class="h-4 w-4 rounded border border-gray-300 focus:ring-0 checkbox-filter appearance-none checked:bg-red-500 checked:border-transparent">
                                    <label for="rejected" class="ml-2 text-sm text-gray-700">Rejected</label>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 px-3 py-3">
                                <button id="applyFilter" type="button"
                                    class="w-full py-1 bg-[#555555] text-white text-sm rounded hover:bg-[#444444]">Apply</button>
                            </div>
                        </div>
                    </div>



                    <!-- Search Input (Larger) -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" placeholder="Search..."
                                class="md:w-60 w-full pl-4 pr-10 h-11 border border-stone-300 placeholder:text-stone-300 text-sm text-[#555555] rounded-md focus:outline-none focus:ring-0 focus:border-stone-500 hover:border-stone-500 hover:bg-gray-50">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-stone-300 md:mx-5 my-6">

            <!-- Grid of booking cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 w-full px-5">
                @foreach($bookings as $booking)
                <div class="card card-status-{{ $booking->status }} border border-stone-50 
                @if($booking->status == 'approved') bg-green-50 
                @elseif($booking->status == 'rejected') bg-red-50 
                @else bg-blue-50 @endif 
                rounded-lg p-5 relative">
                    <h3 class="text-xl font-medium mb-4 text-[#333333]">{{ $booking->nama_kantor }}</h3>
                    <div class="ml-2">
                        <div class="flex items-center mb-2 text-[#444444]">
                            <i data-feather="type" class="mr-3 w-5 h-5"></i>
                            <p>{{ $booking->purpose }}</p>
                        </div>
                        <div class="flex items-center mb-2 text-[#444444]">
                            <i data-feather="alert-circle" class="mr-3 w-5 h-5"></i>
                            <p>{{ $booking->room->name }}</p>
                        </div>
                        <div class="flex items-center mb-2 text-[#444444]">
                            <i data-feather="user" class="mr-3 w-5 h-5"></i>
                            <p>{{ $booking->user->name }}</p>
                        </div>

                        <div class="flex items-center mb-4 text-[#444444]">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div
                        class="badge-{{ $booking->status }} text-white px-4 py-1 rounded-full inline-block font-normal text-sm">
                        {{ $booking->status }}
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get key elements
            const filterButton = document.getElementById('filterButton');
            const filterDropdown = document.getElementById('filterDropdown');
            const applyFilter = document.getElementById('applyFilter');
            const filterButtonText = document.getElementById('filterButtonText');
            const checkboxes = document.querySelectorAll('.checkbox-filter');

            // Debug logging to verify elements are found
            console.log('Filter button found:', !!filterButton);
            console.log('Filter dropdown found:', !!filterDropdown);

            // Get URL parameters to set initial state
            const urlParams = new URLSearchParams(window.location.search);
            const statusParam = urlParams.get('status');

            // Function to add event listener safely
            function addSafeEventListener(element, event, handler) {
                if (element) {
                    element.addEventListener(event, handler);
                } else {
                    console.error(`Element not found for ${event} event`);
                }
            }

            // Set initial checkbox states and filter cards based on URL parameter
            if (statusParam) {
                const statuses = statusParam.split(',');
                statuses.forEach(status => {
                    const checkbox = document.getElementById(status);
                    if (checkbox) {
                        checkbox.checked = true;
                        checkbox.classList.add('checked');
                    }
                });

                // Apply the filter immediately
                filterCards(statuses);

                // Update filter button text
                updateFilterButtonText();
            } else {
                // If no status parameter, show all cards
                document.querySelectorAll('.card').forEach(card => {
                    card.style.display = 'block';
                });
            }

            // Toggle dropdown when filter button is clicked
            addSafeEventListener(filterButton, 'click', function (e) {
                console.log('Filter button clicked');
                e.preventDefault();
                e.stopPropagation(); // Prevent event bubbling
                filterDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking elsewhere
            addSafeEventListener(document, 'click', function (event) {
                if (filterDropdown && !filterDropdown.classList.contains('hidden') &&
                    !filterButton.contains(event.target) &&
                    !filterDropdown.contains(event.target)) {
                    filterDropdown.classList.add('hidden');
                }
            });

            // Apply filter button
            addSafeEventListener(applyFilter, 'click', function () {
                const selectedValues = Array.from(document.querySelectorAll('.checkbox-filter:checked'))
                    .map(cb => cb.value);

                console.log('Applying filters:', selectedValues);

                // Filter the cards
                filterCards(selectedValues);

                // Update filter button text
                updateFilterButtonText();

                // Update URL without refreshing page
                updateUrlWithStatus(selectedValues);

                // Close the dropdown
                filterDropdown.classList.add('hidden');
            });

            // Add event listeners to checkboxes
            checkboxes.forEach(checkbox => {
                addSafeEventListener(checkbox, 'change', function () {
                    console.log('Checkbox changed:', this.id, this.checked);
                    if (this.checked) {
                        this.classList.add('checked');
                    } else {
                        this.classList.remove('checked');
                    }
                });
            });

            // Function to filter cards based on selected statuses
            function filterCards(statuses) {
                const cards = document.querySelectorAll('.card');

                if (!statuses || statuses.length === 0) {
                    // If no statuses selected, show all cards
                    cards.forEach(card => {
                        card.style.display = 'block';
                    });
                    console.log('Showing all cards');
                } else {
                    // Show only cards with selected statuses
                    cards.forEach(card => {
                        // Find status from classes like "card-status-approved"
                        let cardStatus = '';
                        for (const cls of card.classList) {
                            if (cls.startsWith('card-status-')) {
                                cardStatus = cls.replace('card-status-', '');
                                break;
                            }
                        }

                        // Alternative way to get status from the badge element
                        if (!cardStatus) {
                            const badgeElement = card.querySelector('[class^="badge-"]');
                            if (badgeElement) {
                                for (const cls of badgeElement.classList) {
                                    if (cls.startsWith('badge-')) {
                                        cardStatus = cls.replace('badge-', '');
                                        break;
                                    }
                                }
                            }
                        }

                        console.log('Card status:', cardStatus, 'Visible:', statuses.includes(
                            cardStatus));

                        if (cardStatus && statuses.includes(cardStatus)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }
            }

            // Update filter button text based on selections
            function updateFilterButtonText() {
                const selectedCheckboxes = document.querySelectorAll('.checkbox-filter:checked');
                const selectedValues = Array.from(selectedCheckboxes).map(cb => {
                    return cb.id.charAt(0).toUpperCase() + cb.id.slice(1);
                });

                if (filterButtonText) {
                    filterButtonText.textContent = selectedValues.length > 0 ? selectedValues.join(', ') :
                        'Filter';
                }
            }

            // Update URL with status parameter without refreshing the page
            function updateUrlWithStatus(statuses) {
                const url = new URL(window.location);

                if (statuses && statuses.length > 0) {
                    url.searchParams.set('status', statuses.join(','));
                } else {
                    url.searchParams.delete('status');
                }

                window.history.pushState({}, '', url);
            }

            // Log that initialization is complete
            console.log('Filter functionality initialized');
        });

        // Initialize Feather icons if available
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
</body>

</html>