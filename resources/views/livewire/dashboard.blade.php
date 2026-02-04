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
                        class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
                        <div class="space-y-4 text-center">
                            <h3 class="text-lg font-medium text-gray-600 dark:text-gray-300">Total Assets</h3>
                            <p class="text-4xl font-bold text-green-600 dark:text-green-400">
                                {{ $currency }} {{ number_format($totalAssets, 2) }}
                            </p>
                            <div
                                class="h-1 w-24 mx-auto bg-green-200 dark:bg-green-900/50 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 w-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Debt -->
                    <div
                        class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
                        <div class="space-y-4 text-center">
                            <h3 class="text-lg font-medium text-gray-600 dark:text-gray-300">Total Debt</h3>
                            <p class="text-4xl font-bold text-red-600 dark:text-red-400">
                                {{ $currency }} {{ number_format(abs($totalDebt), 2) }}
                            </p>
                            <div class="h-1 w-24 mx-auto bg-red-200 dark:bg-red-900/50 rounded-full overflow-hidden">
                                <div class="h-full bg-red-500 w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Insights Section -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <!-- Spending Breakdown Chart -->
                <div class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8"
                    x-init="
                        new ApexCharts($refs.chart, {
                            series: {{ json_encode($spendingByCategory->pluck('total')->map(fn($v) => (float) $v)) }},
                            labels: {{ json_encode($spendingByCategory->pluck('name')) }},
                            chart: {
                                type: 'donut',
                                height: 350,
                                fontFamily: 'Urbanist, sans-serif',
                                foreColor: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563',
                                toolbar: { show: false }
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '70%',
                                        labels: {
                                            show: true,
                                            value: {
                                                show: true,
                                                formatter: (val) => '{{ $currency }} ' + parseFloat(val).toLocaleString(undefined, {minimumFractionDigits: 2})
                                            },
                                            total: {
                                                show: true,
                                                label: 'Total Spend',
                                                fontSize: '14px',
                                                fontWeight: 600,
                                                formatter: (w) => '{{ $currency }} ' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString(undefined, {minimumFractionDigits: 2})
                                            }
                                        }
                                    }
                                }
                            },
                            stroke: { show: false },
                            dataLabels: {
                                enabled: true,
                                formatter: (val, opt) => opt.w.globals.labels[opt.seriesIndex] + ': ' + val.toFixed(1) + '%'
                            },
                            tooltip: {
                                y: {
                                    formatter: (val) => '{{ $currency }} ' + val.toLocaleString(undefined, {minimumFractionDigits: 2})
                                }
                            },
                            legend: { position: 'bottom' },
                            theme: {
                                monochrome: {
                                    enabled: true,
                                    color: '#4f46e5',
                                    shadeTo: 'light',
                                    shadeIntensity: 0.65
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: { chart: { width: 300 }, legend: { position: 'bottom' } }
                            }]
                        }).render();
                     ">
                    <h2 class=" text-xl font-bold text-gray-900 dark:text-white mb-6">Spending Breakdown</h2>
                    <div x-ref="chart"></div>
                </div>

                <!-- Account Summary / Tip -->
                <div
                    class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8 h-full flex flex-col justify-center text-center">
                    <div class="lg:w-2/3 mx-auto">
                        @php
                            $savings = $monthlyIncome - $monthlyExpenses;
                            $savingsRate = $monthlyIncome > 0 ? ($savings / $monthlyIncome) * 100 : 0;
                            $topCategory = $spendingByCategory->sortByDesc('total')->first();
                        @endphp

                        @if($monthlyIncome == 0 && $monthlyExpenses == 0)
                            <!-- Case 1: No Data -->
                            <div
                                class="h-16 w-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Start Your Journey</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">
                                Record your first transaction to see your financial health reimagined.
                            </p>
                        @elseif($monthlyExpenses > $monthlyIncome && $monthlyIncome > 0)
                            <!-- Case 2: Overspent -->
                            <div
                                class="h-16 w-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-red-50 dark:bg-red-900/20 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Budget Alert</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">
                                Your spending ({{ $currency }} {{ number_format($monthlyExpenses, 2) }}) has exceeded your
                                income this month. Consider reviewing your <span
                                    class="text-primary font-bold">{{ $topCategory?->name }}</span> expenses.
                            </p>
                        @elseif($savingsRate >= 20)
                            <!-- Case 3: High Savings Rate -->
                            <div
                                class="h-16 w-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-green-50 dark:bg-green-900/20 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125V18.75m-1.125 1.125h-4.461m2.81-9.983L9.166 15.084m0 0l-1.125-1.125m1.125 1.125l1.125 1.125" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Savings Hero</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">
                                Amazing! You've saved <span
                                    class="text-green-600 font-bold">{{ number_format($savingsRate, 0) }}%</span> of your
                                income this month. Keep building that wealth!
                            </p>
                        @else
                            <!-- Case 4: Standard Insight -->
                            <div
                                class="h-16 w-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-8 h-8 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Smart Insights</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">
                                Your <span class="text-primary font-bold">{{ $topCategory?->name ?? 'None' }}</span>
                                category is your top expense this month, totaling <span class="font-bold">{{ $currency }}
                                    {{ number_format($topCategory?->total ?? 0, 2) }}</span>.
                            </p>
                        @endif

                        <div class="mt-8">
                            <a href="{{ route('transactions') }}"
                                class="font-bold text-primary hover:text-secondary transition underline">Analyze
                                Transactions &rarr;</a>
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
                    class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 overflow-hidden">
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
                                            {{ $currency }} {{ number_format(abs($transaction->amount), 2) }}
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