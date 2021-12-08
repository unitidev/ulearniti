<div class="pt-16 flex flex-col items-center justify-center flex-1 w-full h-full max-w-6xl px-4">   
    <x-text.h class="text-3xl font-semibold text-center">Tell me more about your course</x-text.h>
    <x-text.p class="text-lg text-center">Explain in details about the course that you making.</x-text.p>
    <div wire:ignore id="descriptionWrapper" class="mt-8 w-full max-w-2xl relative pb-4 bg-white dark:bg-darker-2 focus-within:bg-lightest border border-lighter hover:border-light focus-within:border-light dark:border-darker focus-within:shadow-md dark:focus-within:border-primary transdiv duration-300 rounded-lg">
        <input id="description" value="{{ $description }}" type="hidden" autofocus>
        <trix-editor class="focus:outline-none min-h-[14rem]" id="trixDescription" input="description"></trix-editor>
    </div>
</div>