<div x-data="{ manage_dropdown{{$course->id}}: false}" class="relative w-full bg-white dark:bg-darker-1 rounded-md border border-lightest dark:border-dark flex flex-col justify-between">
    <div class="h-full">
        <div class="w-full h-14 flex items-center justify-between border-b border-lightest dark:border-dark">
            <div class="flex">
                <div class="w-8 h-8 mx-3 rounded-full">
                    <img class="rounded-full" src="{{$this->getImage($user->profile_photo)}}" alt="">
                </div>
                <div class="h-9">
                    <div class="font-mont text-sm text-darker dark:text-light font-semibold line-clamp-1">
                        {{ $user->full_name }}
                    </div>
                    <div class="font-robo text-dark text-xs">
                        {{ $this->getUpdatedAt($course->updated_at) }}
                    </div>
                </div>
            </div>
            <button @click="manage_dropdown{{$course->id}} = ! manage_dropdown{{$course->id}}" class="w-8 h-8 flex items-center justify-center mr-3 rounded-full hover:bg-lightest dark:hover:bg-darker-2 hover:text-primary dark:hover:text-primary text-light">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <div class="w-full border-b border-lightest dark:border-dark aspect-w-16 aspect-h-9">
            <img src="{{$this->getImage($course->course_image)}}" alt="">
        </div>
        <div class="p-3 flex flex-col justify-between">
            <div class="font-mont text-sm text-darker dark:text-light font-semibold line-clamp-2">
                {{ $course->title }}
            </div>
            <div class="font-mont font-semibold text-sm text-red-400">
                @if($course->type != 'free' )
                    RM {{ $course->price }}
                @else
                    FREE 
                @endif
            </div>
        </div>
    </div>
    <div class="w-full h-12 flex border-t border-lightest dark:border-dark dark:bg-darker-2 rounded-b-md">
        <button wire:click="rejectCourse" class="w-1/2 h-full border-r border-lightest dark:border-dark hover:bg-red-50 flex items-center justify-center text-light text-sm font-robo hover:text-red-400 rounded-bl-md cursor dark:hover:bg-darker-1">
            Reject
        </button>
        <button wire:click="approveCourse" class="w-1/2 h-full hover:bg-green-50 flex items-center justify-center text-light text-sm font-robo hover:text-green-400 rounded-br-md dark:hover:bg-darker-1">
            Approve
        </button>
    </div>
    <div wire:ignore x-show="manage_dropdown{{$course->id}} == true" class="absolute h-auto top-12 right-4 bg-white dark:bg-darker-2 flex-col items-center justify-center rounded border border-lightest dark:border-dark py-2" @click.outside="manage_dropdown{{$course->id}} = false"
        x-transition:enter="transition ease-out duration-300" 
        x-transition:enter-start="transform opacity-0 scale-95" 
        x-transition:enter-end="transform opacity-100 scale-100" 
        x-transition:leave="transition ease-in duration-75" 
        x-transition:leave-start="transform opacity-100 scale-100" 
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        <button @click="toggleManageDropDown({{$course->id}}); modals_button = 'view_course'; modals = true; emitViewCourse({{$course->id}})" class="p-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start hover:bg-light dark:hover:bg-dark-2 w-full">
            <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-eye"></i></div>
            <div class="flex flex-col items-start">
                <div class="flex items-center justify-start text-left font-mont text-xs font-semibold">View</div>
                <div class="text-xs font-robo text-dark">Review course details</div>
            </div>
        </button>
        <button @click="toggleManageDropDown({{$course->id}}); modals_button = 'delete_course'; modals = true; emitDeleteCourse({{$course->id}})" class="p-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start hover:bg-light dark:hover:bg-dark-2 w-full mb-2">
            <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-message"></i></div>
            <div class="flex flex-col items-start">
                <div class="flex items-center justify-start text-left font-mont text-xs font-semibold">Message</div>
                <div class="text-xs font-robo text-dark">Send a message to course owner</div>
            </div>
        </button>
        <div class="pt-2 border-t border-lightest dark:border-dark">
            <button @click="toggleManageDropDown({{$course->id}}); modals_button = 'delete_course'; modals = true; emitDeleteCourse({{$course->id}})" class="p-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start hover:bg-light dark:hover:bg-dark-2 w-full">
                <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-eraser"></i></div>
                <div class="flex flex-col items-start">
                    <div class="flex items-center justify-start text-left font-mont text-xs font-semibold">Delete</div>
                    <div class="text-xs font-robo text-dark">Remove this course</div>
                </div>
            </button>
        </div>
    </div>
</div>
