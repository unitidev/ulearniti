<div x-data="course_content" class="flex flex-col items-center flex-1 w-full h-full max-w-3xl transform duration-300 min-h-screen pt-24">
    <x-text.h class="text-3xl font-semibold text-center">Course Content</x-text.h>
    <x-text.p class="text-lg text-center">Course Content</x-text.p>
    <div class="w-full flex justify-end pr-16 pt-4 mb-4" id="course_duration">Course duration : {{$this->totalVideoDuration()}}</div>
    <div class="w-full flex mb-36">
        <div class="relative w-full">
            @foreach($contents as $content)
                @if($content->type == "section" && $content->position == 0 && $this->totalOfSection() > 1)
                    <div @click="setFocusedContent($event.target); focused_content_type = 'section';" content-item position="0" id="{{ $content->id }}" content-type="{{ $content->type }}" class="filtered w-full mb-2">
                        <div class="w-full flex justify-end">
                            <div class="w-36 h-6 bg-primary rounded-t-md flex items-center justify-center text-white text-sm font-robo font-medium">Section 1 of {{ $this->totalOfSection() }}</div>
                        </div>
                        @livewire('instructor.course.create.content.section', ['content_id' => $content->id], key($content->id))
                    </div>
                @endif
            @endforeach
            <div content-list class="w-full">
                @foreach($contents as $content)
                    @if($content->type == "video")
                        <div @click="setFocusedContent($event.target); focused_content_type = 'video';" content-item position="{{ $content->position }}" id="{{ $content->id }}" content-type="{{ $content->type }}" class="w-full mb-2 md:pl-10">
                            @livewire('instructor.course.create.content.video', ['content_id' => $content->id], key($content->id))
                        </div>
                    @elseif($content->type == "quiz")
                        <div @click="setFocusedContent($event.target); focused_content_type = 'quiz';" content-item position="{{ $content->position }}" id="{{ $content->id }}" content-type="{{ $content->type }}" class="w-full mb-2 md:pl-10">
                            @livewire('instructor.course.create.content.quiz', ['content_id' => $content->id], key($content->id))
                        </div>
                    @elseif($content->type == "section" && $content->position != 0)
                        <div @click="setFocusedContent($event.target); focused_content_type = 'section';" content-item position="{{ $content->position }}" id="{{ $content->id }}" content-type="{{ $content->type }}" class="w-full mb-2 mt-8">
                            <div class="w-full flex justify-end">
                                <div class="w-36 h-6 bg-primary rounded-t-md flex items-center justify-center text-white text-sm font-robo font-medium">Section {{ $this->section_number }} of {{ $this->totalOfSection() }}</div>
                            </div>
                            @livewire('instructor.course.create.content.section', ['content_id' => $content->id], key($content->id))
                        </div>
                        {{ $this->incSectionNumber() }}
                    @endif
                @endforeach	
		    </div>
        </div>
        <div class="relative w-16 h-auto">
            <div wire:ignore option-buttons style = "top: 0px" class="right-0 absolute transform duration-300 w-12 py-2 bg-white dark:bg-darker-2 rounded-l-md md:rounded-r-md border border-lighter dark:border-darkest shadow-md">
                <div class="w-12 h-10 text-2xl text-darkest dark:text-lighter items-center justify-center flex"><button id="delete_content_btn" opt-btn @click="deleteContent" class="disabled:opacity-25 delete-btn text-lg"><i class="fa-solid fa-trash-can"></i></button></div>
                <div class="w-12 h-10 text-2xl text-darkest dark:text-lighter items-center justify-center flex"><button opt-btn @click="addContent('section')" class="disabled:opacity-25 text-lg"><i class="fa-solid fa-bars-staggered"></i></button></div>
                <div class="w-12 h-10 text-2xl text-darkest dark:text-lighter items-center justify-center flex"><button opt-btn @click="addContent('video')" class="disabled:opacity-25 text-lg"><i class="fa-solid fa-circle-play"></i></button></div>
                <div class="w-12 h-10 text-2xl text-darkest dark:text-lighter items-center justify-center flex"><button opt-btn @click="addContent('quiz')" class="disabled:opacity-25 text-lg"><i class="fa-solid fa-circle-question"></i></button></div>
            </div>
        </div>
	</div>

        <x-ui.modal maxWidth="4xl">
            <div x-show="focused_content_type == 'quiz'">
            @livewire('modals.manage-quiz')
            </div>
    
            <div x-show="focused_content_type == 'video'">
            @livewire('modals.plyr')
            </div>

        </x-ui.modal>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('course_content', () => ({
                focused_content: '{{ $focused_content }}',
                
                setFocusedContent(e)
                {
                    
                    this.focused_content = e.closest('[content-item]').getAttribute('id');
                    this.setOptionPosition(e)
                },

                setOptionPosition(e)
                {
                    var focused_content_type = e.closest('[content-item]').getAttribute('content-type')
                    @this.call('setContentType', focused_content_type)
                    setTimeout(function() { 
                        document.querySelector('[option-buttons]').style = 'top:' + e.closest('[content-item]').offsetTop + 'px'
                    }, 300);   
                },

                deleteContent()
                {
                    @this.call('deleteContent', this.focused_content)
                },

                addContent(type)
                {
                    @this.call('addContent', this.focused_content, type)
                },

                init() {
                    this.setFocusedContent(e = document.querySelector("[position='1']"))
                    {
                        this.focused_content = e.closest('[content-item]').getAttribute('id');
                        this.setOptionPosition(e)
                    }

                    Livewire.on('setPosition', id => {
                        this.focused_content = id;
                        this.setOptionPosition(document.querySelector("[id='"+id+"']"))
                    })

                    Livewire.on('setPositionSort', e => {
                        this.setOptionPosition(document.querySelector("[id='"+this.focused_content+"']"))
                    })

                    Livewire.on('durationExceed', duration => {
                        document.getElementById('course_duration').classList.add('text-red-500')
                    })

                    var list = document.querySelector('[content-list]');
                    var sortable = Sortable.create(list, {
                        animation: 300,
                        filter: '.filtered',
                        handle: '.handle',
                        onEnd: function (evt) {
                            var content = evt.item;
                            sortContents();
                        }
                    });

                    function sortContents()
                    {
                        var position = 1;
                        var contents_array = [];
                        var contents = document.querySelector('[content-list]')
                        contents.querySelectorAll('[content-item]').forEach(content => {
                            content.setAttribute("position", position);
                            var contentObj = {position:content.getAttribute("position"), id:content.getAttribute("id")}
                            contents_array.push(contentObj);
                            position++;
                        })
                        @this.call('sortContents', contents_array);
                    }
                }
            }))
        })
    </script>
</div>
