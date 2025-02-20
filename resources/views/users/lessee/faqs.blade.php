<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FAQS') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="relative w-full">
            <img class="w-full h-[600px] object-cover" src="{{ asset('assets/images/cover.png') }}" alt="Cover Image">
            <div class="absolute inset-0 flex justify-center items-center">
                <img class="w-60 h-50 p-2 rounded-full " src="{{ asset('assets/images/logo1.png') }}" alt="Logo">
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="max-w-3xl mx-auto mt-10">
            <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 text-center">FAQs</h3>
            <p class="text-gray-500 text-center">Frequently Asked Questions</p>

            <div class="mt-6 space-y-4">
                @foreach([
                'How to contact the owner?',
                'Can I contact the server for more concern?',
                'How to pay, if I rent the land?',
                'How to renew?',
                'How to upload the image?',
                'Can I set up my profile?',
                'What payment method is used to pay?'
                ] as $question)
                <details class="w-full bg-gray-200 p-4 rounded-lg shadow-md">
                    <summary class="cursor-pointer text-gray-800 font-semibold flex justify-between">
                        {{ $question }}
                        <span class="text-gray-500">&#x25BE;</span>
                    </summary>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </details>
                @endforeach
            </div>

            <div class="text-center mt-6">
                <button class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow-md hover:bg-gray-400">
                    See More...
                </button>
            </div>
        </div>
    </div>
</x-app-layout>