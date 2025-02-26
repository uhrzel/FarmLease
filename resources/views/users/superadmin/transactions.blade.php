<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-white leading-tight">
            {{ __('View Transactions') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg overflow-hidden">
            <div class="bg-primary text-white px-6 py-4">
                <h5 class="text-lg text-gray-800 dark:text-gray-300 font-semibold mb-0">Tenant Transactions</h5>
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-900 text-white dark:bg-gray-700">
                        <tr class="text-left">
                            <th class="px-4 py-2">Tenant</th>
                            <th class="px-4 py-2">Landowner</th>
                            <th class="px-4 py-2">Location</th>
                            <th class="px-4 py-2 text-center">Land Price</th>
                            <th class="px-4 py-2 text-center">Transaction Date</th>
                            <th class="px-4 py-2 text-center">Payment Option</th>
                            <th class="px-4 py-2 text-center">Amount Paid</th>
                            <th class="px-4 py-2 text-center">Payment Frequency</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Lease Period</th>
                            <th class="px-4 py-2 text-center">Pending Balance</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800 dark:text-gray-300">
                        @foreach ($transactions->where('user.role', 'tenant') as $transaction)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-4 py-3">{{ $transaction->user->firstname ?? 'N/A' }} {{ $transaction->user->lastname ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $transaction->landListing->landowner_name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $transaction->landListing->location ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($transaction->landListing->price, 2) }}</td>
                            <td class="px-4 py-3 text-center">{{ $transaction->updated_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-center">{{ $transaction->payment_option }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($transaction->down_payment, 2) }}</td>
                            <td class="px-4 py-3 text-center">{{ $transaction->plan ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-3 py-1 rounded-full text-white 
                                        {{ $transaction->status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if (is_null($transaction->start_year) && is_null($transaction->end_year))
                                {{ \Carbon\Carbon::parse($transaction->start_month)->format('F d, Y') ?? 'N/A' }} -
                                {{ \Carbon\Carbon::parse($transaction->end_month)->format('F d, Y') ?? 'N/A' }}
                                @else
                                {{ $transaction->start_year ?? 'N/A' }} - {{ $transaction->end_year ?? 'N/A' }}
                                @endif
                            </td>


                            <td class="px-4 py-3 text-center">{{ number_format($transaction->total_payment, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Leasee Transactions Table -->
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg overflow-hidden mt-8">
            <div class="bg-primary text-white px-6 py-4">
                <h5 class="text-lg text-gray-800 dark:text-gray-300 font-semibold mb-0">Leasee Transactions</h5>
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-900 text-white dark:bg-gray-700">
                        <tr class="text-left">
                            <th class="px-4 py-2">Leasee</th>
                            <th class="px-4 py-2">Landowner</th>
                            <th class="px-4 py-2">Location</th>
                            <th class="px-4 py-2 text-center">Land Price</th>
                            <th class="px-4 py-2 text-center">Transaction Date</th>
                            <th class="px-4 py-2 text-center">Payment Option</th>
                            <th class="px-4 py-2 text-center">Amount Paid</th>
                            <th class="px-4 py-2 text-center">Payment Frequency</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Lease Period</th>
                            <th class="px-4 py-2 text-center">Pending Balance</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800 dark:text-gray-300">
                        @foreach ($transactions->where('user.role', 'lessee') as $transaction)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-4 py-3">{{ $transaction->user->firstname ?? 'N/A' }} {{ $transaction->user->lastname ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $transaction->landListing->landowner_name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $transaction->landListing->location ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($transaction->landListing->price, 2) }}</td>
                            <td class="px-4 py-3 text-center">{{ $transaction->updated_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-center">{{ $transaction->payment_option }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($transaction->down_payment, 2) }}</td>
                            <td class="px-4 py-3 text-center">{{ $transaction->plan ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-3 py-1 rounded-full text-white 
                                        {{ $transaction->status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if (is_null($transaction->start_year) && is_null($transaction->end_year))
                                {{ \Carbon\Carbon::parse($transaction->start_month)->format('F d, Y') ?? 'N/A' }} -
                                {{ \Carbon\Carbon::parse($transaction->end_month)->format('F d, Y') ?? 'N/A' }}
                                @else
                                {{ $transaction->start_year ?? 'N/A' }} - {{ $transaction->end_year ?? 'N/A' }}
                                @endif
                            </td>


                            <td class="px-4 py-3 text-center">{{ number_format($transaction->total_payment, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>