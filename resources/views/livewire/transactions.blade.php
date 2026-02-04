<div class="py-12">
    <div class="mb-12 space-y-2 text-center">
        <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Transactions</h2>
        <p class="lg:mx-auto lg:w-6/12 text-gray-600 dark:text-gray-300">
            Log your income and expenses. Keep your accounts up to date.
        </p>
    </div>

    <div class="space-y-8">
        <!-- New Transaction Form (Card) -->
        <div
            class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 p-8">
            <h3 class="text-xl font-semibold text-gray-700 dark:text-white mb-6">Record Transaction</h3>
            <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-6 gap-6 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Date</label>
                    <input wire:model="date" type="date"
                        class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    @error('date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Description</label>
                    <input wire:model="description" type="text"
                        class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        placeholder="Grocery">
                    @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Account</label>
                    <select wire:model="account_id"
                        class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}
                                ({{ number_format($account->balance, 2) }})</option>
                        @endforeach
                    </select>
                    @error('account_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Category</label>
                    <select wire:model="category_id"
                        class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Amount</label>
                    <input wire:model="amount" type="number" step="0.01"
                        class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    @error('amount') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </form>
            <div class="mt-6 flex justify-end">
                <button wire:click="store"
                    class="relative flex h-11 w-full md:w-auto items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                    <span class="relative text-base font-semibold text-white">Record Transaction</span>
                </button>
            </div>
        </div>

        <!-- Transactions List -->
        <div
            class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-6 flex items-center justify-between gap-4 mb-4">
                <div class="flex items-center gap-4 flex-1">
                    <div class="relative flex-1 md:max-w-72">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search transactions..."
                            class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition">
                    </div>
                    <a href="{{ route('settings') }}" title="Data Management"
                        class="flex items-center justify-center p-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-400 hover:text-primary hover:border-primary/50 dark:border-gray-700 dark:bg-gray-900 transition shrink-0 group/tool">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 group-hover/tool:scale-110 transition duration-300" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                            <line x1="12" x2="12" y1="15" y2="3" />
                        </svg>
                    </a>
                </div>

                <div class="flex items-center gap-4 shrink-0">
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600 dark:text-gray-400">Account</label>
                        <select wire:model.live="accountFilter"
                            class="rounded-xl border border-gray-100 bg-gray-50 py-2 pl-3 pr-8 text-sm text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition cursor-pointer">
                            <option value="">All Accounts</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600 dark:text-gray-400">Show</label>
                        <select wire:model.live="perPage"
                            class="rounded-xl border border-gray-100 bg-gray-50 py-2 pl-3 pr-8 text-sm text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition cursor-pointer">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-6 overflow-x-auto pt-0">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('date')"
                                class="cursor-pointer p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 rounded-l-xl hover:text-primary transition group/header">
                                <div class="flex items-center gap-1">
                                    Date
                                    <span
                                        class="{{ $sortField === 'date' ? 'text-primary' : 'text-gray-300 dark:text-gray-600 group-hover/header:text-gray-500' }}">
                                        @if($sortField === 'date' && $sortDirection === 'desc') ↓ @else ↑ @endif
                                    </span>
                                </div>
                            </th>
                            <th
                                class="p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Description
                            </th>
                            <th wire:click="sortBy('category')"
                                class="cursor-pointer p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 hover:text-primary transition group/header">
                                <div class="flex items-center gap-1">
                                    Category
                                    <span
                                        class="{{ $sortField === 'category' ? 'text-primary' : 'text-gray-300 dark:text-gray-600 group-hover/header:text-gray-500' }}">
                                        @if($sortField === 'category' && $sortDirection === 'desc') ↓ @else ↑ @endif
                                    </span>
                                </div>
                            </th>
                            <th wire:click="sortBy('account')"
                                class="cursor-pointer p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 hover:text-primary transition group/header">
                                <div class="flex items-center gap-1">
                                    Account
                                    <span
                                        class="{{ $sortField === 'account' ? 'text-primary' : 'text-gray-300 dark:text-gray-600 group-hover/header:text-gray-500' }}">
                                        @if($sortField === 'account' && $sortDirection === 'desc') ↓ @else ↑ @endif
                                    </span>
                                </div>
                            </th>
                            <th wire:click="sortBy('amount')"
                                class="cursor-pointer p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 text-right hover:text-primary transition group/header">
                                <div class="flex items-center justify-end gap-1">
                                    Amount
                                    <span
                                        class="{{ $sortField === 'amount' ? 'text-primary' : 'text-gray-300 dark:text-gray-600 group-hover/header:text-gray-500' }}">
                                        @if($sortField === 'amount' && $sortDirection === 'desc') ↓ @else ↑ @endif
                                    </span>
                                </div>
                            </th>
                            <th
                                class="p-4 bg-gray-50 dark:bg-gray-900/50 text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 text-right rounded-r-xl">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="p-4 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $transaction->date->format('Y-m-d') }}
                                </td>
                                <td class="p-4 text-sm font-medium text-gray-800 dark:text-white">
                                    {{ $transaction->description }}
                                </td>
                                <td class="p-4 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="inline-flex items-center gap-1">
                                        <span>{{ $transaction->category?->icon }}</span>
                                        <span>{{ $transaction->category?->name ?? 'N/A' }}</span>
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ $transaction->account->name }}
                                </td>
                                <td
                                    class="p-4 text-sm font-bold text-right {{ $transaction->amount < 0 ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $currency }} {{ number_format(abs($transaction->amount), 2) }}
                                </td>
                                <td class="p-4 text-sm text-right">
                                    <button
                                        wire:click="$set('idToDelete', {{ $transaction->id }}); $set('showDeleteModal', true)"
                                        class="text-red-500 hover:text-red-700 transition">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $transactions->links('vendor.pagination.modern') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <x-confirm-modal wire:model="showDeleteModal" title="Delete Transaction"
        content="Are you sure you want to delete this transaction? This will also revert the account balance update." />
</div>