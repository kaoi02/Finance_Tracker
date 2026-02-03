<div>
    <div class="relative" id="home">
        <div aria-hidden="true"
            class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20 pointer-events-none">
            <div class="blur-[106px] h-56 bg-gradient-to-br from-primary to-purple-400 dark:from-blue-700"></div>
            <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-400 to-sky-300 dark:to-indigo-600"></div>
        </div>

        <div class="relative pt-12 ml-auto">
            <div class="lg:w-2/3 text-center mx-auto mb-12">
                <h1 class="text-gray-900 text-balance dark:text-white font-bold text-5xl md:text-6xl xl:text-7xl">
                    Financial health, <span class="text-primary dark:text-white">reimagined.</span>
                </h1>
                <p class="mt-8 text-gray-700 dark:text-gray-300">
                    Track your net worth, monitor expenses, and stay on top of your budget with atomic precision.
                </p>

                <!-- Stats Cards -->
                <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 md:gap-8">
                    <!-- Total Assets -->
                    <div
                        class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 p-8">
                        <div class="space-y-4 text-center">
                            <h3 class="text-lg font-medium text-gray-600 dark:text-gray-300">Total Assets</h3>
                            <p class="text-4xl font-bold text-green-600 dark:text-green-400">
                                RM {{ number_format($totalAssets, 2) }}
                            </p>
                            <div
                                class="h-1 w-24 mx-auto bg-green-200 dark:bg-green-900/50 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 w-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Debt -->
                    <div
                        class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 p-8">
                        <div class="space-y-4 text-center">
                            <h3 class="text-lg font-medium text-gray-600 dark:text-gray-300">Total Debt</h3>
                            <p class="text-4xl font-bold text-red-600 dark:text-red-400">
                                RM {{ number_format(abs($totalDebt), 2) }}
                            </p>
                            <div class="h-1 w-24 mx-auto bg-red-200 dark:bg-red-900/50 rounded-full overflow-hidden">
                                <div class="h-full bg-red-500 w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="mt-20">
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Recent Activity</h2>
                    <a href="{{ route('transactions') }}"
                        class="text-primary hover:text-secondary font-medium transition">View All &rarr;</a>
                </div>

                <div
                    class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 rounded-l-xl">
                                        Date</th>
                                    <th
                                        class="p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                        Description</th>
                                    <th
                                        class="p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 text-right rounded-r-xl">
                                        Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($recentTransactions as $transaction)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <td class="p-4 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $transaction->date->format('M d') }}
                                        </td>
                                        <td class="p-4 text-sm font-medium text-gray-800 dark:text-white">
                                            <div class="flex items-center gap-2">
                                                <span>{{ $transaction->category?->icon }}</span>
                                                <span>{{ $transaction->description }}</span>
                                            </div>
                                        </td>
                                        <td
                                            class="p-4 text-sm font-bold text-right {{ $transaction->amount < 0 ? 'text-red-500' : 'text-green-500' }}">
                                            RM {{ number_format(abs($transaction->amount), 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                            No recent activity. <a href="{{ route('transactions') }}"
                                                class="text-primary underline">Record a transaction</a>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>