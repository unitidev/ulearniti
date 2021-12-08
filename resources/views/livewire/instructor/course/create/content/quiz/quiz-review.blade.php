<div x-data="quiz_review" class="relative w-full h-full bg-white dark:bg-darkest-1 rounded-xl p-4 flex items-center justify-center">
<div class="absolute bottom-4 right-4">Question {{$question_number}}/{{$this->totalQuestions()}}</div>

    
    <div class="w-full absolute top-4 left-4">
        <div class="font-mont text-lg ">{{ $title }}</div>

    </div>
    @if($questions)
        @for($i = 0; $i < $this->totalQuestions(); $i++)
            <div x-show="question_number == {{$i}}" class="w-full h-auto flex items-center justify-center"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0">
                
                    <div class="w-full px-10">
                        <div class="font-mont font-semibold text-darker dark:text-lightw w-full flex justify-center text-center">{{ $questions[$i]->title}}</div>

                        <div class="mt-8">
                            @livewire('instructor.course.create.content.quiz.answer-review',['question_id'=>$questions[$i]->id], key($questions[$i]->id))
                        </div>
                    </div>
              
            </div>
        @endfor
    @endif

    <button x-show="question_number > 0 " @click="question_number--" class="absolute left-10 bottom-16 rounded-lg text-white w-20 h-10 bg-primary" wire:click="decrementQuestionNumber">Back</button>
    <button x-show="question_number < total_question-1" @click="question_number++" class="absolute bottom-16 right-10 rounded-lg text-white w-20 h-10 bg-primary" wire:click="incrementQuestionNumber">Next</button>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('quiz_review', () => ({
                question_number: 0,
                total_question: '{{ $this->totalQuestions()}}',
    
                init()  
                {
                    Livewire.on('updateTotalQuestions', totalQNum =>{

                        this.total_question = totalQNum;
                        this.question_number = 0;

                    })
                }
            }))
        })
    </script>
</div>