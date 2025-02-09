@props(['error'])
@if ($error)
    <div
        class="group pointer-events-none flex w-full flex-col gap-2 bg-transparent py-6 transition duration-150 ease-in-out">
        <!-- Notification -->
        <div class="pointer-events-auto relative rounded-md border border-red-500 bg-white text-neutral-600 dark:bg-neutral-950 dark:text-neutral-300"
            role="status" aria-live="polite" aria-atomic="true">
            <div class="flex w-full items-center gap-2.5 bg-red-500/10 rounded-md px-2 py-2">
                <!-- Icon -->
                <div class="rounded-full bg-red-500/15 p-0.5 text-red-500" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <!-- Title & Message -->
                <div class="flex flex-col gap-2">
                    {{-- <h3 class="text-sm font-semibold text-sky-500">Update Available</h3> --}}
                    <p class="text-gray-800 text-sm">
                        {{ $error }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
