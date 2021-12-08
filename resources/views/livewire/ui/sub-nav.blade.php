<div x-show="subnav" class="pl-20 h-screen bg-white dark:bg-darker-1 fixed z-20 transform"
    x-transition:enter="duration-300"
    x-transition:enter-start="-left-80"
    x-transition:enter-end="-left-0"
    x-transition:leave="duration-300"
    x-transition:leave-start="-left-0"
    x-transition:leave-end="-left-80"
>
    <div class="w-60">
        <div class="w-full h-16 flex justify-between pl-4">
            <div class="h-16 flex items-center justify-center text-xl ml-2 font-medium font-mont text-darker dark:text-light">
                
            </div>
            <div class="w-16 h-16 flex items-center justify-center text-2xl text-primary md:hidden">
                <button @click="toggleSubNav">
                    <i class="fa-light fa-angle-left"></i>
                </button>
            </div>
        </div>
        <div class="grid grid-flow-row gap-6 w-full h-full pl-6 font-mont text-sm pt-3">
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="/">Home</a>
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="/user/courses/enrolled-courses">Enrolled Courses</a>
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="">Home</a>
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="">Home</a>
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="">Home</a>
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="">Home</a>
            <a class="text-darker dark:text-light hover:text-primary dark:hover:text-lighter" href="">Home</a>
        </div>
    </div>
</div>
