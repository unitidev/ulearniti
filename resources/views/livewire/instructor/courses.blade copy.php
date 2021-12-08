<div class="pb-20">    
    <div class="">
        <div class="max-w-6xl mx-auto">
            <div class="">
                <div class="w-full flex justify-between">
                    <x-input.icon class="w-60" type="search" icon="fa-light fa-magnifying-glass" placeholder="Search"/>
                    <div class="flex w-60 items-center justify-end">
                        View
                        <select name="viewType" id="viewType" class="ml-3 px-5 rounded-md">
                            <option value="volvo">All</option>
                            <option value="saab">Draft</option>
                            <option value="mercedes">Published</option>
                        </select>
                    </div>
                </div>
                @foreach($courses as $course)
                <x-ui.card class="relative mt-2">
                    <div class="absolute md:flex hidden top-2 right-2 text-xxs font-semibold text-white bg-green-400 px-2 rounded-md">{{ $course->status }}</div>
                    <div class="absolute md:hidden flex top-5 right-6 z-10 text-xxs font-semibold text-white bg-green-500 w-4 h-4 rounded-full"></div>
                    <div class="w-full md:flex md:justify-between">
                        <div class="w-full h-full md:flex">
                            <div class="w-full md:w-60">
                                <div class="aspect-w-16 aspect-h-9 rounded-md md:mr-4 bg-light dark:bg-dark-1">
                                    @if($course->course_image)
                                        <img class="rounded-md" src="{{ $this->getCourseImage($course->course_image) }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="max-w-lg">
                                <x-text.h>{{$course->title}}</x-text.h>
                                 <h1 class="text-red-500 hidden md:flex text-md font-mont mt-2">RM{{$course->price}}</h1>
                            </div>
                            <div class="flex flex-col justify-between mb-4 w-full md:w-60">
                                <h1 class="text-red-500 md:hidden flex text-md font-mont mt-2">RM{{$course->price}}</h1>
                                <div class="flex text-base mt-2 md:mt-0 ml-0 md:ml-2">
                                    <?php $j=0 ?>
                                    @for($i = 0; $i < 5; $i++)
                                        @for($j; $j < 3; $j++)
                                            <i class="fa-solid fa-star text-yellow-500"></i>
                                            <?php $i++ ?>
                                        @endfor
                                        @if($i == 5)
                                            @break
                                        @endif
                                        <i class="fa-solid fa-star text-lighter dark:text-[#1E1E21]"></i>
                                    @endfor
                                </div>
                            </div>
                            
                           
                            
                        </div>
                        <div class="w-full md:w-60 h-auto flex items-center justify-center">                            
                            <a href="/instructor/course/create/title/{{$course->id}}" class="mr-4 w-full md:w-20 "><button class="bg-primary py-1 w-full  rounded-sm text-white">Edit</button></a>
                            <button class="bg-primary py-1 w-full md:w-20 rounded-sm text-white">Settings</button>
                        </div>
                    </div>
                </x-ui.card>
                @endforeach
            </div>
        </div>
    </div>    
</div>
