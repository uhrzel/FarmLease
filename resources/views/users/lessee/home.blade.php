<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;700&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                @if($listing->transaction->status === 'available' || $listing->transaction->status === 'sold_out' || $listing->transaction->status === 'reserved')
                <figure class="flex-shrink max-w-full px-3 w-full sm:w-1/2 lg:w-1/4 group wow fadeInUp mb-8" data-wow-duration="1s">
                    <div class="relative overflow-hidden cursor-pointer">
                        <a href="{{ asset('storage/land_images/' . basename($listing->image)) }}"
                            data-gallery="gallery1"
                            data-title="Land Owner: {{ $listing->landowner_name }} <br> Location: {{ $listing->location }}"
                            data-description="
            Price: {{ $listing->price }} Php <br> 
            Size: {{ $listing->size }} <br> 
            Soil Quality: {{ $listing->soil_quality }} <br> 
            Land Condition: {{ $listing->land_condition }} <br> 
            Phone: {{ $listing->phone_number }} <br> 
            Description: {{ $listing->description }} <br> 
            <div class='flex space-x-3 mt-4'>
             <a href='#' class='rent-btn bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center {{ $listing->transaction->status === 'sold_out' ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}'
                            data-id='{{ $listing->id }}'
                            data-user-id='{{ $listing->transaction->user_id ?? '' }}'
                            {{ $listing->transaction->status === 'sold_out' ? 'disabled' : '' }}> 
                            <i class='fas fa-shopping-cart mr-2'></i> Rent Now
                        </a>


                        <a href='tel:{{ $listing->phone_number }}' class='bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center'>
                            <i class='fas fa-phone-alt mr-2'></i> Call Owner
                        </a>

                        <a href='https://www.google.com/maps/search/?api=1&query={{ urlencode($listing->location) }}' target='_blank' class='bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center'>
                            <i class='fas fa-map-marker-alt mr-2'></i> View on Maps
                        </a>

                    </div>
                    "
                            class="glightbox3">

                            <img class="block w-full h-auto transform duration-500" src="{{ asset('storage/land_images/' . basename($listing->image)) }}" alt="Land Image">
                            <div class="absolute inset-x-0 bottom-0 h-20 transition-opacity duration-500 ease-in opacity-0 group-hover:opacity-100 overflow-hidden px-4 py-2 text-gray-100 dark:text-gray-900 bg-black dark:bg-gray-200 text-center">
                                <h3 class="text-base leading-normal font-semibold my-1 text-white dark:text-gray-900">{{ $listing->landowner_name }}</h3>
                                <small class="d-block">Posted {{ $listing->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-m shadow-md">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $listing->landowner_name }}</h3>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <i class="fas fa-map-marker-alt text-blue-500"></i>
                            <span class="font-medium">Location:</span> {{ $listing->location }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <i class="fas fa-tag text-green-500"></i>
                            <span class="font-medium">Price:</span> {{ number_format($listing->price, 2) }} Php
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            <i class="fas fa-info-circle text-indigo-500"></i>
                            <span class="font-medium">Status:</span>
                            @php
                            $status = optional($listing->transaction)->status ?? 'Not Available';
                            $statusColors = [
                            'available' => 'text-green-600',
                            'pending' => 'text-yellow-500',
                            'sold_out' => 'text-red-600',
                            'reserved' => 'text-blue-500'
                            ];
                            $statusColor = $statusColors[$status] ?? 'text-gray-500';
                            @endphp
                            <strong class="{{ $statusColor }}">{{ ucfirst(str_replace('_', ' ', $status)) }}</strong> <br>
                            <button class="mt-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out"
                                onclick="openCommentModal({{ $listing->id }})">Leave a Comment</button>

                        </p>
                    </div>


                    <!--       <div class='map-container' data-location='{{ $listing->location }}' style='height: 100%; width: 200%; margin-top: 20px;'></div> -->
                </figure>
                @endif
                @empty
                <p class="text-gray-500 dark:text-gray-400">No approved land postings available.</p>
                @endforelse
            </div>
            <div id="commentModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-y-auto relative">
                    <button onclick="closeCommentModal()"
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-400 text-xl">
                        ✖
                    </button>

                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white text-center mb-6">
                        Leave a Comment
                    </h3>

                    <div id="comments-container"
                        class="mb-6 max-h-60 overflow-y-auto border rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                        <p class="text-center text-gray-500 dark:text-gray-400">No comments yet.</p>
                    </div>

                    <form id="commentForm">
                        <input type="hidden" id="landlisting_id" name="landlisting_id"> <!-- Stores Land Listing ID -->

                        <div class="mb-4">
                            <label class="block text-gray-900 dark:text-white font-medium mb-2">Your Comment:</label>
                            <textarea id="commentText" name="comments"
                                class="w-full p-3 border rounded-lg dark:bg-gray-700 dark:text-white resize-none focus:ring focus:ring-green-400 transition duration-200"
                                placeholder="Write your comment..." rows="4"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-900 dark:text-white font-medium mb-2">Rating:</label>
                            <select id="commentRating" name="rating"
                                class="w-full p-3 border rounded-lg dark:bg-gray-700 dark:text-white focus:ring focus:ring-yellow-400 transition duration-200">
                                <option value="5">⭐️⭐️⭐️⭐️⭐️ - Excellent</option>
                                <option value="4">⭐️⭐️⭐️⭐️ - Good</option>
                                <option value="3">⭐️⭐️⭐️ - Average</option>
                                <option value="2">⭐️⭐️ - Below Average</option>
                                <option value="1">⭐️ - Poor</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-5 rounded-lg shadow-md transition duration-300 ease-in-out"
                                onclick="closeCommentModal()">Cancel</button>
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-md transition duration-300 ease-in-out">
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Scripts -->
            <script src="{{ asset('src/vendors/glightbox/dist/js/glightbox.min.js') }}"></script>
            <script src="{{ asset('src/vendors/@splidejs/splide/dist/js/splide.min.js') }}"></script>
            <script src="{{ asset('src/vendors/typed.js/lib/typed.min.js') }}"></script>
            <script src="{{ asset('src/vendors/wow.js/dist/wow.min.js') }}"></script>
            <script src="{{ asset('src/vendors/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
            <script src="{{ asset('src/js/theme.js') }}"></script>
        </div>
        <script>
            function openCommentModal(landlisting_id) {
                console.log("Button clicked! Opening modal for listing ID:", landlisting_id);
                document.getElementById("landlisting_id").value = landlisting_id;
                fetchComments(landlisting_id);
                document.getElementById("commentModal").classList.remove("hidden");
            }

            function closeCommentModal() {
                document.getElementById("commentModal").classList.add("hidden");
            }

            document.getElementById("commentForm").addEventListener("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch("{{ route('comments.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Comment added successfully!");
                            closeCommentModal();
                            location.reload();
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            function fetchComments(landlisting_id) {
                fetch(`/fetch-comments/${landlisting_id}`)
                    .then(response => response.json())
                    .then(comments => {
                        let container = document.getElementById('comments-container');
                        container.innerHTML = '';

                        comments.forEach(comment => {
                            let ratingStars = '⭐'.repeat(comment.rating);
                            let profileImage = comment.image ? comment.image : "/default-avatar.png"; // Fallback image

                            container.innerHTML += `
                    <div class="flex items-start space-x-3 mb-3">  
                        <img src="${profileImage}" alt="Profile Image" class="h-10 w-10 rounded-full border-2 border-gray-300 dark:border-gray-600 object-cover">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">${comment.firstname}</p>
                            <p class="text-gray-600 dark:text-gray-400">${comment.comments}</p>
                            <p class="text-yellow-500">Rating: ${ratingStars}</p>
                        </div>
                    </div>
                `;
                        });
                    })
                    .catch(error => console.error('Error fetching comments:', error));
            }
        </script>
        <script
            async
            defer
            src="https://maps.gomaps.pro/maps/api/js?key={{ env('MAP_KEY') }}&libraries=geometry,places&callback=initMap"></script>
        <script>
            function initMap() {
                document.querySelectorAll(".map-container").forEach(function(mapElement) {
                    let location = mapElement.getAttribute("data-location");

                    let geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        address: location
                    }, function(results, status) {
                        if (status === "OK") {
                            let map = new google.maps.Map(mapElement, {
                                center: results[0].geometry.location,
                                zoom: 12,
                            });

                            new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map,
                                title: location,
                            });
                        } else {
                            console.error("Geocode failed: " + status);
                        }
                    });
                });
            }
            document.addEventListener("click", function(event) {
                let rentBtn = event.target.closest(".rent-btn");
                if (rentBtn) {
                    event.preventDefault();

                    let listingId = rentBtn.getAttribute("data-id");
                    let userId = rentBtn.getAttribute("data-user-id");

                    if (!userId) {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "You must be logged in to rent a land."
                        });
                        return;
                    }
                    if (window.lightbox && typeof window.lightbox.close === "function") {
                        window.lightbox.close();
                    }

                    fetch("{{ route('cart.add') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            },
                            body: JSON.stringify({
                                land_listing_id: listingId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success!",
                                    text: data.message,
                                    confirmButtonColor: "#3085d6"
                                }).then(() => {
                                    window.location.href = "{{ route('cart.lessee.index') }}";
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "An error occurred while adding to cart."
                            });
                        });
                }
            });
        </script>


</x-app-layout>