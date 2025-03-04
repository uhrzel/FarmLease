<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mail Notification') }}
        </h2>
    </x-slot>


    <style>
        .loader {
            width: 60px;
            height: 60px;
            background: linear-gradient(#00ff00 calc(1*100%/6), #fff 0 calc(3*100%/6), #00ff00 0),
                linear-gradient(#00ff00 calc(2*100%/6), #fff 0 calc(4*100%/6), #00ff00 0),
                linear-gradient(#00ff00 calc(3*100%/6), #fff 0 calc(5*100%/6), #00ff00 0);
            background-size: 15px 400%;
            background-repeat: no-repeat;
            animation: matrix 1s infinite linear;
        }

        @keyframes matrix {
            0% {
                background-position: 0% 100%, 50% 100%, 100% 100%;
            }

            100% {
                background-position: 0% 0%, 50% 0%, 100% 0%;
            }
        }
    </style>

    <div id="loader" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="loader"></div>
    </div>

    <div class="container mx-auto py-6 px-4">
        <div class="space-y-6">
            @foreach($tenants as $tenant)
            <div class="bg-white dark:bg-gray-900 shadow-md dark:shadow-lg dark:shadow-gray-800 rounded-lg p-6 flex flex-col items-center transition duration-300">
                <div class="flex items-center space-x-4">
                    <img src="{{ $tenant->avatar ? asset('storage/' . $tenant->avatar) : asset('user-default.png') }}"
                        alt="Profile Image"
                        class="h-16 w-16 rounded-full border-2 border-gray-300 dark:border-gray-600 shadow-md dark:shadow-lg dark:shadow-gray-800">
                </div>

                <h5 class="font-semibold mt-2 text-gray-800 dark:text-gray-200">
                    {{ strtoupper($tenant->firstname) }} {{ strtoupper($tenant->lastname) }}
                </h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">TENANT</span>

                <div class="flex flex-wrap sm:flex-nowrap sm:space-x-2 mt-4 gap-2 sm:gap-0">
                    <span class="notification-btn px-4 py-2 bg-gray-700 text-white text-xs rounded-full dark:bg-gray-600 cursor-pointer border border-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all"
                        data-subject="Expiration"
                        data-email="{{ $tenant->email }}"
                        tabindex="0">Expiration</span>

                    <span class="notification-btn px-4 py-2 bg-green-600 text-white text-xs rounded-full dark:bg-green-500 cursor-pointer border border-green-500 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all"
                        data-subject="Update New Feature"
                        data-email="{{ $tenant->email }}"
                        tabindex="0">Update New Feature</span>

                    <span class="notification-btn px-4 py-2 bg-yellow-600 text-white text-xs rounded-full dark:bg-yellow-500 cursor-pointer border border-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-all"
                        data-subject="Issues Profile"
                        data-email="{{ $tenant->email }}"
                        tabindex="0">Issues Profile</span>

                    <span class="notification-btn px-4 py-2 bg-red-600 text-white text-xs rounded-full dark:bg-red-500 cursor-pointer border border-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all"
                        data-subject="Emergency"
                        data-email="{{ $tenant->email }}"
                        tabindex="0">Emergency</span>
                </div>
                <div class="flex items-center w-full mt-4">
                    <input type="text" id="message-{{ $tenant->email }}" placeholder="Type message..."
                        class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm dark:shadow-md dark:shadow-gray-800">
                    <button class="send-btn ml-2 bg-green-500 dark:bg-green-400 text-white px-3 py-2 rounded-lg hover:bg-green-600 dark:hover:bg-green-500 transition shadow-md dark:shadow-lg dark:shadow-gray-800 w-auto text-sm flex items-center space-x-1 hover:scale-105"
                        data-email="{{ $tenant->email }}">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.querySelectorAll('.send-btn').forEach(button => {
            button.addEventListener('click', function() {
                let email = this.getAttribute('data-email');
                let message = document.getElementById('message-' + email).value;
                let subject = document.querySelector('.selected-subject[data-email="' + email + '"]');

                if (!message) {
                    toastr.error('Please enter a message.');
                    return;
                }

                if (!subject) {
                    toastr.error('Please select a subject.');
                    return;
                }

                document.getElementById('loader').classList.remove('hidden');
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                this.disabled = true;

                fetch('{{ route("send.email") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            email: email,
                            subject: subject.innerText,
                            message: message
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            toastr.error(data.message);
                        }
                    })
                    .catch(error => {
                        toastr.error('An error occurred.');
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        document.getElementById('loader').classList.add('hidden');
                        this.innerHTML = '<i class="fas fa-paper-plane"></i> Send';
                        this.disabled = false;
                    });
            });
        });

        document.querySelectorAll('.notification-btn').forEach(button => {
            button.addEventListener('click', function() {
                let email = this.getAttribute('data-email');
                document.querySelectorAll('.selected-subject[data-email="' + email + '"]').forEach(el => el.classList.remove('selected-subject'));
                this.classList.add('selected-subject');
            });
        });
    </script>

</x-app-layout>