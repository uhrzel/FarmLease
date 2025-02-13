<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mt-1">
                    <a href="#">
                        <img src="{{ asset('assets/images/logo.png' ) }}" alt="logo" class='block fill-current text-gray-800 dark:text-gray-200' style="height: 50px; width: 60px;" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- tenant -->
                    @auth
                    @if(auth()->user()->role === 'tenant')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-home mr-2"></i> {{ __('Home') }}
                        </x-nav-link>

                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-info-circle mr-2"></i> {{ __('About') }}
                        </x-nav-link>
                        <x-nav-link :href="route('faqs')" :active="request()->routeIs('faqs')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-question-circle mr-2"></i> {{ __('FAQs') }}
                        </x-nav-link>
                    </div>
                    <!-- Lessee -->
                    @elseif(auth()->user()->role === 'lessee')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-home mr-2"></i> {{ __('Home') }}
                        </x-nav-link>

                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-info-circle mr-2"></i> {{ __('About') }}
                        </x-nav-link>
                        <x-nav-link :href="route('faqs')" :active="request()->routeIs('faqs')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-question-circle mr-2"></i> {{ __('FAQs') }}
                        </x-nav-link>
                    </div>

                    <!-- Landowner -->
                    @elseif(auth()->user()->role === 'land_owner')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-home mr-2"></i> {{ __('Home') }}
                        </x-nav-link>

                        <x-nav-link :href="route('stats')" :active="request()->routeIs('stats')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-chart-bar mr-2"></i> {{ __('Statistics') }}
                        </x-nav-link>
                    </div>

                    <!--Admin  -->
                    @elseif(auth()->user()->role === 'admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-home mr-2"></i> {{ __('Home') }}
                        </x-nav-link>
                    </div>
                    <!-- Superadmin -->
                    @elseif(auth()->user()->role === 'superadmin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('users')" :active="request()->routeIs('users')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-users mr-2"></i> {{ __('Users') }}
                        </x-nav-link>

                        <x-nav-link :href="route('land_posting')" :active="request()->routeIs('land_posting')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-landmark mr-2"></i> {{__('Land posting')}}
                        </x-nav-link>

                        <x-nav-link :href="route('generate_form')" :active="request()->routeIs('generate_form')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-file-alt mr-2"></i>{{__('Generate Form')}}
                        </x-nav-link>

                        <x-nav-link :href="route('transactions')" :active="request()->routeIs('transactions')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-exchange-alt mr-2"></i> {{__('Transactions')}}
                        </x-nav-link>

                        <x-nav-link :href="route('feedbacks')" :active="request()->routeIs('feedbacks')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-comment-alt mr-2"></i> {{__('Feedbacks')}}
                        </x-nav-link>

                    </div>
                    @endif
                    @endauth
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                @if(auth()->user()->role === 'tenant' || auth()->user()->role === 'lessee' || auth()->user()->role === 'land_owner' || auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                <!-- Notification Button -->
                <button type="button"
                    class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        3
                    </span>
                </button>
                @endif
                @endauth
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                @auth
                @if(auth()->user()->role === 'tenant')
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none transition duration-150">
                            <!-- Profile Image -->
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Information in Dropdown -->
                        <div class="px-4 py-3 text-center">
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="mx-auto rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->role }}
                            </p>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2">
                            <i class="fas fa-user-circle text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2">
                                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-300 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>


                @elseif(auth()->user()->role === 'lessee')
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none transition duration-150">
                            <!-- Profile Image -->
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Information in Dropdown -->
                        <div class="px-4 py-3 text-center">
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="mx-auto rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->role }}
                            </p>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2">
                            <i class="fas fa-user-circle text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2">
                                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-300 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @elseif(auth()->user()->role === 'land_owner')
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none transition duration-150">
                            <!-- Profile Image -->
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Information in Dropdown -->
                        <div class="px-4 py-3 text-center">
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="mx-auto rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->role }}
                            </p>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2">
                            <i class="fas fa-user-circle text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2">
                                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-300 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @elseif(auth()->user()->role === 'admin')
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none transition duration-150">
                            <!-- Profile Image -->
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Information in Dropdown -->
                        <div class="px-4 py-3 text-center">
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="mx-auto rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->role }}
                            </p>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2">
                            <i class="fas fa-user-circle text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2">
                                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-300 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @elseif(auth()->user()->role === 'superadmin')
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none transition duration-150">
                            <!-- Profile Image -->
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Information in Dropdown -->
                        <div class="px-4 py-3 text-center">
                            <img src="{{ Auth::user()->identity_recognition ? asset('storage/' . Auth::user()->identity_recognition) : asset('default-user.png') }}"
                                class="mx-auto rounded-full object-cover border border-gray-300 shadow-sm"
                                alt="User Profile" style="height: 40px; width: 40px;">
                            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->role }}
                            </p>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2">
                            <i class="fas fa-user-circle text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <hr class="border-gray-200 dark:border-gray-600">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2">
                                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-300 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endif
                @endauth
            </div>
            <div class="-me-2 flex items-center sm:hidden gap-4">
                @auth
                @if(auth()->user()->role === 'tenant' || auth()->user()->role === 'lessee' || auth()->user()->role === 'land_owner' || auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                <!-- Notification Button -->
                <button type="button"
                    class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        3
                    </span>
                </button>
                @endif
                @endauth
                <button id="theme-toggle-mobile" type="button"
                    class="w-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <!-- tenant -->
            @if(auth()->user()->role === 'tenant')
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-2"></i> {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                <i class="fas fa-info-circle mr-2"></i> {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faqs')" :active="request()->routeIs('faqs')">
                <i class="fas fa-question-circle mr-2"></i> {{ __('FAQs') }}
            </x-responsive-nav-link>
            <!-- lessee -->
            @elseif(auth()->user()->role === 'lessee')
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-2"></i> {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                <i class="fas fa-info-circle mr-2"></i> {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faqs')" :active="request()->routeIs('faqs')">
                <i class="fas fa-question-circle mr-2"></i> {{ __('FAQs') }}
            </x-responsive-nav-link>
            <!-- Landowner -->
            @elseif(auth()->user()->role === 'land_owner')
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-2"></i> {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('stats')" :active="request()->routeIs('stats')">
                <i class="fas fa-chart-bar mr-2"></i> {{ __('Statistics') }}
            </x-responsive-nav-link>
            <!--Admin  -->
            @elseif(auth()->user()->role === 'admin')
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-2"></i> {{ __('Home') }}
            </x-responsive-nav-link>
            @elseif(auth()->user()->role === 'superadmin')
            <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')">
                <i class="fas fa-users mr-2"></i> {{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('land_posting')" :active="request()->routeIs('land_posting')">
                <i class="fas fa-landmark mr-2"></i> {{__('Land posting')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('generate_form')" :active="request()->routeIs('generate_form')">
                <i class="fas fa-file-alt mr-2"></i>{{__('Generate Form')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transactions')" :active="request()->routeIs('transactions')">
                <i class="fas fa-exchange-alt mr-2"></i> {{__('Transactions')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('feedbacks')" :active="request()->routeIs('feedbacks')">
                <i class="fas fa-comment-alt mr-2"></i> {{__('Feedbacks')}}
            </x-responsive-nav-link>
            @endif
            @endauth
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->username }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            @auth
            @if(auth()->user()->role === 'tenant')
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @elseif(auth()->user()->role === 'lessee')
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @elseif(auth()->user()->role === 'land_owner')
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @elseif(auth()->user()->role === 'admin')
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @elseif(auth()->user()->role === 'superadmin')
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endif
            @endauth
        </div>
    </div>
</nav>