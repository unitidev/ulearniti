<div id="pageDiv" x-data="courseCreate" class="min-h-screen">
    <div class="w-full h-full flex justify-center flex-1 items-center min-h-screen">
        <div x-show="page == 'title'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.title',['courseId' => $courseId])
        </div>
        <div x-show="page == 'info'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.info',['courseId' => $courseId])
        </div>
        <div x-show="page == 'description'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.description',['courseId' => $courseId])
        </div>
        <div x-show="page == 'target'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.target',['courseId' => $courseId])
        </div>
        <div x-show="page == 'requirement'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.requirement',['courseId' => $courseId])
        </div>
        <div x-show="page == 'outcome'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.outcome',['courseId' => $courseId])
        </div>
        <div x-show="page == 'course-image'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.course-image',['courseId' => $courseId])
        </div>
        <div x-show="page == 'promotional-video'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20 pt-8"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.promotional-video',['courseId' => $courseId])
        </div>
        <div x-show="page == 'course-content'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.course-content',['courseId' => $courseId])
        </div>
        <div x-show="page == 'course-price'" class="flex flex-1 items-center justify-center w-full h-full min-h-screen pb-20"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.course-price',['courseId' => $courseId])
        </div>
        <div x-show="page == 'course-review'" class="flex flex-1 justify-center w-full h-full min-h-screen"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            @livewire('instructor.course.create.course-review',['courseId' => $courseId])
        </div>
    </div>

    
    <div class="fixed bottom-0 w-full h-14 flex items-center justify-center bg-white dark:bg-darkest-2">
        <div class="w-full max-w-6xl flex justify-between px-4">
            <x-button.plain x-show="page == 'title'" disabled class="disabled:opacity-50 bg-light dark:bg-dark-1 w-32 text-darker dark:text-dark">Previous</x-button.plain>
            <x-button.plain @click="prevPage" x-show="page != 'title'" class="bg-primary w-32">Previous</x-button.plain>
            @if($page == "course-review" )
                @if($course_type == "free")
                <x-button.plain wire:click="submitCourse" class="bg-primary w-32">Submit</x-button.plain>
                @else
                <x-button.plain @click="nextPage" class="bg-primary w-32">Next</x-button.plain>
                @endif
            @elseif($page == "course-price")
            <x-button.plain wire:click="submitCourse" class="bg-primary w-32">Submit</x-button.plain>
            @elseif($page == "course-content")
                @if($course_type == "free" && $course_duration > 600)
                    <x-button.plain disable class="opacity-50 bg-light dark:bg-dark-1 w-32 text-darker dark:text-dark">Next</x-button.plain>
                @else
                    <x-button.plain @click="nextPage" class="bg-primary w-32">Next</x-button.plain>
                @endif
            @else
            <x-button.plain @click="nextPage" class="bg-primary w-32">Next</x-button.plain>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('courseCreate', () => ({
                page: "{{ $page }}",

                nextPage()
                {
                    if(this.page == 'title'){ 
                        if(document.getElementById('title').value != '' && document.getElementById('subtitle').value != '') {
                            Livewire.emitTo('instructor.course.create.title', 'updateTitles', document.getElementById('title').value, document.getElementById('subtitle').value);
                            this.page = 'info';
                            @this.call('changePage', 'info');
                        }
                        if(document.getElementById('title').value == '') {
                            document.getElementById('title').classList.add('border-red-500', 'dark:border-red-500');
                            document.getElementById('title').addEventListener('input', function(){
                                document.getElementById('title').classList.remove('border-red-500', 'dark:border-red-500');
                            });
                        }
                        if(document.getElementById('subtitle').value == '') {
                        document.getElementById('subtitle').classList.add('border-red-500', 'dark:border-red-500');
                            document.getElementById('subtitle').addEventListener('input', function(){
                                document.getElementById('subtitle').classList.remove('border-red-500', 'dark:border-red-500');
                            });
                        }
                        
                    }
                    else if(this.page == 'info'){ 
                        this.page = 'description';
                        @this.call('changePage', 'description');
                        Livewire.emitTo('instructor.course.create.info', 'storeInfo');
                    }
                    else if(this.page == 'description'){
                        if(document.getElementById('trixDescription').value != '') {
                            this.page = 'target';
                            @this.call('changePage', 'target');
                            Livewire.emitTo('instructor.course.create.description', 'updateDescription', document.getElementById('trixDescription').value);
                        }
                        else
                        {
                            document.getElementById('descriptionWrapper').classList.add('border-red-500', 'dark:border-red-500');
                            document.getElementById('trixDescription').addEventListener('input', function(){
                                document.getElementById('descriptionWrapper').classList.remove('border-red-500', 'dark:border-red-500');
                            });
                        }
                    }
                    else if(this.page == 'target'){ 
                        if(document.getElementById('trixTarget').value != '') {
                            this.page = 'requirement';
                            @this.call('changePage', 'requirement');
                            Livewire.emitTo('instructor.course.create.target', 'updateTarget', document.getElementById('trixTarget').value);
                        }
                        else
                        {
                            document.getElementById('targetWrapper').classList.add('border-red-500', 'dark:border-red-500');
                            document.getElementById('trixTarget').addEventListener('input', function(){
                                document.getElementById('targetWrapper').classList.remove('border-red-500', 'dark:border-red-500');
                            });
                        }
                    }
                    else if(this.page == 'requirement'){ 
                        if(document.getElementById('trixRequirement').value != '') {
                            this.page = 'outcome';
                            @this.call('changePage', 'outcome');
                            Livewire.emitTo('instructor.course.create.requirement', 'updateRequirement', document.getElementById('trixRequirement').value);
                        }
                        else
                        {
                            document.getElementById('requirementWrapper').classList.add('border-red-500', 'dark:border-red-500');
                            document.getElementById('trixRequirement').addEventListener('input', function(){
                                document.getElementById('requirementWrapper').classList.remove('border-red-500', 'dark:border-red-500');
                            });
                        }
                    }
                    else if(this.page == 'outcome'){ 
                        if(document.getElementById('trixOutcome').value != '') {
                            this.page = 'course-image';
                            @this.call('changePage', 'course-image');
                            Livewire.emitTo('instructor.course.create.outcome', 'updateOutcome', document.getElementById('trixOutcome').value);
                        }
                        else
                        {
                            document.getElementById('outcomeWrapper').classList.add('border-red-500', 'dark:border-red-500');
                            document.getElementById('trixOutcome').addEventListener('input', function(){
                                document.getElementById('outcomeWrapper').classList.remove('border-red-500', 'dark:border-red-500');
                            });
                        }
                        
                    }
                    else if(this.page == 'course-image'){ 
                        this.page = 'promotional-video';
                        @this.call('changePage', 'promotional-video');
                    }
                    else if(this.page == 'promotional-video'){ 
                        this.page = 'course-content';
                        @this.call('changePage', 'course-content');
                        @this.call('pausePromotionalVideo');
                    }
                    else if(this.page == 'course-content'){ 
                        this.page = 'course-review';
                        @this.call('changePage', 'course-review');
                        window.location.replace("https://ulearniti.unitidev.com/instructor/course/create/course-review/{{$courseId}}")
                    }
                    else if(this.page == 'course-review'){ 
                        this.page = 'course-price';
                        @this.call('changePage', 'course-price');
                    }
                },
                prevPage()
                {
                    if(this.page == 'course-price'){ 
                        this.page = 'course-review';
                        @this.call('changePage', 'course-review');
                        window.location.replace("https://ulearniti.unitidev.com/instructor/course/create/course-review/{{$courseId}}")
                    }
                    else if(this.page == 'course-review'){ 
                        this.page = 'course-content';
                        @this.call('changePage', 'course-content');
                        @this.call('pauseCrVideo');
                    }
                    else if(this.page == 'course-content'){ 
                        this.page = 'promotional-video';
                        @this.call('changePage', 'promotional-video');
                    }
                    else if(this.page == 'promotional-video'){ 
                        this.page = 'course-image';
                        @this.call('changePage', 'course-image');
                        @this.call('pausePromotionalVideo');
                    }
                    else if(this.page == 'course-image'){ 
                        this.page = 'outcome';
                        @this.call('changePage', 'outcome');
                    }
                    else if(this.page == 'outcome'){ 
                        this.page = 'requirement';
                        @this.call('changePage', 'requirement');
                    }
                    else if(this.page == 'requirement'){ 
                        this.page = 'target';
                        @this.call('changePage', 'target');
                    }
                    else if(this.page == 'target'){ 
                        this.page = 'description';
                        @this.call('changePage', 'description');
                    }
                    else if(this.page == 'description'){ 
                        this.page = 'info';
                        @this.call('changePage', 'info');
                    }
                    else if(this.page == 'info'){ 
                        this.page = 'title';
                        @this.call('changePage', 'title');
                    }
                }
            }))
        })
        
        window.addEventListener('popstate', (event) => {
            location.reload();
        });
</script>
</div>