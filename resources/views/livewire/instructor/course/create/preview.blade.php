<div x-data="create_course_preview" class="pt-16 flex flex-col items-center justify-center flex-1 w-full h-full max-w-6xl px-4">
    <div class="w-full mb-6">
        <x-text.h class="text-xl font-semibold">{{ $title }}</x-text.h>
    </div>
    <div class="w-full flex relative">

        <div class="md:w-2/3 rounded-xl bg-black">
            <div id="videoPlyr" class="aspect-w-16 aspect-h-9">
                <div class="container " id="playerContainer" @click.outside="modals = false">
                    <video controls crossorigin playsinline class="">
                        <source 
                            type="application/x-mpegURL" 
                            src=""
                        >
                    </video>
                </div>
            </div>
        </div>
        
        <div class="hidden md:flex flex-col w-1/3 pl-4 absolute top-0 right-0 h-full">
            <div class="w-full h-[30rem] bg-white dark:bg-darkest-1 rounded-xl overflow-y-auto">
                    <div class="bg-green-400 border-b hover:border-b-4 transform duration-200 w-full flex flex-1 justify-between pr-4 py-2 hover:bg-washed-primary dark:hover:bg-darker-1">
                        <div class="flex items-center justify-center w-16 h-auto text-xs">
                            <i class="fa-solid fa-play-circle"></i>
                        </div>
                        <div class="w-full items-center font-robo">
                                {{ $promotional_video}}
                        </div>
                        <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                1hr 20min
                        </div>
                    </div>

                @for($i=0; $i<$this->numberOfSections(); $i++)
                    <div class="relative w-full dark:border-darker border-b hover:border-b-4 transform duration-200" :class="{'pb-4': selected == {{$contents[$i]->id}} }">
                        <button class="absolute w-full h-10 top-0 z-10" @click="selected !== {{$contents[$i]->id}} ? selected = {{$contents[$i]->id}} : selected = null"></button>
                        <div class="w-full flex items-center">
                            <div class="w-14 flex items-center justify-center text-xs "><i class="fa-solid fa-bars-staggered"></i></div>
                            <div class="flex w-full justify-between items-center pr-4 py-2">
                                <div>{{ $contents[$i]->title}}</div>
                                <div class="flex items-center justify-center" >
                                    <div class="w-4 h-4 transform rotate-0 duration-200 flex items-center justify-center" :class="{ 'rotate-90': selected == {{$contents[$i]->id}} }"><i class="fa-light fa-angle-right" ></i></div>
                                </div>
                            </div>
                        </div>

                        @foreach($contents as $content)
                            @if($content->position > $i)
                                @if($content->type == "section")
                                    @break
                                @endif
                                <div class="relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="container{{$contents[$i]->id}}" x-bind:style="selected == {{$contents[$i]->id}} ? 'max-height: ' + $refs.container{{$contents[$i]->id}}.scrollHeight + 'px' : ''">
                                    @if($content->type == "video")
                                        <div class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1">
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
                                        <div class="w-full flex flex-1 justify-between px-4 py-1 hover:bg-washed-primary dark:hover:bg-darker-1">
                                            <div class="flex items-center justify-center w-10 h-auto text-xs">
                                                <i class="fa-solid fa-circle-question"></i>
                                            </div>
                                            <div class="w-full items-center font-robo text-sm">
                                                    {{ $content->title }}
                                            </div>
                                            <div class="w-16 h-auto flex items-center justify-end text-right font-robo text-xxs font-light">
                                                    10 questions
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        {{ $i++ }}
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="w-full h-96 bg-white"></div>
    <script>
        var player = new Plyr();
        
        const video = document.querySelector("video");
        const source = '{{ $url }}';
        
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
            defaultOptions.autoplay = true;

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
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('create_course_preview', () => ({
                selected: null,
    
        
            }))
        })
    </script>
</div>
