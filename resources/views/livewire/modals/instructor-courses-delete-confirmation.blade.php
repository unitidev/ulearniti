<div class="w-full flex items-center justify-center">
   <div @click.outside="modals = false" class="w-full max-w-lg bg-white dark:bg-darker-2 rounded-lg">
        <div class="w-full h-12 border-b-2 border-lightest dark:border-dark flex items-center justify-between pl-4 pr-2">
            <x-text.h class="font-medium">Delete Course</x-text.h>
            <button @click="modals = false" class="w-8 h-8 flex items-center justify-center text-lg text-darker dark:text-light hover:text-primary dark:hover:text-primary"><i class="fa-light fa-xmark"></i></button>
        </div>
        <div class="h-40 flex items-center text-center justify-center text-light font-light text-sm">
            Please note that course may not be able to delete once it's published
            Are you sure to delete this course?
        </div>
        <div class="w-full h-16 border-t-2 border-lightest dark:border-dark flex items-center justify-end px-3">
            <button wire:click="deleteCourses" @click="modals = false" class="py-2 bg-primary dark:border-dark rounded-md text-white w-24 mr-2">Delete</button>
            <button class="py-2 border border-lightest dark:border-dark rounded-md text-darker dark:text-light w-24 ml-2" @click="modals = false">Cancel</button>
        </div>
   </div>
</div>
