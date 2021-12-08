<div x-data="admin_courses" class="pb-20">    
    <div class="">
        <div class="max-w-6xl mx-auto">
            <div class="">
                <div class="w-full flex justify-end md:justify-between">
                    <x-input.icon class="w-60 hidden md:flex" type="search" icon="fa-light fa-magnifying-glass" placeholder="Search"/>
                    <div class="flex items-center justify-end">
                        <div class="relative w-48 h-10 bg-white rounded-md flex text-dark">
                            <button @click="changeTab('draft')" class="z-20 w-full h-full rounded-l-md font-robo" :class="{'text-white' : tab == 'draft'}">Pending  </button>
                            <button @click="changeTab('published')" class="z-20 w-full h-full rounded-r-md font-robo" :class="{'text-white' : tab == 'published'}">Published</button>
                            <div class="z-10 w-1/2 h-full absolute top-0 bg-primary transform duration-300" :class="{'right-24 rounded-md' : tab == 'draft', 'right-0 rounded-md' : tab == 'published'}"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" x-show="tab == 'draft'">
                @foreach($pending_courses as $course)
                    @livewire('admin.courses.pending-courses-card', ['course_id' => $course->id], key($course->id))
                @endforeach
            </div>

            <div class="mt-6 grid " x-show="tab == 'published'">
                @foreach($published_courses as $course)
                    @livewire('admin.courses.published-courses-card', ['course_id' => $course->id], key($course->id))
                @endforeach
            </div>
        </div>
    </div>  
    
    <x-ui.modal maxWidth="max-w-7xl">
        <div x-show="modals_button == 'view_course'">
            @livewire('modals.course-create-type')
        </div>

        <div x-show="modals_button == 'delete_course'">
            @livewire('modals.instructor-courses-delete-confirmation')
        </div>
    </x-ui.modal>



    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('admin_courses', () => ({
                tab: 'draft',

                changeTab(tab)
                {
                    this.tab = tab;
                },

                emitDeleteCourse(id)
                {
                    @this.emitTo('modals.instructor-courses-delete-confirmation', 'retreiveID', id);
                },
            }))
        })
    </script> 
</div>
