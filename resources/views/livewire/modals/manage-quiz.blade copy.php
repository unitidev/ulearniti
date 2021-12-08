<div x-data="manage_quiz" class="w-full min-h-screen">
    {{$content_id}}
    @foreach($quizes as $quiz)
    <div class="max-w-6xl h-96 rounded-xl border-2 border-black my-4">
        @if($quiz->type == "mcq")
        <div class="mt-2 w-full">
            <div class="flex w-full justify-between">
                <div class="flex font-mont px-2 w-36 text-lg font-semibold items-center">Question : </div>
                <input class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-0 underline focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="Quiz Title " type="text">
            </div>
            <div class="flex justify-between items-center">
                <div class="w-2/3 flex flex-col justify-between px-20">
                    <div class="flex my-4">
                        <div class="flex font-mont text-lg font-semibold items-center mr-2">A.</div>
                        <input class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-0 underline focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="Answer 1" type="text">
                    </div>
                    <div class="flex my-4">
                        <div class="flex font-mont text-lg font-semibold items-center mr-2">B.</div>
                        <input class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-0 underline focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="Answer 2" type="text">
                    </div>
                    <div class="flex my-4">
                        <div class="flex font-mont text-lg font-semibold items-center mr-2">C.</div>
                        <input class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-0 underline focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="Answer 3" type="text">
                    </div>
                    <div class="flex my-4">
                        <div class="flex font-mont text-lg font-semibold items-center mr-2">D.</div>
                        <input class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-0 underline focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="Answer 4" type="text">
                    </div>
                </div>
                <div class="w-1/3 ">
                    <div class="h-40 w-40 border-2 border-black flex items-center justify-center">
                        <input class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-0 focus:ring-0 font-mont text-4xl text-center font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" placeholder="A" type="text">
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endforeach 
    <div class="flex">
        <div wire:click="addQuiz('mcq')" class="w-1/3 py-3 flex items-center hover:bg-gray-900 justify-center rounded-tl-xl bg-gray-600 text-white text-xl h-full">MCQ</div>
        <div @click="openQuiz('scq')" class="w-1/3 py-3 flex items-center hover:bg-gray-900 justify-center bg-gray-600 text-white text-xl h-full">SCQ</div>
        <div @click="openQuiz('tfq')" class="w-1/3 py-3 flex items-center hover:bg-gray-900 justify-center rounded-tr-xl bg-gray-600 text-white text-xl h-full">TFQ</div>
    </div>
    <button type="hidden" id="showModalQuizBtn" @click="modals = true"></button>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('manage_quiz', () => ({
                quizTab: false,
    
                openQuiz(type) {  
                    @this.call('addQuiz', type)
                    //document.getElementById('content').innerHTML = type;
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
