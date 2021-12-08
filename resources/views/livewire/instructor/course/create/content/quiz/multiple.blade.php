<div x-data=
"{
    answerKey: false,

    removeAnswer(id){
        console.log('dapat')
        @this.call('removeAnswer', id)
    },
}" class="w-full bg-white dark:bg-darker-1 rounded-md border dark:border-dark border-lighter text-darker dark:text-lighter py-2 px-4">
    <x-text.p class="text-xs font-robo">Multiple Select Question</x-text.p>
    <div>

    </div>
    <input wire:model.lazy="question" wire:focusout="updateQuestion({{ $question_id }})" class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-none focus:ring-0 font-mont text-md font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="Multiple Select Question" type="text"/>  
    <div class="w-full relative overflow-hidden transition-all pl-4 max-h-0 duration-300" style="" x-ref="container{{ $question_id }}" :style="focused_question == {{ $question_id }} ? 'max-height: ' + $refs.container{{ $question_id }}.scrollHeight + 'px' : ''">
        <div class="w-full h-auto" :class="{'pb-10': answerKey}">
            <div>
                @foreach($answers as $answer)
                <div class="relative flex justify-between items-center z-40" :class="{'hover:bg-washed-primary': answerKey}">
                    <div wire:click="setCorrectAnswer({{ $answer->id }})" class="absolute z-20 top-0 w-full h-full" x-show="answerKey"></div>
                    <div class="flex w-full items-center justify-between">
                        <div class="flex items-center w-full">
                            <div class="w-8 h-8 flex items-center justify-center">
                                @if($answer->correct_answer == "true")
                                    <i class="fa-solid fa-circle"></i>
                                @else
                                    <i class="fa-light fa-circle "></i>
                                @endif
                            </div>
                            @livewire('instructor.course.create.content.quiz.answer-multiple', ['answer_id' => $answer->id], key($answer->id))
                        </div>
                    </div>
                    <button x-show="!answerKey" @click="removeAnswer({{ $answer->id }})" class="w-8 h-8 rounded-full hover:bg-lighter"><i class="fa-solid fa-circle-xmark"></i></button>
                </div>
                @endforeach
                <div class="flex">                   
                    <div class="flex" x-show="!answerKey">
                        <div class="w-8 h-8 flex items-center justify-center"><i class="fa-light fa-circle"></i></div>
                        <div wire:click="addAnswer" class="h-8 flex items-center ml-4 border-b border-transparent hover:border-light cursor-text font-robo text-md text-light dark:text-dark">Add answer</div>  
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <div x-show="!answerKey" @click="answerKey = true" class="h-8 w-auto flex items-center ml-4 border-b border-transparent hover:border-light cursor-pointer font-robo text-md text-primary dark:text-washed-primary">Answer key</div>
                <div x-show="answerKey" @click="answerKey = false" class="h-8 w-auto flex items-center ml-4 border-b border-transparent hover:border-light cursor-pointer font-robo text-md text-primary dark:text-washed-primary">Done</div>
            </div>
        </div>    
    </div>
</div>
