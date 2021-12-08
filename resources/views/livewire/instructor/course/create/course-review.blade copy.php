<div id="crdiv" x-data="crdiv" class="pt-24 flex flex-col flex-1 w-full h-full max-w-6xl px-0 md:px-4">
    <div class="w-full">
        <x-text.h class="text-lg md:text-xl px-4 font-semibold">{{ $title }}</x-text.h>
    </div>
    <div class="w-full flex relative">
        
        <div class="group relative w-full md:rounded-xl bg-black transform duration-300" :class="{'lg:w-2/3': !theater}">
            <div class="aspect-w-16 aspect-h-9">
                <div x-show="content == 'video'" id="coursereviewplyrcontainer" @click.outside="modals = false">
                    <video controls crossorigin playsinline class="coursereviewplyr">
                        <source 
                            id="coursereviewvideoplyr"
                            type="application/x-mpegURL" 
                            src=""
                        >
                    </video>
                </div>
                <div x-show="content == 'quiz'">
                    @livewire('instructor.course.create.content.quiz.quiz-review')
                </div>
            </div>
            <button @click="toggleTheater" class="group-hover:flex hidden items-center justify-center absolute top-4 right-4 rounded-full w-8 h-8 border border-light ">
                <i class="fa-solid fa-angle-right" :class="{'rotate-180': theater}"></i>
            </button>
        </div> 
        <div x-data="{selected1: null,}" x-show="!theater" class="hidden lg:flex flex-col w-1/3 pl-4 absolute top-0 right-0 h-full"
            x-transition:enter=""
            x-transition:enter-start.delay-300ms=""
            x-transition:enter-end.delay-300ms=""
            x-transition:leave=""
            x-transition:leave-start=""
            x-transition:leave-end=""
        >
            <div class="w-full h-[30rem] bg-white dark:bg-darkest-1 rounded-xl overflow-y-auto">
                <div @click="mountVideo('{{ $promotional_video}}')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                        <i class="fa-solid fa-play-circle"></i>
                    </div>
                    <div class="w-full items-center font-robo">
                        Introduction to course
                    </div>
                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                            1hr 20min
                    </div>
                </div>

                @if($this->numberOfSections() < 2)
                    @foreach($contents as $content)
                        @if($content->type != "section")
                            @if($content->type == "video")
                                <div @click="mountVideo('https://videodelivery.net/{{ $content->uid }}/manifest/video.m3u8')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                                        <i class="fa-solid fa-play-circle"></i>
                                    </div>
                                    <div class="w-full items-center font-robo">
                                        {{$content->title}}
                                    </div>
                                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                        1hr 20min
                                    </div>
                                </div>
                            @elseif($content->type == "quiz")
                                <div @click="showQuiz('{{ $content->id }}')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </div>
                                    <div class="w-full items-center font-robo">
                                        {{$content->title}}
                                    </div>
                                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                        1hr 20min
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @else
                    @foreach($contents as $content)
                            @if($content->type == "section" && $content->position == 0)
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected1 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected1 !== {{$content->id}} ? selected1 = {{$content->id}} : selected1 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected1 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$content->id}}" x-bind:style="selected1 == {{$content->id}} ? 'max-height: ' + $refs.container{{$content->id}}.scrollHeight + 'px' : ''">

                            @elseif($content->type == "section" && $content->position == ($this->numberOfContents()-1))
                                </div>
                                </div>
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected1 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected1 !== {{$content->id}} ? selected1 = {{$content->id}} : selected1 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected1 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                            @elseif($content->type == "section" && $content->position > 0)
                                </div>
                                </div>
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected1 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected1 !== {{$content->id}} ? selected1 = {{$content->id}} : selected1 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected1 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$content->id}}" x-bind:style="selected1 == {{$content->id}} ? 'max-height: ' + $refs.container{{$content->id}}.scrollHeight + 'px' : ''">
                            @endif

                            @if($content->type != "section") 
                                @if($content->type == "video")
                                    <div @click="mountVideo('https://videodelivery.net/{{ $content->uid }}/manifest/video.m3u8')" class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-auto text-xs">
                                            <i class="fa-solid fa-play-circle"></i>
                                        </div>
                                        <div class="w-full items-center font-robo text-sm">
                                                {{ $content->title }}
                                        </div>
                                        <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                1hr 20min
                                        </div>
                                    </div>
                                @elseif($content->type == "quiz")
                                    <div @click="showQuiz('{{ $content->id }}')" class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-auto text-xs">
                                            <i class="fa-solid fa-circle-question"></i>
                                        </div>
                                        <div class="w-full items-center font-robo text-sm">
                                                {{ $content->title }}
                                        </div>
                                        <div class="w-20 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                10 questions
                                        </div>
                                    </div>
                                @endif                       
                            @endif
                                
                    @endforeach
                    </div>
                    </div>
                @endif
            
            </div>
        </div>
    </div>
    <div class="w-full bg-white dark:bg-darkest-1 md:rounded-xl mt-4 mb-20 ">
        <div class="hidden w-full h-12 lg:flex">
            <button @click="tab = 'about'" class="w-32 h-full rounded-t-xl border-primary" :class="{'border-b': tab == 'about'}">About</button>
            <button x-show="theater" @click="tab = 'contents'" class="flex items-center justify-center w-32 h-full rounded-t-xl border-primary" :class="{'border-b': tab == 'contents'}">Contents</button>
            <button @click="tab = 'project'" class="w-32 h-full rounded-t-xl border-primary" :class="{'border-b': tab == 'project'}">Project</button>
        </div>

        <div x-data="{selected2: null,}" class="flex flex-col w-full right-0 h-full lg:hidden">
                <button class="flex lg:hidden  items-center justify-center w-full h-12">Contents</button>
                <div class="w-full rounded-xl">
                    <div @click="mountVideo('{{ $promotional_video}}')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                        <div class="flex items-center justify-center w-16 h-auto text-xs">
                            <i class="fa-solid fa-play-circle"></i>
                        </div>
                        <div class="w-full items-center font-robo">
                            Introduction to course
                        </div>
                        <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                1hr 20min
                        </div>
                    </div>

                    @if($this->numberOfSections() < 2)
                    @foreach($contents as $content)
                        @if($content->type != "section")
                            @if($content->type == "video")
                                <div @click="mountVideo('https://videodelivery.net/{{ $content->uid }}/manifest/video.m3u8')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                                        <i class="fa-solid fa-play-circle"></i>
                                    </div>
                                    <div class="w-full items-center font-robo">
                                        {{$content->title}}
                                    </div>
                                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                        1hr 20min
                                    </div>
                                </div>
                            @elseif($content->type == "quiz")
                                <div @click="showQuiz('{{ $content->id }}')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </div>
                                    <div class="w-full items-center font-robo">
                                        {{$content->title}}
                                    </div>
                                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                        1hr 20min
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @else
                    @foreach($contents as $content)
                            @if($content->type == "section" && $content->position == 0)
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected2 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected2 !== {{$content->id}} ? selected2 = {{$content->id}} : selected2 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected2 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$content->id}}" x-bind:style="selected2 == {{$content->id}} ? 'max-height: ' + $refs.container{{$content->id}}.scrollHeight + 'px' : ''">

                            @elseif($content->type == "section" && $content->position == ($this->numberOfContents()-1))
                                </div>
                                </div>
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected2 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected2 !== {{$content->id}} ? selected2 = {{$content->id}} : selected2 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected2 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                            @elseif($content->type == "section" && $content->position > 0)
                                </div>
                                </div>
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected2 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected2 !== {{$content->id}} ? selected2 = {{$content->id}} : selected2 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected2 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$content->id}}" x-bind:style="selected2 == {{$content->id}} ? 'max-height: ' + $refs.container{{$content->id}}.scrollHeight + 'px' : ''">
                            @endif

                            @if($content->type != "section")
                                @if($content->type == "video")
                                    <div @click="mountVideo('https://videodelivery.net/{{ $content->uid }}/manifest/video.m3u8')" class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-auto text-xs">
                                            <i class="fa-solid fa-play-circle"></i>
                                        </div>
                                        <div class="w-full items-center font-robo text-sm">
                                                {{ $content->title }}
                                        </div>
                                        <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                1hr 20min
                                        </div>
                                    </div>
                                @elseif($content->type == "quiz")
                                    <div @click="showQuiz('{{ $content->id }}')" class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-auto text-xs">
                                            <i class="fa-solid fa-circle-question"></i>
                                        </div>
                                        <div class="w-full items-center font-robo text-sm">
                                                {{ $content->title }}
                                        </div>
                                        <div class="w-20 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                10 questions
                                        </div>
                                    </div>
                                @endif                       
                            @endif
                                
                    @endforeach
                    </div>
                    </div>
                @endif
                </div>
            </div>

        <div class="w-full px-8 pb-6 pt-2">

        <div x-data="{selected3: null,}" x-show="theater && tab == 'contents'" class="hidden lg:flex flex-col w-full right-0 h-full">
                <button class="flex lg:hidden  items-center justify-center w-full h-12">Contents</button>
                <div class="w-full rounded-xl">
                    <div @click="mountVideo('{{ $promotional_video}}')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                        <div class="flex items-center justify-center w-16 h-auto text-xs">
                            <i class="fa-solid fa-play-circle"></i>
                        </div>
                        <div class="w-full items-center font-robo">
                            Introduction to course
                        </div>
                        <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                1hr 20min
                        </div>
                    </div>

                    @if($this->numberOfSections() < 2)
                    @foreach($contents as $content)
                        @if($content->type != "section")
                            @if($content->type == "video")
                                <div @click="mountVideo('https://videodelivery.net/{{ $content->uid }}/manifest/video.m3u8')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                                        <i class="fa-solid fa-play-circle"></i>
                                    </div>
                                    <div class="w-full items-center font-robo">
                                        {{$content->title}}
                                    </div>
                                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                        1hr 20min
                                    </div>
                                </div>
                            @elseif($content->type == "quiz")
                                <div @click="showQuiz('{{ $content->id }}')" class="border-b hover:border-b-4 dark:border-darker transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                    <div class="flex items-center justify-center w-16 h-auto text-xs">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </div>
                                    <div class="w-full items-center font-robo">
                                        {{$content->title}}
                                    </div>
                                    <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                        1hr 20min
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @else
                    @foreach($contents as $content)
                            @if($content->type == "section" && $content->position == 0)
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected3 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected3 !== {{$content->id}} ? selected3 = {{$content->id}} : selected3 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected3 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$content->id}}" x-bind:style="selected3 == {{$content->id}} ? 'max-height: ' + $refs.container{{$content->id}}.scrollHeight + 'px' : ''">

                            @elseif($content->type == "section" && $content->position == ($this->numberOfContents()-1))
                                </div>
                                </div>
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected3 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected3 !== {{$content->id}} ? selected3 = {{$content->id}} : selected3 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected3 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                            @elseif($content->type == "section" && $content->position > 0)
                                </div>
                                </div>
                                <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected3 == {{$content->id}} }">
                                    <button class="absolute w-full h-10 top-0 z-10" @click="selected3 !== {{$content->id}} ? selected3 = {{$content->id}} : selected3 = null"></button>
                                    <div class="w-full flex items-center">
                                        <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                                        <div class="flex w-full justify-between items-center pr-4 py-2">
                                            <div>{{ $content->title}}</div>
                                            <div class="flex items-center justify-center" >
                                                <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected3 == {{$content->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$content->id}}" x-bind:style="selected3 == {{$content->id}} ? 'max-height: ' + $refs.container{{$content->id}}.scrollHeight + 'px' : ''">
                            @endif

                            @if($content->type != "section")
                                @if($content->type == "video")
                                    <div @click="mountVideo('https://videodelivery.net/{{ $content->uid }}/manifest/video.m3u8')" class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-auto text-xs">
                                            <i class="fa-solid fa-play-circle"></i>
                                        </div>
                                        <div class="w-full items-center font-robo text-sm">
                                                {{ $content->title }}
                                        </div>
                                        <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                1hr 20min
                                        </div>
                                    </div>
                                @elseif($content->type == "quiz")
                                    <div @click="showQuiz('{{ $content->id }}')" class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-auto text-xs">
                                            <i class="fa-solid fa-circle-question"></i>
                                        </div>
                                        <div class="w-full items-center font-robo text-sm">
                                                {{ $content->title }}
                                        </div>
                                        <div class="w-20 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                10 questions
                                        </div>
                                    </div>
                                @endif                       
                            @endif
                                
                    @endforeach
                    </div>
                    </div>
                @endif
                </div>
            </div>

        <div class="w-full pr-8 pl-3 pb-6 pt-2">

            <button class="flex items-center justify-center lg:hidden w-full h-12">About</button>
            <div x-show="tab == 'about'" class="flex flex-col h-auto w-full">
                <div class="my-4">
                    <x-text.h class="text-xl">Requirements </x-text.h>
                    <div>
                        {!!$requirement!!}
                    </div>
                </div>

                <div class="my-4">
                    <x-text.h class="text-xl">Description </x-text.h>
                    <div>
                        {!!$description!!}
                    </div>
                </div>

                <div class="my-4">
                    <x-text.h class="text-xl">Who this course is for : </x-text.h>
                    <div>
                        {!!$target!!}
                    </div>
                </div>

                <div class="my-4">
                    <x-text.h class="text-xl">What you'll learn </x-text.h>
                    <div>
                        {!!$outcome!!}
                    </div>
                </div>
            </div>

            
        </div>

    </div>
    <script>
        
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('crdiv', () => ({
                theater: false,
                tab: 'about',
                content: 'video',

                mountContent(type)
                {
                    if(type == "video")
                    {
                        this.content = type;

                    }
                },

                showQuiz($content_id)
                {
                    @this.call('showQuiz', $content_id);
                    this.content = 'quiz';
                },


                setLocalDataTheater(theater)
                {
                    localStorage.setItem("theater", theater);
                },

                toggleTheater()
                {
                    console.log('toggle')
                    this.theater = ! this.theater;
                    this.setLocalDataTheater(this.theater);
                },

                mountVideo(videoUrl)
                {
                    this.content = 'video';
                    const video = document.querySelector(".coursereviewplyr");
                    const source = videoUrl;
                    document.getElementById('coursereviewvideoplyr').src = videoUrl;
                    const defaultOptions = {};
                    if (Hls.isSupported()) {
                        const hls = new Hls();
                        hls.loadSource(source);

                        hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {

                        var availableQualities = hls.levels.map((l) => l.height)
                        availableQualities.reverse();

                        defaultOptions.quality = {
                            default: availableQualities[1],
                            options: availableQualities,
                            forced: true,        
                            onChange: (e) => updateQuality(e),
                        }
                        defaultOptions.ratio = '16:9';
                        defaultOptions.autoplay = false;

                        player = new Plyr(video, defaultOptions);
                        });
                        hls.attachMedia(video);
                        window.hls = hls;
                    } else {
                        player = new Plyr(video, defaultOptions);
                    }

                    function updateQuality(newQuality) {
                        window.hls.levels.forEach((level, levelIndex) => {
                            if (level.height === newQuality) {
                                console.log("Found quality match with " + newQuality);
                                window.hls.currentLevel = levelIndex;
                            }
                        });
                    }
                },

                init()
                {
                    console.log(localStorage.getItem("theater"))
                    if(localStorage.getItem("theater")=="true"){
                        this.theater = localStorage.getItem("theater");
                    }
                    else
                    {
                        this.theater = false;
                    }

                    this.mountVideo('{{$promotional_video}}');
                    
                    Livewire.on('stopPlyr', e => {
                        player.pause();
                    })
                }
            }))
        })
        
    </script>
</div>
