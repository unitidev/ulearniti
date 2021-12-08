<x-slot name="modals">
    <div class="flex items-center justify-center top-0 w-screen h-screen fixed z-40" x-show="modals"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="relative w-full h-full flex flex-col items-center justify-center">
            <div class="absolute top-0 w-full h-full bg-black opacity-75"></div>
            <div class="z-40 w-full {{ $maxWidth }} max-h-screen overflow-y-auto" @click.outside="modals = false" x-show="modals"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                {{ $slot }}
            </div>
        </div>     
    </div>
</x-slot>