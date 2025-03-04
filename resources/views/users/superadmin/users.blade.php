<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Users') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-end mb-2">
            <div class="relative w-full sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/4">
                <input type="text" id="search"
                    class="w-full p-2 pl-10 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-black dark:text-white rounded-md"
                    placeholder="search" onkeyup="searchUsers()">
                <i class="fas fa-search absolute left-3 top-2 text-gray-500 dark:text-gray-400"></i>
            </div>
        </div>
        <!-- LANDOWNERS -->
        <section id="landowners" class="user-section mb-2">
            <div class="flex justify-center mb-6">
                <h2 class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md py-2 px-6 rounded-full inline-block text-lg font-semibold">
                    LANDOWNERS
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-6">
                @foreach ($landowners as $user)
                <div class="user-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('user-default.png') }}"
                        alt="Profile Image"
                        class="h-16 w-16 rounded-full border-3 border-gray-300 dark:border-gray-600 mb-4 object-cover mx-auto">
                    <h3 class="text-lg font-bold mb-2 text-gray-700 dark:text-gray-200">{{ $user->firstname . ' ' . $user->lastname }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">LANDOWNERS</p>
                </div>

                @endforeach
            </div>
        </section>

        <!-- TENANTS -->
        <section id="tenants" class="user-section mb-2">
            <div class="flex justify-center mb-6">
                <h2 class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md py-2 px-6 rounded-full inline-block text-lg font-semibold">
                    TENANTS
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-6">
                @foreach ($tenants as $user)
                <div class="user-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center flex flex-col justify-center items-center">

                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('user-default.png') }}"
                        alt="Profile Image"
                        class="h-16 w-16 rounded-full border-3 border-gray-300 dark:border-gray-600 mb-4 object-cover mx-auto">

                    <h3 class="text-lg font-bold mb-2 text-gray-700 dark:text-gray-200">{{ $user->firstname . ' ' . $user->lastname }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">TENANTS</p>
                </div>

                @endforeach
            </div>
        </section>

        <!-- LESSEES -->
        <section id="lessees" class="user-section mb-2">
            <div class="flex justify-center mb-6">
                <h2 class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md py-2 px-6 rounded-full inline-block text-lg font-semibold">
                    LESSEES
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-6">
                @foreach ($lessees as $user)
                <div class="user-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('user-default.png') }}"
                        alt="Profile Image"
                        class="h-16 w-16 rounded-full border-3 border-gray-300 dark:border-gray-600 mb-4 object-cover mx-auto">
                    <h3 class="text-lg font-bold mb-2 text-gray-700 dark:text-gray-200">{{ $user->firstname . ' ' . $user->lastname }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">LESSEES</p>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <script>
        function searchUsers() {
            let searchQuery = document.getElementById("search").value.toLowerCase();
            let sections = ['landowners', 'tenants', 'lessees'];

            sections.forEach(section => {
                let cards = document.querySelectorAll(`#${section} .user-card`);
                cards.forEach(card => {
                    let name = card.querySelector('h3').innerText.toLowerCase();
                    if (name.includes(searchQuery)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        }
    </script>
</x-app-layout>