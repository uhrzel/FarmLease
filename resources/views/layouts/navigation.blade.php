<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    @php
    use Illuminate\Support\Facades\DB;

    $tenantId = auth()->user()->id;
    $currentMonth = date('m');
    $currentYear = date('Y');

    $notifications = DB::table('carts')
    ->join('land_listings', 'carts.land_listing_id', '=', 'land_listings.id')
    ->where('carts.user_id', $tenantId)
    ->where('carts.status', 'pending')
    ->where(function ($query) use ($currentMonth, $currentYear) {
    $query->where(function ($q) use ($currentMonth) {
    $q->where('carts.plan', 'Monthly')
    ->whereRaw('DATE_FORMAT(carts.end_month, "%m") = ?', [$currentMonth]);
    })->orWhere(function ($q) use ($currentYear) {
    $q->where('carts.plan', 'Yearly')
    ->whereRaw('DATE_FORMAT(carts.end_month, "%Y") = ?', [$currentYear]);
    });
    })
    ->select('carts.*', 'land_listings.location')
    ->get();
    @endphp
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

                        <x-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')"
                            class="text-m font-semibold tracking-wide font-serif leading-relaxed text-gray-800 dark:text-gray-200">
                            <i class="fas fa-bell mr-2"></i> {{__('Notifications')}}
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
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-1">
                @auth
                @if(auth()->user()->role === 'land_owner' || auth()->user()->role === 'admin')
                <!-- Notification Dropdown -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button type="button" id="notificationBtn"
                            class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <i class="fas fa-bell text-lg"></i>
                            <span id="notificationCount"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div id="notificationContent" class="p-3 w-80 max-h-96 overflow-y-auto">
                            <p class="text-gray-500 dark:text-gray-400">No new listings.</p>
                        </div>
                    </x-slot>
                </x-dropdown>
                <!-- Modal -->
                <x-modal name="land-listing-modal">
                    <div id="modalContent" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <!-- content ng land -->
                    </div>
                </x-modal>
                @endif
                @endauth
                @auth
                @if(auth()->user()->role === 'tenant')
                <!-- Notification Dropdown -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button type="button" id="notificationBtnTenant"
                            class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <i class="fas fa-bell text-lg"></i>
                            @if ($notifications->count() > 0)
                            <span id="notificationTenantCount"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                            @else
                            <span id="notificationTenantCount"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">

                        <div id="notificationPaymentTenant" class="p-3 w-80 max-h-96 overflow-y-auto">
                            <div class="pb-2 border-b border-gray-300 dark:border-gray-600">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Notifications</h2>
                            </div>
                            @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                            <div class="mb-2 p-2">
                                <p class="text-gray-800 dark:text-gray-200 text-sm">
                                    Your payment for the lease of <strong>{{ $notification->location }}</strong> is due on
                                    <strong>
                                        @if ($notification->plan === 'Monthly')
                                        {{ date('F j, Y', strtotime($notification->end_month)) }} <!-- Format as month name -->
                                        @elseif ($notification->plan === 'Yearly')
                                        {{ date('Y', strtotime($notification->end_month)) }} <!-- Format as year -->
                                        @endif
                                    </strong>.
                                </p>
                                <hr class="border-t border-gray-300 dark:border-gray-600">
                            </div>
                            @endforeach
                            @else
                            <p class="text-gray-500 dark:text-gray-400">No new notifications.</p>
                            @endif
                        </div>
                    </x-slot>

                </x-dropdown>
                @endif
                @endauth

                @auth
                @if(auth()->user()->role === 'lessee')
                <!-- Notification Dropdown -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button type="button" id="notificationBtnLessee"
                            class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <i class="fas fa-bell text-lg"></i>
                            @if ($notifications->count() > 0)
                            <span id="notificationLesseeCount"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                            @else
                            <span id="notificationLesseeCount"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div id=notificationPaymentLessee" class="p-3 w-80 max-h-96 overflow-y-auto">
                            <div class="pb-2 border-b border-gray-300 dark:border-gray-600">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Notifications</h2>
                            </div>
                            @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                            <div class="mb-2 p-2">
                                <p class="text-gray-800 dark:text-gray-200 text-sm">
                                    Your payment for the lease of <strong>{{ $notification->location }}</strong> is due on
                                    <strong>
                                        @if ($notification->plan === 'Monthly')
                                        {{ date('F j, Y', strtotime($notification->end_month)) }} <!-- Format as month name -->
                                        @elseif ($notification->plan === 'Yearly')
                                        {{ date('Y', strtotime($notification->end_month)) }} <!-- Format as year -->
                                        @endif
                                    </strong>.
                                </p>
                                <hr class="border-t border-gray-300 dark:border-gray-600">
                            </div>
                            @endforeach
                            @else
                            <p class="text-gray-500 dark:text-gray-400">No new notifications.</p>
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>

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
                        <x-dropdown-link :href="route('cart.tenant.index')" class="flex items-center px-4 py-2">
                            <i class="fas fa-shopping-cart text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Cart') }}</span>
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
                        <x-dropdown-link :href="route('cart.lessee.index')" class="flex items-center px-4 py-2">
                            <i class="fas fa-shopping-cart text-gray-600 dark:text-gray-300 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Cart') }}</span>
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
                @if(auth()->user()->role === 'land_owner' || auth()->user()->role === 'admin')
                <!-- Notification Button -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button type="button" id="notificationBtnRes"
                            class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <i class="fas fa-bell text-lg"></i>
                            <span id="notificationCountRes"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div id="notificationContentRes"
                            class="p-3 max-h-96 overflow-y-auto 
                w-64 sm:w-72 md:w-80 lg:w-96 
                max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg 
                bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                            <p class="text-gray-500 dark:text-gray-400">No new listings.</p>
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- Modal -->
                <x-modal name="land-listing-modalRes">
                    <div id="modalContentRes" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <!-- content ng land -->
                    </div>
                </x-modal>
                @endif
                @endauth

                @auth
                @if(auth()->user()->role === 'tenant')
                <!-- Notification Button -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button type="button" id="notificationBtnTenantRes"
                            class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <i class="fas fa-bell text-lg"></i>
                            @if ($notifications->count() > 0)
                            <span id="notificationTenantCountRes"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                            @else
                            <span id="notificationTenantCountRes"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div id="notificationPaymentTenantRes"
                            class="p-3 max-h-96 overflow-y-auto 
                w-64 sm:w-72 md:w-80 lg:w-96 
                max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg 
                bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                            <div class="pb-2 border-b border-gray-300 dark:border-gray-600">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Notifications</h2>
                            </div>
                            @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                            <div class="mb-2 p-2">
                                <p class="text-gray-800 dark:text-gray-200 text-sm">
                                    Your payment for the lease of <strong>{{ $notification->location }}</strong> is due on
                                    <strong>
                                        @if ($notification->plan === 'Monthly')
                                        {{ date('F j, Y', strtotime($notification->end_month)) }} <!-- Format as month name -->
                                        @elseif ($notification->plan === 'Yearly')
                                        {{ date('Y', strtotime($notification->end_month)) }} <!-- Format as year -->
                                        @endif
                                    </strong>.
                                </p>
                                <hr class="border-t border-gray-300 dark:border-gray-600">
                            </div>
                            @endforeach
                            @else
                            <p class="text-gray-500 dark:text-gray-400">No new notifications.</p>
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>
                @endif
                @endauth

                @auth
                @if(auth()->user()->role === 'lessee')
                <!-- Notification Button -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button type="button" id="notificationBtnLesseeRes"
                            class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <i class="fas fa-bell text-lg"></i>
                            @if ($notifications->count() > 0)
                            <span id="notificationLesseeCountRes"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                            @else
                            <span id="notificationLesseeCountRes"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div id="notificationPaymentLesseeRes"
                            class="p-3 max-h-96 overflow-y-auto 
                w-64 sm:w-72 md:w-80 lg:w-96 
                max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg 
                bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                            <div class="pb-2 border-b border-gray-300 dark:border-gray-600">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Notifications</h2>
                            </div>
                            @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                            <div class="mb-2 p-2">
                                <p class="text-gray-800 dark:text-gray-200 text-sm">
                                    Your payment for the lease of <strong>{{ $notification->location }}</strong> is due on
                                    <strong>
                                        @if ($notification->plan === 'Monthly')
                                        {{ date('F j, Y', strtotime($notification->end_month)) }} <!-- Format as month name -->
                                        @elseif ($notification->plan === 'Yearly')
                                        {{ date('Y', strtotime($notification->end_month)) }} <!-- Format as year -->
                                        @endif
                                    </strong>.
                                </p>
                                <hr class="border-t border-gray-300 dark:border-gray-600">
                            </div>
                            @endforeach
                            @else
                            <p class="text-gray-500 dark:text-gray-400">No new notifications.</p>
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>
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
            <x-responsive-nav-link :href="route('cart.tenant.index')" :active="request()->routeIs('cart.index')">
                <i class="fas fa-shopping-cart mr-2"></i> {{ __('Cart') }}
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
            <x-responsive-nav-link :href="route('cart.lessee.index')" :active="request()->routeIs('cart.index')">
                <i class="fas fa-shopping-cart mr-2"></i> {{ __('Cart') }}
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
            <x-responsive-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')">
                <i class="fas fa-bell mr-2"></i> {{__('Notifications')}}
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const notificationBtns = document.querySelectorAll("[id^=notificationBtn]");
            const notificationCounts = document.querySelectorAll("[id^=notificationCount]");
            const notificationContents = document.querySelectorAll("[id^=notificationContent]");
            const modalContents = document.getElementById("modalContent");
            const modalContentsRes = document.getElementById("modalContentRes");

            async function fetchNewLandListings() {
                try {
                    const response = await fetch("{{ route('landlistings.new') }}");
                    const data = await response.json();

                    notificationCounts.forEach(notificationCount => {
                        if (data.count > 0) {
                            notificationCount.textContent = data.count;
                            notificationCount.classList.remove("hidden");
                        } else {
                            notificationCount.classList.add("hidden");
                        }
                    });

                    let listingsHtml = "";
                    if (data.count > 0) {
                        data.listings.forEach((listing) => {
                            listingsHtml += `
                        <div class="p-3 flex items-center border-b dark:border-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-all"
                            data-listing-id="${listing.id}">
                            <div class="w-12 h-12 flex-shrink-0">
                                <img src="${listing.image}" alt="Land Image" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    ${listing.landowner_name} posted a new listing
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Location: ${listing.location}
                                </p>
                            </div>
                        </div>
                    `;
                        });
                    } else {
                        listingsHtml = "<p class='p-3 text-gray-500 dark:text-gray-400'>No new listings.</p>";
                    }

                    notificationContents.forEach(content => content.innerHTML = listingsHtml);

                    document.querySelectorAll("[data-listing-id]").forEach((item) => {
                        item.addEventListener("click", function() {
                            const listingId = this.getAttribute("data-listing-id");
                            openListingModal(listingId);
                        });
                    });

                } catch (error) {
                    console.error("Error fetching notifications:", error);
                }
            }

            async function openListingModal(listingId) {
                try {
                    const response = await fetch(`/landlistings/${listingId}`);
                    const listing = await response.json();

                    modalContentsRes.innerHTML = `
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">${listing.created_at}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Posted by <strong>${listing.landowner_name}</strong></p>
                </div>
                <div class="mt-4 flex justify-center">
                    <img src="${listing.image}" alt="Land Image" class="w-full max-w-md h-60 object-cover rounded-lg shadow">
                </div>
                <div class="mt-4">
                    <p class="text-gray-700 dark:text-gray-300"><strong>Location:</strong> ${listing.location}</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Description:</strong> ${listing.description}</p>
                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button onclick="approveListing(${listing.id})" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Approve
                    </button>
                    <button onclick="declineListing(${listing.id})" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                        Decline
                    </button>
                </div>
            `;
                    modalContents.innerHTML = `
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">${listing.created_at}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Posted by <strong>${listing.landowner_name}</strong></p>
                </div>
                <div class="mt-4 flex justify-center">
                    <img src="${listing.image}" alt="Land Image" class="w-full max-w-md h-60 object-cover rounded-lg shadow">
                </div>
                <div class="mt-4">
                    <p class="text-gray-700 dark:text-gray-300"><strong>Location:</strong> ${listing.location}</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Description:</strong> ${listing.description}</p>
                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button onclick="approveListing(${listing.id})" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Approve
                    </button>
                    <button onclick="declineListing(${listing.id})" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                        Decline
                    </button>
                </div>
            `;

                    window.dispatchEvent(new CustomEvent("open-modal", {
                        detail: "land-listing-modal"
                    }));
                    window.dispatchEvent(new CustomEvent("open-modal", {
                        detail: "land-listing-modalRes"
                    }));

                } catch (error) {
                    console.error("Error fetching listing details:", error);
                }
            }

            notificationBtns.forEach(btn => btn.addEventListener("click", fetchNewLandListings));
            setInterval(fetchNewLandListings, 5000);
            fetchNewLandListings();
        });
        async function approveListing(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to approve this listing?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, approve it!",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await fetch(`/landlistings/${id}/approve`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            },
                            body: JSON.stringify({
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            }),
                        });

                        Swal.fire({
                            title: "Approved!",
                            text: "The listing has been approved.",
                            icon: "success",
                            confirmButtonColor: "#28a745"
                        }).then(() => {
                            location.reload(); // Refresh the page
                        });
                    } catch (error) {
                        console.error("Error approving listing:", error);
                    }
                }
            });
        }

        async function declineListing(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to decline this listing?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, decline it!",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await fetch(`/landlistings/${id}/decline`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            },
                            body: JSON.stringify({
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            }),
                        });

                        Swal.fire({
                            title: "Declined!",
                            text: "The listing has been declined.",
                            icon: "success",
                            confirmButtonColor: "#d33"
                        }).then(() => {
                            location.reload(); // Refresh the page
                        });
                    } catch (error) {
                        console.error("Error declining listing:", error);
                    }
                }
            });
        }
    </script>
</nav>