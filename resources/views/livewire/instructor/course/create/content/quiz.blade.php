<div class="group relative w-full focus-within:shadow-md bg-white dark:bg-darker-2 border border-lighter dark:border-darkest rounded-md transform duration-200">
    <div class="w-full bg-light dark:bg-darker-1 relative transform duration-200 rounded-t-md text-2xl flex items-center justify-center" :class="focused_content != {{ $content_id }} ? '' : 'py-2'">
        <span handle class="handle absolute iconify cursor-move" data-icon="mdi:drag-horizontal" x-show="focused_content == {{ $content_id }}"></span>
    </div>
    <div class="w-full transform duration-300">
        <div class="flex items-center justify-between">
            <div class="h-10 w-12 rounded-md items-center justify-center flex">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <input wire:model.lazy="title" wire:focusout="updateContent" class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-none focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" type="text"/>  
            <div class="pr-2">
                <button wire:click="manageQuiz" class="w-32 h-8 bg-light dark:bg-dark-1 rounded-sm" x-show="focused_content == {{$content_id}}">Manage</button>
            </div>
        </div>
        <div class="w-full relative overflow-hidden transition-all pl-4 max-h-0 duration-300" style="" x-ref="container{{ $content_id }}" :style="focused_content == {{ $content_id }} ? 'max-height: ' + $refs.container{{ $content_id }}.scrollHeight + 'px' : ''">
            <div class="w-full flex mb-4 items-center justify-between pr-4">
                <div class="pl-9">
                    <div>Total of questions : {{ $this->getAllQuestion()}}</div>
                    <div>Single Select Choice Question : {{ $this->getSingleChoiceQuestion()}}</div>
                    <div>Multiple Select Choice Question : {{ $this->getMultipleChoiceQuestion()}}</div>
                    <div>True or False Question : {{ $this->getTrueFalsequestion()}} </div>
                </div>
            </div>
        </div>
    </div>
</div>