<div class="py-12">
    <div class="mb-12 space-y-2 text-center">
        <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Categories</h2>
        <p class="lg:mx-auto lg:w-6/12 text-gray-600 dark:text-gray-300">
            Organize your transactions. Categorize income and expenses for better tracking.
        </p>
    </div>

    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
        <!-- New Category Form (Card) -->
        <div
            class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8 lg:col-span-4">
            <div class="w-full">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-white mb-6 text-center">Add New Category</h3>
                <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Name</label>
                        <input wire:model="name" type="text"
                            class="w-full h-12 rounded-xl border border-gray-100 bg-gray-50 px-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition"
                            placeholder="e.g. Groceries">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Icon
                            (Emoji)</label>
                        <input wire:model="icon" type="text"
                            class="w-full h-12 rounded-xl border border-gray-100 bg-gray-50 px-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition"
                            placeholder="🛒">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Type</label>
                        <div class="relative">
                            <select wire:model="type"
                                class="w-full h-12 appearance-none rounded-xl border border-gray-100 bg-gray-50 px-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition">
                                <option value="expense">Expense</option>
                                <option value="income">Income</option>
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
                    </div>
                    <div>
                        <button type="submit"
                            class="relative flex h-12 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                            <span class="relative text-base font-semibold text-white">Add Category</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @foreach($categories as $category)
            <div
                class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-6 flex flex-col justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="h-12 w-12 rounded-full {{ $category->type == 'income' ? 'bg-green-100 dark:bg-green-900/20 text-green-600' : 'bg-orange-100 dark:bg-orange-900/20 text-orange-600' }} flex items-center justify-center text-2xl">
                        {{ $category->icon ?: ($category->type == 'income' ? '💰' : '💸') }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-700 dark:text-white">{{ $category->name }}</h4>
                        <span
                            class="text-xs uppercase font-bold {{ $category->type == 'income' ? 'text-green-500' : 'text-orange-500' }}">{{ $category->type }}</span>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button wire:click="$set('idToDelete', {{ $category->id }}); $set('showDeleteModal', true)"
                        class="text-sm text-gray-400 hover:text-red-500 transition">Delete</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Confirm Delete Modal -->
    <x-confirm-modal wire:model="showDeleteModal" title="Delete Category"
        content="Are you sure you want to delete this category? Transactions using this category may become uncategorized." />
</div>