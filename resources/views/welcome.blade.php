<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FarmLease</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body class="bg-white">
    <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo.png' ) }}" alt="FarmLease Logo" class="h-8" />
            <p class="text-green-700 text-xl font-bold">FARMLEASE</p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('register') }}" class="font-bold text-gray-600 px-2 sm:px-4 text-sm sm:text-base">Signup</a>
            <a href="{{ route('login') }}" class="font-bold bg-gray-800 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-lg text-sm sm:text-base">Login</a>
        </div>
    </header>
    <section
        class="relative bg-cover bg-center flex items-center justify-between text-white text-left px-10"
        style="background-image: url('assets/images/hero-section.png'); height: 60vh">
        <div
            class="p-8 rounded w-full sm:w-1/2 relative z-50 justify-center items-center">
            <p
                class="text-4xl sm:text-8xl font-extrabold text-white tracking-wide uppercase relative z-10">
                FARMLEASE
            </p>

            <p
                class="mt-2 text-base sm:text-xl leading-relaxed font-semibold relative z-50 text-white">
                FarmLease is a digital platform that simplifies agricultural land
                leasing by connecting landowners and farmers. It offers tools for
                secure payments, transparent contracts, and detailed land listings to
                streamline the leasing process.
            </p>

            <a
                href="#"
                class="mt-4 text-white px-6 sm:px-10 py-4 rounded font-bold inline-block"
                style="
            background-color: #b87e00;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',
              'Lucida Sans', Arial, sans-serif;
          ">LEASE NOW</a>
        </div>
        <img
            src="{{ asset('assets/images/grass.png' ) }}"
            alt="Grass Icon"
            class="absolute right-10 bottom-10 sm:bottom-20 w-32 sm:w-48 h-auto hidden sm:block" />
    </section>

    <section class="py-8 px-6">
        <p class="font-bold text-gray-800" style="font-size: 45px">
            🔥 Discover Our New Land Listings
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
            <div class="relative bg-white shadow rounded overflow-hidden">
                <img
                    src="{{ asset('assets/images/land1.jpg' ) }}"
                    alt="Land 1"
                    class="w-full h-[60vh] object-cover" />
                <div
                    class="absolute bottom-0 w-full bg-gray-900 bg-opacity-70 text-white p-3">
                    <p class="text-sm">Location : Panalipan, Catmon, Cebu</p>
                    <p class="font-semibold">Land size : 5.125 hectares</p>
                    <p class="font-semibold">
                        Soil Quality : Fertile, suitable for growing crops
                    </p>
                    <p class="font-semibold">Price : ₱5,125,000</p>
                </div>
            </div>
            <div class="relative bg-white shadow rounded overflow-hidden">
                <img
                    src="{{ asset('assets/images/land2.jpg' ) }}"
                    alt="Land 2"
                    class="w-full h-[60vh] object-cover" />
                <div
                    class="absolute bottom-0 w-full bg-gray-900 bg-opacity-70 text-white p-3">
                    <p class="font-semibold">Location : Patupat, Barili, Cebu</p>
                    <p class="text-sm">Land size : 7.72 hectares</p>
                    <p class="text-sm">
                        Soil Quality : Fertile, suitable for growing crops
                    </p>
                    <p class="text-sm">Price : ₱ 7,719,017</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 px-6 bg-gray-50">
        <p class="text-xl font-bold text-gray-800">⭐ Trusted Users</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
            <div
                class="bg-white p-4 shadow rounded flex flex-col items-center text-center h-[40vh] relative">
                <div class="flex items-center justify-center">
                    <span class="text-yellow-400 text-2xl mr-2">⭐</span>
                    <img src="{{ asset('assets/images/user1.png' ) }}" alt="User 1" class="w-20 h-20 rounded-full" />
                </div>
                <p class="font-semibold mt-2">Bely Fernandez</p>
                <p class="text-sm text-gray-600">Tenant</p>
                <p class="mt-2 text-gray-600 italic">
                    "FarmLease is a great platform for leasing land easily and without
                    complications"
                </p>
            </div>
            <div
                class="bg-white p-4 shadow rounded flex flex-col items-center text-center h-[40vh] relative">
                <div class="flex items-center justify-center">
                    <span class="text-yellow-400 text-2xl mr-2">⭐</span>
                    <img src="{{ asset('assets/images/user2.png' ) }}" alt="User 2" class="w-20 h-20 rounded-full" />
                </div>
                <p class="font-semibold mt-2">Rholo Cruz</p>
                <p class="text-sm text-gray-600">Tenant</p>
                <p class="mt-2 text-gray-600 italic">
                    "FarmLease is simple to use and makes renting land so convenient"
                </p>
            </div>
        </div>
    </section>
    <footer class="bg-gray-800 text-white py-4 px-6 flex items-center relative">
        <p class="absolute left-1/2 transform -translate-x-1/2">
            CUSTOMER SERVICE
        </p>
        <div class="ml-auto flex space-x-0">
            <a href="#" class="text-white px-2"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-white px-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white px-2"><i class="fas fa-envelope"></i></a>
        </div>
    </footer>
</body>

</html>