<div x-data="bankCard" class="w-full h-48 md:h-72 flex justify-center">
    <div class="relative w-full max-w-xs md:max-w-md flex">
        <div x-show="front" class="w-full"
            x-transition:enter="ease-out duration-200 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-100"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
        >
            <div class="aspect-w-16 aspect-h-9 bg-primary rounded-xl">
                <div class="w-full h-full rounded-t-xl px-6 py-4">
                    <div class="w-fulll h-1/2 flex items-end md:pl-6">
                        <div class="flex w-1/2">
                            <div class="w-12 h-8 md:w-14 md:h-10 flex items-center justify-center text-3xl md:text-4xl text-yellow-600 border-yellow-600 dark:text-white border dark:border-white rounded-md">
                                <i class="fa-thin fa-microchip"></i>
                            </div>
                        </div>
                        <div class="w-1/2 h-full flex items-start justify-end text-4xl md:text-6xl text-white dark:text-white">
                        <i class="fa-brands fa-cc-amex"></i>
                        </div>
                        
                    </div>
                    <div class="w-full h-1/2 flex flex-col justify-between">
                        <div class="h-6 md:h-8 font-mont text-white font-bold md:pl-6 dark:text-white text-center w-full flex justify-between pr-6"><div class="text-xl md:text-3xl pt-1 tracking-widest">****</div> <div class="text-xl md:text-3xl pt-1 tracking-widest">****</div> <div class="text-xl md:text-3xl pt-1 tracking-widest">****</div> <div class="text-lg md:text-2xl tracking-widest">9924</div></div>
                        <div class="w-full flex md:flex-col items-center justify-center">
                            <div class="font-robo text-white dark:text-white text-xxs mr-2 md:mr-0">VALID THRU</div>
                            <div class="font-mont h-4 text-white dark:text-white font-semibold md:text-lg text-xs">05/22</div>
                        </div>
                        <div class="w-full items-center font-mont text-white dark:text-white font-semibold md:text-lg text-xs line-clamp-1">W N M FIRDAUS</div>                
                    </div>
                </div>
            </div>
        </div>
        <div x-show="!front" class="w-full"
            x-transition:enter="ease-out duration-200 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-100"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20">
            <div class="top-0 aspect-w-16 aspect-h-9 bg-primary rounded-xl">
                <div class="w-full h-full rounded-t-xl py-4">
                    <div class="w-fulll h-1/3 flex">
                        <div class="w-full h-8 md:h-12 bg-darkest-1 mt-1"></div>
                    </div>
                    <div class="w-full h-2/3 flex flex-col justify-between">
                        <div class="w-2/3 h-5 md:h-8 pl-4">
                            <div class="w-full h-full bg-gray-300 flex justify-end">
                                <div class="bg-white h-full px-1 font-mont text-sm">123</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('bankCard', () => ({
                front: true,
            }))
        });
    
    </script>
</div>