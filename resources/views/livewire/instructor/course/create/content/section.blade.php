<div class="group relative w-full focus-within:shadow-md bg-white dark:bg-darker-2 border border-lighter dark:border-darkest rounded-b-md rounded-tl-md transform duration-200">
    @if($position != 0)<div class="w-full bg-light dark:bg-darker-1 relative transform duration-200 rounded-tl-md text-2xl flex items-center justify-center" :class="focused_content != {{ $content_id }} ? '' : 'py-2'">
        <span handle class="handle absolute iconify cursor-move" data-icon="mdi:drag-horizontal" x-show="focused_content == {{ $content_id }}"></span>
    </div>@endif
    <div class="w-full transform duration-300">
        <div class="flex items-center">
            <div class="h-10 w-12 rounded-md items-center justify-center flex">
                <i class="fa-solid fa-bars-staggered"></i>
            </div>
            <input wire:model.lazy="title" wire:focusout="updateContent" class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-none focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" type="text"/>
        </div>
    </div>
</div>