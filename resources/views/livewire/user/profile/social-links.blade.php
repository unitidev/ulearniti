<div class="flex mb-2 font-robo text-darker dark:text-lighter rounded-md bg-white dark:bg-darker-2 border border-lighter dark:border-darkest hover:border-light dark:hover:border-dark focus-within:border-lightest dark:focus-within:border-primary focus-within:ring-0 focus-within:shadow-md transition duration-300">
    <div class="flex flex-1">
        <div class="w-10 h-10 flex items-center justify-center text-dark">
            <i class="fa-brands fa-{{$type}}"></i>
        </div>
        <div class="flex flex-1 h-10">
            <div class="flex items-center justify-center dark:text-dark">{{ $url }}</div>
            <div class="flex flex-1"><input class="pl-0 w-full border-none bg-transparent focus:ring-0 dark:text-dark" type="text" wire:model.lazy="username" wire:focusout="updateSocialLink"></div>
        </div>
    </div>
    <div wire:click="clearSocialLink({{$social_link_id}})" class="w-10 h-10 hover:text-primary text-dark cursor-pointer text-xs flex items-center justify-center"><i class="fa-light fa-xmark"></i></div>
</div>