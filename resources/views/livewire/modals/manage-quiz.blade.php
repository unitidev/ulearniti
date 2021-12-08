<div x-data="manage_quiz" class="w-full">
    
    <button type="hidden" id="showModalQuizBtn" @click="modals = true"></button>

    <div class="w-full flex items-center justify-center ">
        <div class="bg-light dark:bg-dark-1 w-full max-w-5xl pb-40 rounded-xl p-8" @click.outside="modals = false">
            <x-text.h class="text-3xl font-semibold text-center">{{$title}}</x-text.h>

            <div class="w-full flex flex-col items-center justify-center mt-4">

                <div class="w-full">
                    @foreach($questions as $question)
                        <div class="w-full flex relative">
                            <div question-item id="{{$question->id}}" @click="setFocusedQuestion($event.target)" class="w-full mb-2 flex justify-between">
                                
                                @if($question->type == 'single')
                                    @livewire('instructor.course.create.content.quiz.single', ['id'=>$question->id, 'questionNumber'=> $this->questionNumber ], key($question->id))
                                @elseif($question->type == 'multiple')
                                    @livewire('instructor.course.create.content.quiz.multiple', ['id'=>$question->id, 'questionNumber'=> $this->questionNumber ], key($question->id))
                                @elseif($question->type == 'truefalse')
                                    @livewire('instructor.course.create.content.quiz.true-false', ['id'=>$question->id], key($question->id))
                                @endif
                                <button wire:click="removeQuestion({{ $question->id }})" class="absolute top-2 right-2 w-8 h-8 rounded-full text-lg hover:text-red-500" >
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>
                            {{ $this->incQuestionNumber()}}
                            
                        </div>
                    @endforeach
                </div>
                <div class="w-full flex">
                    <div class="relative w-full flex justify-end">
                        <div class="w-60 h-10 bg-white dark:bg-darker-2 border dark:border-dark border-lighter text-darker dark:text-lighter rounded-md mt-2 flex items-center justify-between pl-4" @click="question_dropdown_open = ! question_dropdown_open">
                            <div class="text-sm font-robo">Add Question</div>
                            <div class="w-10 h-full flex items-center justify-center">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="absolute top-10 w-60 bg-white border dark:bg-darker-2 dark:border-dark border-lighter rounded-md mt-2 text-darker dark:text-lighter" x-show="question_dropdown_open">
                            <button class="pl-4 w-full h-10 border-b dark:border-dark border-lighter flex items-center justify-between" @click="addQuiz('single')">
                                Single select
                                <div class="w-10 h-full flex items-center justify-center" >
                                    <i class="fa-solid fa-circle-dot"></i>
                                </div>
                            </button>
                            <button class="pl-4 w-full h-10 border-b dark:border-dark border-lighter flex items-center justify-between" @click="addQuiz('multiple')">
                                Multiple select
                                <div class="w-10 h-full flex items-center justify-center" >
                                    <i class="fa-solid fa-square-check"></i>
                                </div>
                            </button>
                            <button class="pl-4 w-full h-10 dark:border-dark border-lighter flex items-center justify-between" @click="addQuiz('truefalse')">
                                True or False
                                <div class="w-10 h-full flex items-center justify-center" >
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('manage_quiz', () => ({
                quizTab: false,
                question_dropdown_open: false,
                focused_question: '{{ $focused_question }}',

                setFocusedQuestion(e)
                {
                    this.focused_question = e.closest('[question-item]').getAttribute('id');
                    console.log
                },
    
                addQuiz(type) {  
                    @this.call('addQuestion', type)
                    //document.getElementById('content').innerHTML = type;
                    this.question_dropdown_open = false;
                },

                init()
                {
                    Livewire.on('showModal', content_id => {
                        console.log(content_id)
                        document.getElementById('showModalQuizBtn').click();
                    })
                }
            }))
        })
    </script>   
</div>