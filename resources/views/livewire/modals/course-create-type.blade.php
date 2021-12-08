<div>
    <div class="relative w-full max-w-7xl bg-light dark:bg-dark-1 rounded-lg px-10 py-10 md:px-4 ">
        <button class="absolute top-2 right-2 w-6 h-6 flex items-center justify-center text-darker dark:text-light bg-transparent hover:bg-red-300 rounded-lg hover:text-black dark:hover:text-black" @click="modals = false"><i class="fa-thin fa-xmark"></i></button>
        <div class="flex flex-col justify-center items-center mb-8">
            <x-text.h class="text-2xl font-semibold">Course Type</x-text.h>
            <x-text.p class="text-lg font-light">Select your desired course type</x-text.p>
        </div>
        <div class="w-full h-full grid md:grid-cols-3 gap-4">
            <div class="w-full bg-white dark:bg-darker-1 md:dark:bg-transparent md:dark:hover:bg-darker-1 md:bg-transparent hover:bg-white flex flex-col items-center justify-between p-8 md:p-4 lg:p-8 rounded-2xl transform duration-300">
                <div class="w-full">
                    <div class="aspect-w-16 aspect-h-9 rounded-xl mb-4 hidden md:flex">
                        <img src="/svg/course-type-micro.svg" alt="">
                    </div>
                    <x-text.h class="text-lg font-semibold text-center">Micro Credential Course</x-text.h>
                    <x-text.p class="text-center">Select your desired course type</x-text.p>
                </div>
                <div class="w-full mt-8 mb-4">
                    <div class="w-full flex items-center justify-center">
                        <x-button.plain wire:click="createCourse('micro_credential')" class="bg-primary">Continue</x-button.plain>
                    </div>
                    <div class="w-full flex items-center justify-center mt-4">
                        <a class="font-robo text-light hover:text-primary text-xs font-semibold" href="">READ MORE</a>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white dark:bg-darker-1 md:dark:bg-transparent md:dark:hover:bg-darker-1 md:bg-transparent hover:bg-white flex flex-col items-center justify-between p-8 md:p-4 lg:p-8 rounded-2xl transform duration-300">
                <div class="w-full">
                    <div class="aspect-w-16 aspect-h-9 rounded-xl mb-4 hidden md:flex">
                    <img src="/svg/course-type-paid.svg" alt="">
                    </div>
                    <x-text.h class="text-lg font-semibold text-center">Paid Course</x-text.h>
                    <x-text.p class="text-center">Select your desired course type</x-text.p>
                </div>
                <div class="w-full mt-8 mb-4">
                    <div class="w-full flex items-center justify-center">
                        <x-button.plain wire:click="createCourse('paid')" class="bg-primary">Continue</x-button.plain>
                    </div>
                    <div class="w-full flex items-center justify-center mt-4">
                        <a class="font-robo text-light hover:text-primary text-xs font-semibold" href="">READ MORE</a>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white dark:bg-darker-1 md:dark:bg-transparent md:dark:hover:bg-darker-1 md:bg-transparent hover:bg-white flex flex-col items-center justify-between p-8 md:p-4 lg:p-8 rounded-2xl transform duration-300">
                <div class="w-full">
                    <div class="aspect-w-16 aspect-h-9 rounded-xl mb-4 hidden md:flex">
                        <img src="/svg/course-type-free.svg" alt="">
                    </div>
                    <x-text.h class="text-lg font-semibold text-center">Free Course</x-text.h>
                    <x-text.p class="text-center">Select your desired course type</x-text.p>
                </div>
                <div class="w-full mt-8 mb-4">
                    <div class="w-full flex items-center justify-center">
                        <x-button.plain wire:click="createCourse('free')" class="bg-primary">Continue</x-button.plain>
                    </div>
                    <div class="w-full flex items-center justify-center mt-4">
                        <a class="font-robo text-light hover:text-primary text-xs font-semibold" href="">READ MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
