<div class="pt-16 flex flex-col items-center justify-center flex-1 w-full max-w-6xl px-4">   
    <x-text.h class="text-3xl font-semibold text-center">First, lets start with the title.</x-text.h>
    <x-text.p class="text-lg text-center">Please specify your course title and the subtitle</x-text.p>
    <div class="w-full flex flex-col items-center justify-center">
        <div class="w-full max-w-2xl mt-8 ">
            <x-input.label value="{{ $title }}" id="title" label="Title" type="text" class="w-full" placeholder="Untitled course"/>
        </div>
        <div class="w-full max-w-2xl mt-8 ">
            <x-input.label value="{{ $subtitle }}" id="subtitle" label="Subtitle" type="text" class="w-full" placeholder="Untitled subtitle course"/>
        </div>
    </div>
</div>