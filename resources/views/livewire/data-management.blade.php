<div class="py-12">
    <div class="mb-12 space-y-2 text-center">
        <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Settings & Data</h2>
        <p class="lg:mx-auto lg:w-6/12 text-gray-600 dark:text-gray-300">
            Manage your financial data and app preferences.
        </p>
    </div>

    <!-- App Preferences -->
    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Theme Selection -->
        <div class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center h-12 w-12 rounded-2xl bg-purple-500/10 text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-white">Theme Preference</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Choose how the application looks.</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                @foreach(['light' => 'Light', 'dark' => 'Dark', 'system' => 'System'] as $value => $label)
                    <button wire:click="$set('theme', '{{ $value }}')"
                        class="flex flex-col items-center justify-center p-4 rounded-2xl border transition {{ $theme === $value ? 'bg-primary/10 border-primary text-primary' : 'bg-gray-50 border-gray-100 dark:bg-gray-900 dark:border-gray-700 text-gray-500 hover:border-primary/50' }}">
                        <span class="text-xs font-semibold uppercase tracking-wider">{{ $label }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Currency Selection -->
        <div class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center h-12 w-12 rounded-2xl bg-amber-500/10 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-white">Currency Settings</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Select your preferred currency symbol.</p>
                </div>
            </div>
            <select wire:model.live="currency"
                    class="w-full rounded-2xl border border-gray-100 bg-gray-50 p-4 text-gray-600 outline-none focus:border-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 transition">
                <option value="RM">RM (Malaysian Ringgit)</option>
                <option value="$">$ (USD)</option>
                <option value="€">€ (Euro)</option>
                <option value="£">£ (British Pound)</option>
                <option value="¥">¥ (Japanese Yen)</option>
                <option value="Rp">Rp (Indonesian Rupiah)</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Export Card -->
        <div
            class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center h-12 w-12 rounded-2xl bg-blue-500/10 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-white">Export Data</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Download your transactions in CSV format.</p>
                </div>
            </div>

            <button wire:click="export"
                class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                <span class="relative text-base font-semibold text-white">Download CSV Export</span>
            </button>
        </div>

        <!-- Import Card -->
        <div
            class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center h-12 w-12 rounded-2xl bg-green-500/10 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" x2="12" y1="3" y2="15" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-white">Import Data</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Upload a CSV file to add multiple transactions.
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Select CSV
                        File</label>
                    <input type="file" wire:model="csvFile"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">

                    @error('csvFile') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                    <!-- Progress Bar -->
                    <div x-show="isUploading"
                        class="mt-4 h-1 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-primary transition-all duration-300" :style="'width: ' + progress + '%'">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button wire:click="import" wire:loading.attr="disabled"
                        class="relative flex h-11 flex-1 items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 disabled:opacity-50">
                        <span class="relative text-base font-semibold text-white" wire:loading.remove
                            wire:target="import">Process Import</span>
                        <span class="relative text-base font-semibold text-white" wire:loading
                            wire:target="import">Processing...</span>
                    </button>

                    <button wire:click="downloadTemplate"
                        class="relative flex h-11 items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:border before:border-gray-200 dark:before:border-gray-700 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                        <span class="relative text-sm font-medium text-gray-600 dark:text-gray-300">Template</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if($importResults)
        <div
            class="mt-12 group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10 rounded-3xl border border-gray-100 shadow-sm dark:shadow-none dark:border-gray-700 p-8">
            <h3 class="text-xl font-semibold text-gray-700 dark:text-white mb-6">Import Results</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="p-4 rounded-2xl bg-green-500/10 border border-green-500/20">
                    <p class="text-sm text-green-600 dark:text-green-400 font-medium">Successfully Imported</p>
                    <p class="text-3xl font-bold text-green-700 dark:text-green-300 font-mono">
                        {{ $importResults['success'] }}
                    </p>
                </div>
                <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/20">
                    <p class="text-sm text-red-600 dark:text-red-400 font-medium">Failed Records</p>
                    <p class="text-3xl font-bold text-red-700 dark:text-red-300 font-mono">
                        {{ $importResults['errorCount'] }}
                    </p>
                </div>
            </div>

            @if(count($importResults['errors']) > 0)
                <div class="space-y-4">
                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Error Details</h4>
                    <div class="max-h-60 overflow-y-auto space-y-2 pr-2">
                        @foreach($importResults['errors'] as $error)
                            <div
                                class="p-3 text-xs bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl border border-red-100 dark:border-red-900/30">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>