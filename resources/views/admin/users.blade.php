<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1E40AF', // dark blue
                            light: '#3b82f6',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen">

    @include('component.sidebar')

    <div id="content" class="content-shifted transition-all duration-300 ease-in-out px-4 py-8  mx-auto">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-primary">User Management</h1>
            <p class="text-gray-600">Add, view, and manage users</p>
        </header>

        <!-- Add User Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-primary mb-4">Add New User</h2>
            <form action="{{ route('user.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
                <button type="submit"
                    class="bg-primary hover:bg-primary-light text-white font-medium py-2 px-4 rounded-md transition-colors duration-300">
                    Add User
                </button>
            </form>
        </div>

        <!-- User List -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-primary">User List</h2>
                <form>
                    <div class="relative">
                        <input type="text" placeholder="Search users..." name="search" value="{{ request('search') }}"
                            class="pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-2 top-2.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Username</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($user as $users)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 flex-shrink-0 bg-primary rounded-full  flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr($users->name, 0, 1) . (strpos($users->name, ' ') ? substr($users->name, strpos($users->name, ' ') + 1, 1) : '') }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div  class="text-sm font-medium text-gray-900">{{ $users->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $users->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if( $users->role === 'admin')
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $users->role }}
                                </span>
                                @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $users->role }}
                                </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-primary-light hover:text-primary mr-3"
                                    onclick="document.getElementById('edit-modal-{{ $users->id }}').showModal()">Edit</button>
                                <button class="text-red-600 hover:text-red-900"
                                    onclick="document.getElementById('delete-modal-{{ $users->id }}').showModal()">Delete</button>
                            </td>
                        </tr>
                        <!-- Delete Confirmation Modal -->
                        <dialog id="delete-modal-{{ $users->id }}" class="rounded-lg shadow-xl p-0 max-w-md mx-auto">
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Delete</h3>
                                <p class="text-sm text-gray-500 mb-4">Are you sure you want to delete <span class="font-bold">{{ $users->name }}</span>? This
                                    action cannot be
                                    undone.</p>
                                <div class="flex justify-end space-x-3">
                                    <button onclick="document.getElementById('delete-modal-{{ $users->id }}').close()"
                                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                                        Cancel
                                    </button>
                                    <button
                                        onclick="event.preventDefault(); document.getElementById('deleteForm-{{ $users->id }}').submit()"
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                        Delete
                                    </button>
                                    <form action="{{ route('user.destroy', $users->id) }}" method="POST"
                                        id="deleteForm-{{ $users->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </div>
                        </dialog>

                        <!-- Edit User Modal -->
                        <dialog id="edit-modal-{{ $users->id }}" class="rounded-lg shadow-xl p-0 max-w-2xl mx-auto">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Edit {{ $users->name }}</h3>
                                    <button onclick="document.getElementById('edit-modal-{{ $users->id }}').close()"
                                        class="text-gray-400 hover:text-gray-500">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <form action="{{ route('user.update', $users->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                            <input type="text" name="name" value="{{ $users->name }}" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                            <input type="text" name="email" value="{{ $users->email }}" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                            <select name="role" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                                <option value="" disabled>Pilih Role</option>
                                                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="user" {{ $users->role == 'user' ? 'selected' : '' }}>User
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-3">
                                        <button type="button"
                                            onclick="document.getElementById('edit-modal-{{ $users->id }}').close()"
                                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-primary hover:bg-primary-light text-white text-sm font-medium rounded-md">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </dialog>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="text-black">
                <nav>
                    {{ $user->links() }}
                </nav>
            </div>
        </div>
    </div>



    <script>
        // Basic JavaScript for modal functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Close modals when clicking outside
            const modals = document.querySelectorAll('dialog');
            modals.forEach(modal => {
                modal.addEventListener('click', function (event) {
                    const rect = modal.getBoundingClientRect();
                    const isInDialog = (rect.top <= event.clientY && event.clientY <= rect.top +
                        rect.height &&
                        rect.left <= event.clientX && event.clientX <= rect.left + rect
                        .width);
                    if (!isInDialog) {
                        modal.close();
                    }
                });
            });
        });

        
    </script>
</body>

</html>