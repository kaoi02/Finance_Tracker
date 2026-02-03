<div class="py-12">
    <div class="mb-12 space-y-2 text-center">
        <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Accounts</h2>
        <p class="lg:mx-auto lg:w-6/12 text-gray-600 dark:text-gray-300">
            Manage your financial sources. Track balances across checking, savings, and credit cards.
        </p>
    </div>

    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- New Account Form (Card) -->
        <div
            class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 p-8 lg:col-span-3">
            <div class="w-full">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-white mb-6 text-center">Add New Account</h3>
                <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Name</label>
                        <input wire:model="name" type="text"
                            class="w-full h-12 rounded-xl border border-gray-100 bg-gray-50 px-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition"
                            placeholder="e.g. Chase Checking">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Type</label>
                        <div class="relative">
                            <select wire:model="type"
                                class="w-full h-12 appearance-none rounded-xl border border-gray-100 bg-gray-50 px-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition">
                                <option value="checking">Checking</option>
                                <option value="savings">Savings</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="cash">Cash</option>
                            </select>
                            <div class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('type') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Initial
                            Balance</label>
                        <input wire:model="balance" type="number" step="0.01"
                            class="w-full h-12 rounded-xl border border-gray-100 bg-gray-50 px-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition">
                        @error('balance') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="relative flex h-12 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                            <span class="relative text-base font-semibold text-white">Add Account</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Cards -->
        @foreach($accounts as $account)
            <div
                class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 dark:border-gray-700 p-8">
                <div class="relative space-y-8">
                    <div class="flex justify-between items-start">
                        <!-- Icon based on type -->
                        <div
                            class="h-12 w-12 rounded-full bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center">
                            @if($account->type === 'credit_card')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            @elseif($account->type === 'cash')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>
                            @endif
                        </div>
                        <button wire:click="$set('idToDelete', {{ $account->id }}); $set('showDeleteModal', true)"
                            class="text-gray-400 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-2">
                        <h5
                            class="text-xl font-semibold text-gray-700 dark:text-white transition group-hover:text-secondary">
                            {{ $account->name }}
                        </h5>
                        <p class="text-sm text-gray-600 dark:text-gray-400 capitalize">
                            {{ str_replace('_', ' ', $account->type) }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <span
                            class="text-3xl font-bold {{ $account->balance < 0 ? 'text-red-500' : 'text-gray-800 dark:text-white' }}">
                            RM {{ number_format($account->balance, 2) }}
                        </span>
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">MYR</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Confirm Delete Modal -->
    <x-confirm-modal 
        wire:model="showDeleteModal" 
        title="Delete Account" 
        content="Are you sure you want to delete this account? This will also remove any record of its balance." 
    />
</div>