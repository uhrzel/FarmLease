<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Renting List Page') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 flex flex-col items-center space-y-6">
        @foreach ($carts as $cart)
        <div class="shadow-lg rounded-lg border p-6 w-2/3 relative 
            bg-white border-gray-300 dark:bg-gray-800 dark:border-gray-700">

            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">REMAINING BALANCE</h3>
            <div class="mt-3 p-4 text-lg font-bold bg-gray-100 dark:bg-gray-700 border border-gray-400 dark:border-gray-600 text-gray-800 dark:text-gray-200 rounded-xl w-1/2">
                ₱{{ number_format($cart->total_payment, 2) }}
            </div>

            <div class="flex items-center mt-6">
                <img src="{{ asset('storage/'.$cart->landListing->owner->identity_recognition) }}" alt="Profile Image" class="w-20 h-20 rounded-full border border-gray-300 dark:border-gray-600 shadow-lg">

                <div class="ml-4">
                    <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                        {{ $cart->landListing->owner->firstname ?? 'N/A' }} {{ $cart->landListing->owner->lastname ?? '' }}
                    </h4>
                    <p class="text-gray-600 dark:text-gray-400 font-medium">
                        {{ $cart->landListing->owner->role ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <hr class="my-4 border-gray-300 dark:border-gray-600">
            <p class="text-gray-700 dark:text-gray-300 font-medium">
                Rental Land: {{ $cart->landListing->location ?? 'N/A' }}
            </p>

            <div class="mt-6">
                <button
                    class="bg-lime-400 text-black dark:bg-lime-500 dark:text-white font-bold px-6 py-2 rounded-lg shadow-lg hover:bg-lime-500 dark:hover:bg-lime-600"
                    x-data
                    @click="$dispatch('open-modal', '{{ 'pay-modal-' . $cart->id }}')">
                    P A Y N O W
                </button>

            </div>
        </div>
        <x-modal name="pay-modal-{{ $cart->id }}">
            <form method="POST" action="{{ route('payment.process', $cart->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 text-left text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                    TOTAL COST: ₱<span id="calculated-cost-{{ $cart->id }}" name="calculated-cost">{{ number_format($cart->total_payment, 2) }}</span>
                </div>
                <input type="hidden" id="total-payment-{{ $cart->id }}" name="total_payment" value="{{ $cart->total_payment }}">
                <div class="grid grid-cols-4 gap-4">
                    <label class="cursor-pointer p-4 border rounded-lg flex flex-col items-center bg-white dark:bg-gray-700">
                        <img src="{{ asset('assets/images/paypal.png') }}" class="w-16 h-16" alt="PayPal">
                        <input type="radio" name="payment_option" value="PayPal" class="mt-2">
                    </label>

                    <label class="cursor-pointer p-4 border rounded-lg flex flex-col items-center bg-white dark:bg-gray-700">
                        <img src="{{ asset('assets/images/gcash.png') }}" class="w-16 h-16" alt="GCash">
                        <input type="radio" name="payment_option" value="GCash" class="mt-2">
                    </label>

                    <label class="cursor-pointer p-4 border rounded-lg flex flex-col items-center bg-white dark:bg-gray-700">
                        <img src="{{ asset('assets/images/paymaya.png') }}" class="w-16 h-16" alt="PayMaya">
                        <input type="radio" name="payment_option" value="PayMaya" class="mt-2">
                    </label>

                    <label class="cursor-pointer p-4 border rounded-lg flex flex-col items-center bg-white dark:bg-gray-700">
                        <img src="{{ asset('assets/images/grab.png') }}" class="w-16 h-16" alt="GrabPay">
                        <input type="radio" name="payment_option" value="GrabPay" class="mt-2">
                    </label>
                </div>

                <div class="mt-6 flex justify-center space-x-4">
                    <label for="monthly-btn-{{ $cart->id }}" class="relative inline-flex items-center justify-center px-16 py-6 text-lg font-semibold text-white rounded-2xl shadow-xl transition-all duration-300 bg-gradient-to-br from-green-400 to-blue-600 hover:from-green-500 hover:to-blue-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 cursor-pointer">
                        <input id="monthly-btn-{{ $cart->id }}" type="radio" name="plan" value="Monthly" class="hidden">
                        Monthly
                    </label>

                    <label for="yearly-btn-{{ $cart->id }}" class="relative inline-flex items-center justify-center px-16 py-6 text-lg font-semibold text-white rounded-2xl shadow-xl transition-all duration-300 bg-gradient-to-br from-green-400 to-blue-600 hover:from-green-500 hover:to-blue-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 cursor-pointer">
                        <input id="yearly-btn-{{ $cart->id }}" type="radio" name="plan" value="Yearly" class="hidden">
                        Yearly
                    </label>
                </div>

                <!-- Monthly/Yearly Dropdowns -->
                <div class="mt-6 hidden" id="monthly-options-{{ $cart->id }}">
                    <label class="block text-lg font-semibold text-gray-900 dark:text-gray-200">📆 Select Month Range</label>
                    <div class="flex space-x-4 mt-3">
                        <select id="start-month-{{ $cart->id }}" name="start-month" class="w-full p-3 border border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/60 backdrop-blur-lg text-gray-900 dark:text-gray-100 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:bg-white dark:hover:bg-gray-800">
                            <option value="" disabled selected>Start Month</option>
                            @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endforeach
                        </select>
                        <select id="end-month-{{ $cart->id }}" name="end-month" class="w-full p-3 border border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/60 backdrop-blur-lg text-gray-900 dark:text-gray-100 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:bg-white dark:hover:bg-gray-800">
                            <option value="" disabled selected>End Month</option>
                            @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6 hidden" id="yearly-options-{{ $cart->id }}">
                    <label class="block text-lg font-semibold text-gray-900 dark:text-gray-200">📅 Select Year Range</label>
                    <div class="flex space-x-4 mt-3">
                        <select id="start-year-{{ $cart->id }}" name="start-year" class="w-full p-3 border border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/60 backdrop-blur-lg text-gray-900 dark:text-gray-100 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:bg-white dark:hover:bg-gray-800">
                            <option value="" disabled selected>Start Year</option>
                            @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                        </select>
                        <select id="end-year-{{ $cart->id }}" name="end-year" class="w-full p-3 border border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/60 backdrop-blur-lg text-gray-900 dark:text-gray-100 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:bg-white dark:hover:bg-gray-800">
                            <option value="" disabled selected>End Year</option>
                            @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-lg font-semibold text-gray-900 dark:text-gray-200">📷 Upload Reference Image</label>
                    <input type="file" name="reference_image" accept="image/*" required
                        class="mt-2 w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                </div>
                <div class="mt-6 mb-2">
                    <button type="submit" class="w-full py-5 text-xl font-bold text-white rounded-2xl shadow-lg transition-all duration-300 bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-400">
                        SUBMIT
                    </button>
                </div>

            </form>
        </x-modal>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let cartId = "{{ $cart->id }}";

                let monthlyBtn = document.getElementById(`monthly-btn-${cartId}`);
                let yearlyBtn = document.getElementById(`yearly-btn-${cartId}`);
                let monthlyOptions = document.getElementById(`monthly-options-${cartId}`);
                let yearlyOptions = document.getElementById(`yearly-options-${cartId}`);
                let calculatedCost = document.getElementById(`calculated-cost-${cartId}`);
                let startMonth = document.getElementById(`start-month-${cartId}`);
                let endMonth = document.getElementById(`end-month-${cartId}`);
                let startYear = document.getElementById(`start-year-${cartId}`);
                let endYear = document.getElementById(`end-year-${cartId}`);
                let totalPaymentInput = document.getElementById(`total-payment-${cartId}`);
                let baseCost = parseFloat("{{ $cart->total_payment }}") || 0;
                if (monthlyBtn && yearlyBtn) {
                    monthlyBtn.addEventListener("click", function() {
                        monthlyOptions.classList.remove("hidden");
                        yearlyOptions.classList.add("hidden");
                    });

                    yearlyBtn.addEventListener("click", function() {
                        yearlyOptions.classList.remove("hidden");
                        monthlyOptions.classList.add("hidden");
                    });
                }

                function updateMonthlyCost() {
                    let start = parseInt(startMonth.value) || 0;
                    let end = parseInt(endMonth.value) || 0;

                    console.log("Start Month:", start);
                    console.log("End Month:", end);

                    if (start && end && end >= start) {
                        let months = end - start + 1;
                        cost = baseCost * months;
                        calculatedCost.innerText = cost.toFixed(2);
                        totalPaymentInput.value = cost;
                    }
                }

                function updateYearlyCost() {
                    let start = parseInt(startYear.value) || 0;
                    let end = parseInt(endYear.value) || 0;

                    console.log("Start Year:", start);
                    console.log("End Year:", end);

                    if (start && end && end >= start) {
                        let years = end - start + 1;
                        cost = baseCost * years * 12;
                        calculatedCost.innerText = cost.toFixed(2);
                        totalPaymentInput.value = cost;
                    }

                }

                if (startMonth && endMonth) {
                    startMonth.addEventListener("change", updateMonthlyCost);
                    endMonth.addEventListener("change", updateMonthlyCost);
                }

                if (startYear && endYear) {
                    startYear.addEventListener("change", updateYearlyCost);
                    endYear.addEventListener("change", updateYearlyCost);
                }
            });
        </script>

        @endforeach
    </div>

</x-app-layout>