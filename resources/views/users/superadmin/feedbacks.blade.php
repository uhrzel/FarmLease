<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
            {{ __('Feedback Monitoring') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-6">
        @foreach ($feedbacks->groupBy('landListing.landowner_name') as $landTitle => $groupedFeedbacks)
        <!-- Land Title Section -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-2 border-b pb-2">
                🌿 {{ $landTitle }} - POST
            </h3>

            @foreach ($groupedFeedbacks as $feedback)
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 mb-4 flex items-center space-x-6 transition hover:shadow-2xl">
                <!-- User Avatar -->
                @php
                $userImage = $feedback->user->avatar
                ? asset('storage/' . $feedback->user->avatar)
                : asset('user-default.png');
                @endphp
                <img src="{{ $userImage }}"
                    alt="User Avatar"
                    class="w-16 h-16 rounded-full object-cover border-2 border-gray-300 dark:border-gray-700 shadow-md">

                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ $feedback->user->firstname }} {{ $feedback->user->lastname }}
                    </h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 italic">
                        "{{ $feedback->comments }}"
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            📅 {{ $feedback->created_at->format('F j, Y h:i A') }}
                        </span>
                        <span class="text-sm font-bold text-yellow-500">
                            ⭐ {{ $feedback->rating }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</x-app-layout>