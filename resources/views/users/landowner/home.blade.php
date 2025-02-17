<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Create Button with Icon -->
                    <button type="button" id="showFormButton"
                        class="px-5 py-2.5 rounded-full text-white text-sm tracking-wider font-medium border border-current outline-none bg-blue-700 hover:bg-blue-800 active:bg-blue-700">
                        <i class="fas fa-plus-circle mr-2"></i>Create
                    </button>

                    <!-- Modal to Show Form -->
                    <div id="landListingModal" class="hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-4xl p-6">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Create New Land Listing</h3>

                                <!-- Land Listing Form -->
                                <form action="{{ route('landlistings.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <!-- Landowner Name -->
                                        <div class="col-span-1">
                                            <label for="landowner_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Landowner Name</label>
                                            <input type="text" name="landowner_name" id="landowner_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Location -->
                                        <div class="col-span-1">
                                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Location</label>
                                            <input type="text" name="location" id="location" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Price -->
                                        <div class="col-span-1">
                                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                                            <input type="number" step="0.01" name="price" id="price" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-span-1">
                                            <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Size -->
                                        <div class="col-span-1">
                                            <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Size (in hectares)</label>
                                            <input type="number" name="size" id="size" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Soil Quality -->
                                        <div class="col-span-1">
                                            <label for="soil_quality" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Soil Quality</label>
                                            <input type="text" name="soil_quality" id="soil_quality" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Land Condition -->
                                        <div class="col-span-1">
                                            <label for="land_condition" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Land Condition</label>
                                            <input type="text" name="land_condition" id="land_condition" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" required>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-span-1">
                                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                                            <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white" rows="3" required></textarea>
                                        </div>

                                        <!-- Image -->
                                        <div class="col-span-1">
                                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Image</label>
                                            <input type="file" name="image" id="image" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white">
                                        </div>
                                    </div>

                                    <!-- Hidden Landowner ID -->
                                    <input type="hidden" name="landowner_id" value="{{ Auth::id() }}">

                                    <!-- Submit and Close Buttons (same line) -->
                                    <div class="mt-6 flex justify-between">
                                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Submit</button>
                                        <button type="button" id="closeModalButton" class="bg-gray-500 text-white py-2 px-4 rounded-md">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.min.js"></script>

    <!-- SweetAlert Success and Error Messages -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: @json(session('success')),
            showConfirmButton: true,
        });
    </script>
    @elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: @json(session('error')),
            showConfirmButton: true,
        });
    </script>
    @endif

    <script>
        // Toggle the visibility of the form when the button is clicked
        document.getElementById('showFormButton').addEventListener('click', function() {
            var modal = document.getElementById('landListingModal');
            modal.classList.toggle('hidden');
        });

        // Close the modal when the close button is clicked
        document.getElementById('closeModalButton').addEventListener('click', function() {
            var modal = document.getElementById('landListingModal');
            modal.classList.add('hidden');
        });
    </script>
</x-app-layout>