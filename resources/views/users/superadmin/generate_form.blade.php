<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Generate Report: User Insights') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Chart --}}
                <canvas id="userChart" class="mb-8"></canvas>

                {{-- Percentage Cards (4 per row) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-center mb-8">
                    @foreach ($data as $role)
                    <div class="p-4 bg-white dark:bg-gray-900 shadow-md rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex items-center justify-center space-x-2">
                            <span class="w-3 h-3 rounded-full 
                                    @if($role['role'] === 'tenant') bg-[#8B4513] 
                                    @elseif($role['role'] === 'lessee') bg-[#607D8B] 
                                    @elseif($role['role'] === 'land_owner') bg-[#4CAF50] 
                                    @elseif($role['role'] === 'admin') bg-[#A68A3D] 
                                    @else bg-gray-800 
                                    @endif"></span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ ucfirst($role['role']) }}</span>
                        </div>
                        <p class="text-gray-800 dark:text-gray-300 mt-1">{{ $role['percentage'] }}%</p>
                    </div>
                    @endforeach
                </div>

                {{-- User Count Cards (2 per row) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-center">
                    @foreach ($data as $role)
                    <div class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg border border-gray-300 dark:border-gray-700 flex flex-col items-center">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-3 h-3 rounded-full 
                                    @if($role['role'] === 'tenant') bg-[#8B4513] 
                                    @elseif($role['role'] === 'lessee') bg-[#607D8B] 
                                    @elseif($role['role'] === 'land_owner') bg-[#4CAF50] 
                                    @elseif($role['role'] === 'admin') bg-[#A68A3D] 
                                    @else bg-gray-800 
                                    @endif"></span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ ucfirst($role['role']) }}</span>
                        </div>
                        <p class="text-4xl font-bold tracking-wider text-gray-900 dark:text-gray-100">{{ number_format($role['count']) }}</p>
                        <span class="text-gray-600 dark:text-gray-400 uppercase tracking-wider text-sm">Users</span>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    {{-- Chart Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        const chartData = {
            labels: @json($data -> pluck('role')),
            datasets: [{
                label: 'User Roles',
                data: @json($data -> pluck('count')),
                backgroundColor: ['#8B4513', '#607D8B', '#4CAF50', '#A68A3D'],
                borderWidth: 1
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true
            }
        });
    </script>
</x-app-layout>