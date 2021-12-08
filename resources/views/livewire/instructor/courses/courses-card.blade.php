<div x-data="{ manage_dropdown{{$course->id}}: false }" class="bg-white dark:bg-dark-2 border border-lightest dark:border-dark hover:shadow-md rounded-md relative mb-4 md:p-4 md:justify-between md:flex md:pr-10 pb-4">
    <div class="w-full md:w-60 h-auto">
        <div class="aspect-w-16 aspect-h-9">
            @if($course->course_image)
                <img class="rounded-t-md md:rounded-md" src="{{ $this->getCourseImage($course->course_image) }}" alt="">
            @endif
        </div>
    </div>
    <div class="px-4 flex-1 flex flex-col justify-between mt-2 md:mt-0">
        <div class="bg-red w-full">
            <x-text.h class="line-clamp-2 w-full">{{$course->title}}</x-text.h>
            <x-text.p class="text-sm line-clamp-2">{{$course->subtitle}}</x-text.p>
        </div>
        <div class="mt-4 md:mt-0">
            @if($course->type == 'free')
                <div class="w-full flex items-center justify-between">
                    <div class="font-mont text-red-400 font-semibold text-sm">FREE</div> 
                    <div class="px-2 h-full bg-green-400 font-robo text-sm text-white flex items-center justify-center font-medium rounded-md">{{ $course->status }}</div>
                </div>
            @else
                RM {{ $course->price}}
            @endif
            <div class="flex ">
                @if($this->totalSection($course->id) > 1)
                    <div class="text-xs text-primary">{{$this->totalSection($course->id)}} Sections</div>
                    <div class="text-xs text-primary mx-2">|</div>
                @endif
                <div class="text-xs text-primary">{{$this->totalVideo($course->id)}} Videos</div>
                <div class="text-xs text-primary mx-2">|</div>
                <div class="text-xs text-primary">{{$this->totalVideoDuration($course->id)}}</div>
                <div class="text-xs text-primary mx-2">|</div>
                <div class="text-xs text-primary">{{$this->totalQuiz($course->id)}} Quizes</div>
            </div>
        </div>
    </div>
    <div @click="manage_dropdown{{$course->id}} = ! manage_dropdown{{$course->id}}" class="absolute w-10 h-10 top-2 right-2 bg-light dark:bg-dark-1 md:bg-transparent md:dark:bg-transparent dark:hover:bg-darkest-1 rounded-full hover:shadow-md flex items-center justify-center text-lg text-light dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer" :class="{'text-primary dark:text-primary' : manage_dropdown == {{$course->id}}}">
        <i class="fa-solid fa-ellipsis-vertical"></i>
    </div>
    <div wire:ignore x-show="manage_dropdown{{$course->id}}" class="absolute h-auto top-12 py-2 right-4 bg-white dark:bg-darker-2 flex-col items-center justify-center rounded-md border border-lightest dark:border-dark" @click.outside="manage_dropdown{{$course->id}} = false"
        x-transition:enter="transition ease-out duration-300" 
        x-transition:enter-start="transform opacity-0 scale-95" 
        x-transition:enter-end="transform opacity-100 scale-100" 
        x-transition:leave="transition ease-in duration-75" 
        x-transition:leave-start="transform opacity-100 scale-100" 
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        @if($course->status == 'submitted')
        <button @click="manage_dropdown{{$course->id}} = false; modals_button = 'edit_course'; modals = true; emitEditCourse({{$course->id}})" class="w-full p-2 mb-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start dark:border-dark hover:bg-light dark:hover:bg-dark-2">
            <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-pen-to-square"></i></div>
            <div class="flex flex-col items-start">
                <div class="flex items-center justify-start text-left font-mont text-xs font-medium">Edit</div>
                <div class="text-xs font-robo text-dark font-light">Edit course</div>
            </div>
        </button>
        @else
        <a href="/instructor/course/create/title/{{$course->id}}" data-turbolinks="false" @click="manage_dropdown{{$course->id}} = false;" class="p-2 mb-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start dark:border-dark hover:bg-light dark:hover:bg-dark-2">
            <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-pen-to-square"></i></div>
            <div class="flex flex-col items-start">
                <div class="flex items-center justify-start text-left font-mont text-xs font-medium">Edit</div>
                <div class="text-xs font-robo text-dark font-light">Edit course</div>
            </div>
        </a>
        @endif
        <div class="w-full h-px border-b border-lightest dark:border-dark"></div>
        <button @click="manage_dropdown{{$course->id}} = false; modals_button = 'delete_course'; modals = true; emitDeleteCourse({{$course->id}})" class="p-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start hover:bg-light dark:hover:bg-dark-2 mt-2">
            <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-eraser"></i></div>
            <div class="flex flex-col items-start">
                <div class="flex items-center justify-start text-left font-mont text-xs font-medium">Delete</div>
                <div class="text-xs font-robo text-dark font-light">Remove this course</div>
            </div>
        </button>
    </div>
</div>