<div class="pb-20" x-data="enrolledCourses">    
    <div class="">
        <div class="max-w-6xl mx-auto">
            <div class="">
                <div class="w-full flex justify-end md:justify-between">
                    <x-input.icon class="w-60 hidden md:flex" type="search" icon="fa-light fa-magnifying-glass" placeholder="Search"/>
                    <div class="flex items-center justify-start">
                        <button @click="modals_button = 'create_course'; modals = true" class="w-40 h-10 bg-primary rounded-md font-robo mr-4 text-white">Create new course</button>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4">
                @for($i = 0; $i < 10; $i++)
                    <div class="w-full h-48 bg-yellow-300">
                        <div class="h-3/5 bg-darker-1"></div>
                        <div class="h-2/5 bg-darker-1 border-dark border-t-2 flex justify-between items-center px-4">
                            <div class="w-1/2">
                                <div class="flex justify-between w-64 text-sm text-light font-robo mb-2">
                                    <div>Progress</div>
                                    <div>75%</div>
                                </div>
                                <div class="bg-gray-900 h-1 w-64 rounded-r-full rounded-l-full">
                                    <div class="bg-primary h-1 w-3/5 rounded-r-full rounded-l-full"></div>
                                </div>
                            </div>
                            <div class="w-1/2 flex justify-end"><button class="px-4 py-3 bg-dark-1 rounded-r-full rounded-l-full font-robo text-sm text-light hover:border-primary hover:border-2 hover:text-washed-primary">Continue Learning</button></div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    </div>  
    
    



    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('enrolledCourses', () => ({
                
            }))
        })
    </script> 
</div>
