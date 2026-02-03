<header>
    <nav x-data="{ isToggled: false }" id="nav"
        class="absolute group z-30 w-full border-b border-black/5 dark:border-white/5 lg:border-transparent">
        <x-container>
            <div class="relative flex flex-wrap items-center justify-between gap-6 py-3 md:gap-0 md:py-4">
                <div class="relative z-20 flex w-full justify-between md:px-0 lg:w-fit">
                    <a href="/" aria-label="logo" class="flex items-center space-x-3">
                        <div aria-hidden="true"
                            class="flex items-center justify-center h-10 w-10 rounded-xl bg-primary/10 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="5" rx="2" />
                                <line x1="2" x2="22" y1="10" y2="10" />
                                <line x1="7" x2="7" y1="15" y2="15" />
                                <line x1="11" x2="11" y1="15" y2="15" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">Finance Tracker</span>
                    </a>

                    <div class="relative flex max-h-10 items-center lg:hidden">
                        <button @click="isToggled = !isToggled" aria-label="humburger" id="hamburger"
                            class="relative -mr-6 p-6 active:scale-95 duration-300">
                            <div aria-hidden="true" id="line" :class="isToggled ? 'rotate-45 translate-y-1.5' : ''"
                                class="m-auto h-0.5 w-5 rounded bg-gray-950 transition duration-300 dark:bg-white origin-top">
                            </div>
                            <div aria-hidden="true" id="line2" :class="isToggled ? '-rotate-45 -translate-y-1' : ''"
                                class="m-auto mt-2 h-0.5 w-5 rounded bg-gray-950 transition duration-300 dark:bg-white origin-bottom">
                            </div>
                        </button>
                    </div>
                </div>
                <div id="navLayer" aria-hidden="true"
                    :class="isToggled ? 'origin-top scale-y-100' : 'origin-bottom scale-y-0'"
                    class="fixed inset-0 z-10 h-screen w-screen bg-white/70 backdrop-blur-2xl transition duration-500 dark:bg-gray-950/70 lg:hidden">
                </div>

                <div id="navlinks"
                    :class="isToggled ? 'visible scale-100 opacity-100 translate-y-0' : 'invisible scale-90 opacity-0 translate-y-1 lg:visible lg:scale-100 lg:opacity-100 lg:translate-y-0'"
                    class="absolute top-full left-0 z-20 w-full origin-top-right flex-col flex-wrap justify-end gap-6 rounded-3xl border border-gray-100 bg-white p-8 shadow-2xl shadow-gray-600/10 transition-all duration-300 dark:border-gray-700 dark:bg-gray-800 dark:shadow-none lg:relative lg:flex lg:w-fit lg:flex-row lg:items-center lg:gap-0 lg:border-none lg:bg-transparent lg:p-0 lg:shadow-none lg:dark:bg-transparent">
                    <div class="w-full text-gray-600 dark:text-gray-200 lg:w-auto lg:pr-4 lg:pt-0">
                        <div id="links-group" class="flex flex-col gap-6 tracking-wide lg:flex-row lg:gap-0 lg:text-sm">
                            <a href="{{ route('dashboard') }}"
                                class="hover:text-primary block transition dark:hover:text-white md:px-4">
                                <span>Main Page</span>
                            </a>
                            <!-- <a href="{{ route('about') }}"
                                class="hover:text-primary block transition dark:hover:text-white md:px-4">
                                <span>About</span>
                            </a>
                            <a href="{{ route('guide') }}"
                                class="hover:text-primary block transition dark:hover:text-white md:px-4">
                                <span>Guide</span>
                            </a> -->
                            <a href="{{ route('accounts') }}"
                                class="hover:text-primary block transition dark:hover:text-white md:px-4">
                                <span>Accounts</span>
                            </a>
                            <a href="{{ route('categories') }}"
                                class="hover:text-primary block transition dark:hover:text-white md:px-4">
                                <span>Categories</span>
                            </a>
                            <a href="{{ route('transactions') }}"
                                class="hover:text-primary block transition dark:hover:text-white md:px-4">
                                <span>Transactions</span>
                            </a>
                        </div>
                    </div>

                    <!-- <div class="mt-12 lg:mt-0">
                        <a href="#"
                            class="relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                            <span class="relative text-sm font-semibold text-white">Get Started</span>
                        </a>
                    </div> -->
                </div>
            </div>
        </x-container>
    </nav>
</header>