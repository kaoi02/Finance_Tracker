@props(['id', 'title' => 'Delete Item', 'content' => 'Are you sure you want to delete this? This action cannot be undone.'])

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-show="show" @keydown.escape.window="show = false"
    class="fixed inset-0 z-[110] overflow-y-auto" style="display: none;">
    <!-- Overlay -->
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="flex min-h-screen items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!-- Modal panel -->
        <div x-show="show" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="show = false"
            class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-gray-900 px-4 pb-4 pt-5 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6 border border-gray-100 dark:border-gray-800">
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 dark:bg-red-900/30 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.34c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-xl font-bold leading-6 text-gray-900 dark:text-white" id="modal-title">{{ $title }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $content }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 sm:flex sm:flex-row-reverse sm:gap-3">
                <button type="button" wire:click="confirmDelete"
                    class="inline-flex w-full justify-center rounded-2xl bg-red-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-500 transition sm:w-auto">
                    Confirm Delete
                </button>
                <button type="button" @click="show = false"
                    class="mt-3 inline-flex w-full justify-center rounded-2xl bg-white dark:bg-gray-800 px-6 py-3 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition sm:mt-0 sm:w-auto">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>