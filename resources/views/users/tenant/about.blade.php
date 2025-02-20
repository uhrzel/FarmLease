<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="">
            <div class="relative w-full">
                <img class="w-full h-[600px] object-cover" src="{{ asset('assets/images/cover.png') }}" alt="Cover Image">
                <div class="absolute inset-0 flex justify-center items-center">
                    <img class="w-60 h-50 p-2 rounded-full " src="{{ asset('assets/images/logo1.png') }}" alt="Logo">
                </div>
            </div>
            <div class="text-center my-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 uppercase">Exploring Lands</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div>
                    <img class="w-full h-60 object-cover rounded-lg shadow-lg" src="{{ asset('assets/images/about1.jpeg') }}" alt="About Image 1">

                </div>
                <div>
                    <img class="w-full h-60 object-cover rounded-lg shadow-lg" src="{{ asset('assets/images/about2.jpeg') }}" alt="About Image 2">
                </div>
                <div>
                    <img class="w-full h-60 object-cover rounded-lg shadow-lg" src="{{ asset('assets/images/about3.jpg') }}" alt="About Image 3">
                </div>
            </div>

            <!-- Description Paragraph -->
            <div class="text-center max-w-3xl mx-auto mb-8">
                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                    This site is your trusted guide for finding agricultural land and connecting with landowners.
                    Whether you’re a farmer looking to lease land or a landowner seeking tenants, the platform simplifies
                    the entire process, making it convenient and efficient. With detailed land listings, secure communication tools,
                    and transparent lease terms, we aim to remove the traditional hurdles in land leasing and create a more streamlined experience for all users.
                </p>
                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mt-4">
                    Our user-friendly interface ensures that completing transactions is quick and hassle-free.
                    The forms are designed to be intuitive, reducing the time and effort required to finalize agreements.
                    From browsing available land to signing a lease, the platform integrates all the necessary steps into a smooth
                    and accessible process, enabling you to focus on what matters most—making the land work for you.
                </p>
            </div>
            <div class="text-center mt-10">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Contact Us</h3>
                <p class="text-gray-600 dark:text-gray-300">For more inquiries</p>
                <div class="flex justify-center gap-6 mt-4">
                    <a href="#" class="w-16 h-16">
                        <img src="{{ asset('assets/images/fb.png') }}" alt="Facebook" class="w-16 h-16 object-contain">
                    </a>
                    <a href="#" class="w-16 h-16">
                        <img src="{{ asset('assets/images/ig.png') }}" alt="Phone" class="w-16 h-16 object-contain">
                    </a>
                    <a href="#" class="w-16 h-16">
                        <img src="{{ asset('assets/images/gmail.png') }}" alt="Email" class="w-16 h-16 object-contain">
                    </a>
                    <a href="#" class="w-16 h-16">
                        <img src="{{ asset('assets/images/phone.png') }}" alt="Phone" class="w-16 h-16 object-contain">
                    </a>

                </div>
            </div>


        </div>
    </div>
</x-app-layout>