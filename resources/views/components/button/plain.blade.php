<button {{ $attributes->merge(['wire:click' => '', 'class' => 'h-10 hover:brightness-95 rounded-md hover:shadow-lg px-4 text-white font-robo text-sm font-medium']) }}>{{ $slot }}</button>