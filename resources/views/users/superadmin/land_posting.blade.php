<x-app-layout>

    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;700&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div id="land-postings" class="section relative z-0 py-12 md:py-16 bg-white dark:bg-gray-800">
        <div class="container xl:max-w-6xl mx-auto px-4">
            <!-- Heading -->
            <header class="text-center mx-auto mb-12 lg:px-20">
                <h2 class="text-2xl leading-normal mb-2 font-bold text-black dark:text-white">Latest Land Postings</h2>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 100 60" class="mx-auto h-9">
                    <circle cx="50.1" cy="30.4" r="5" class="stroke-primary dark:stroke-gray-200" style="fill: transparent;stroke-width: 2;"></circle>
                    <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary dark:stroke-gray-200" style="stroke-width: 2;"></line>
                    <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary dark:stroke-gray-200" style="stroke-width: 2;"></line>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-light text-xl mx-auto pb-2">
                    Explore our latest land postings available for sale or lease.
                </p>
            </header>
        </div>

        <div class="flex flex-wrap flex-row">
            @php
            $sortedListings = $landListings->sortByDesc('created_at');
            @endphp
            @forelse($sortedListings as $listing)
            @if($listing->status === 'approved')
            <figure class="flex-shrink max-w-full px-3 w-full sm:w-1/2 lg:w-1/4 group wow fadeInUp mb-8" data-wow-duration="1s">
                <div class="relative overflow-hidden cursor-pointer mb-6">
                    <a href="{{ asset('storage/land_images/' . basename($listing->image)) }}" data-gallery="gallery1" data-glightbox="Land Owner: {{ $listing->landowner_name }}" class="glightbox3">
                        <img class="block w-full h-auto transform duration-500" src="{{ asset('storage/land_images/' . basename($listing->image)) }}" alt="Land Image">
                        <div class="absolute inset-x-0 bottom-0 h-20 transition-opacity duration-500 ease-in opacity-0 group-hover:opacity-100 overflow-hidden px-4 py-2 text-gray-100 dark:text-gray-900 bg-black dark:bg-gray-200 text-center">
                            <h3 class="text-base leading-normal font-semibold my-1 text-white dark:text-gray-900">{{ $listing->landowner_name }}</h3>
                            <small class="d-block">Posted {{ $listing->created_at->diffForHumans() }}</small>
                        </div>
                    </a>
                </div>
                <h3 class="text-base leading-normal font-semibold my-1 text-gray-900 dark:text-white">{{ $listing->landowner_name }}</h3>
                <small class="d-block text-gray-600 dark:text-gray-400">Location: {{ $listing->location }}</small><br>
                <small class="d-block text-gray-600 dark:text-gray-400">Price: {{ $listing->price }} USD</small>
            </figure>
            @endif
            @empty
            <p class="text-gray-500 dark:text-gray-400">No approved land postings available.</p>
            @endforelse
        </div>

        <!-- Scripts -->
        <script src="{{ asset('src/vendors/glightbox/dist/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('src/vendors/@splidejs/splide/dist/js/splide.min.js') }}"></script>
        <script src="{{ asset('src/vendors/typed.js/lib/typed.min.js') }}"></script>
        <script src="{{ asset('src/vendors/wow.js/dist/wow.min.js') }}"></script>
        <script src="{{ asset('src/vendors/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script src="{{ asset('src/js/theme.js') }}"></script>

    </div>

</x-app-layout>