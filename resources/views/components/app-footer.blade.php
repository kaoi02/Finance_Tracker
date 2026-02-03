<footer class="py-20 md:py-40">
    <x-container>
        <div class="m-auto md:w-10/12 lg:w-8/12 xl:w-6/12">
            <div class="flex flex-wrap items-center justify-between md:flex-nowrap">
                <div
                    class="flex w-full justify-center space-x-12 text-gray-600 dark:text-gray-300 sm:w-7/12 md:justify-start">
                    <ul class="list-inside list-disc space-y-8">
                        <li><a href="#" class="transition hover:text-primary">Home</a></li>
                        <li><a href="#" class="transition hover:text-primary">About</a></li>
                        <li><a href="#" class="transition hover:text-primary">Guide</a></li>
                        <!-- <li><a href="#" class="transition hover:text-primary">Contact</a></li> -->
                        <!-- <li><a href="#" class="transition hover:text-primary">Terms of Use</a></li> -->
                    </ul>

                    <ul role="list" class="space-y-8">
                        <li>
                            <a href="https://github.com/kaoi02"
                                class="flex items-center space-x-3 transition hover:text-primary" target="_blank">
                                <span class="font-bold">GH</span>
                                <span>Github</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/khairul-faidz-shah-90442112b"
                                class="flex items-center space-x-3 transition hover:text-primary" target="_blank">
                                <span class="font-bold">LI</span>
                                <span>LinkedIn</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/+601123979022"
                                class="flex items-center space-x-3 transition hover:text-primary" target="_blank">
                                <span class="font-bold">WA</span>
                                <span>WhatsApp</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="m-auto mt-16 w-10/12 space-y-6 text-center sm:mt-auto sm:w-5/12 sm:text-left">
                    <span class="block text-gray-500 dark:text-gray-400">Finance Tracker App</span>

                    <span class="block text-gray-500 dark:text-gray-400">&copy; <span id="year">{{ date('Y') }}</span>
                        FinanceTracker</span>

                    <span class="block text-xs text-gray-400 dark:text-gray-500 mt-6">
                        UI inspired by <a href="https://www.tailawesome.com/resources/astrolus" target="_blank"
                            class="hover:text-primary transition underline decoration-gray-300 dark:decoration-gray-700">Astrolus</a>
                    </span>

                    <span class="block text-gray-500 dark:text-gray-400">Need help? <a
                            href="https://wa.me/+601123979022" target="_blank"
                            class="font-bold hover:text-primary transition font-semibold text-gray-600 dark:text-white">Contact
                            Developer</a></span>
                </div>
            </div>
        </div>
    </x-container>
</footer>