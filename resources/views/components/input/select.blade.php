<select {!! $attributes->merge(['id' => '', 'name' => '', 'class' => 'w-full h-10 font-robo text-darker dark:text-lighter rounded-md bg-white dark:bg-darker-2 border border-lighter dark:border-darkest hover:border-light dark:hover:border-dark focus:border-lightest dark:focus:border-darker focus:ring-0 focus:shadow-md transition duration-300']) !!} >
    {{ $slot }}
</select>
