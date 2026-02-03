<div x-data="{ 
        messages: [],
        remove(message) {
            this.messages = this.messages.filter(m => m.id !== message.id)
        }
    }" @toast.window="
        let id = Date.now();
        messages.push({
            id: id,
            type: $event.detail.type || 'info', 
            text: $event.detail.message,
            icon: $event.detail.type === 'success' ? 'check-circle' : ($event.detail.type === 'error' ? 'x-circle' : 'info')
        });
        setTimeout(() => {
            messages = messages.filter(m => m.id !== id)
        }, 5000)
    " class="fixed top-24 right-10 z-[100] flex flex-col items-end space-y-4 pointer-events-none">
    <template x-for="message in messages" :key="message.id">
        <div x-show="true" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-10 scale-95"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 translate-x-10 scale-95"
            class="pointer-events-auto flex items-center gap-3 min-w-[300px] p-4 rounded-2xl border bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl shadow-2xl shadow-gray-900/10 dark:shadow-none transition-all"
            :class="{
                'border-green-100 dark:border-green-900/30': message.type === 'success',
                'border-red-100 dark:border-red-900/30': message.type === 'error',
                'border-blue-100 dark:border-blue-900/30': message.type === 'info'
            }">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl shrink-0" :class="{
                    'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400': message.type === 'success',
                    'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400': message.type === 'error',
                    'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400': message.type === 'info'
                }">
                <!-- Success icon -->
                <svg x-show="message.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <!-- Error icon -->
                <svg x-show="message.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <!-- Info icon -->
                <svg x-show="message.type === 'info'" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="message.text"></p>
            </div>

            <button @click="remove(message)"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>