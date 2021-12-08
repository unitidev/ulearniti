<div class="relative w-full h-full bg-white dark:bg-darkest-1 rounded-xl p-4 flex items-center justify-center flex-col">
    <div class="font-mont text-xl text-light dark:text-lighter">If you wish to continue, purchase this course now</div>

    <div class="font-mont text-xl text-light dark:text-lighter">{{$price}}</div>

    <button wire:click="purchaseCourse" class="px-4 h-10 bg-primary">{{ $enroll_button }}</button>


</div>