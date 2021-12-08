<header x-data="header_wizard" class="pl-0 fixed z-20 w-full transform duration-300">
    <div class="w-full h-16 flex pr-4 justify-center transition duration-300 bg-white dark:bg-darkest-2">
        <div class="w-full flex items-center justify-between">
            <div class="flex items-center">
                <a href="/instructor/courses" class="w-16 h-10 flex items-center justify-center text-2xl border-r border-lightest dark:border-dark text-darker dark:text-lighter"><i class="fa-light fa-arrow-left"></i></a>
                <h1 class="hidden md:flex text-xl ml-2 font-medium font-mont text-darker dark:text-light">{{ $page ?? 'Please insert page'}}</h1>
            </div>
            
            <div class="grid grid-flow-col gap-4 items-center justify-center">
                <button @click="toggleTheme('{{ $this->theme }}')" class="relative w-8 h-8 rounded-full bg-yellow-300">
                    <div wire:ignore class="absolute w-8 h-8 flex items-center justify-center top-0 text-xl"><i id="moon" class="fa-light fa-moon"></i></div>
                    <div wire:ignore class="absolute w-8 h-8 flex items-center justify-center top-0 text-xl"><i id="sun" class="fa-light fa-sun"></i></div>
                    
                </button>
                <div class="w-8 h-8 rounded-full hover:bg-white dark:hover:bg-darker-2 flex items-center justify-center text-xl text-dark dark:text-light transform duration-300"><div wire:ignore><i class="fa-light fa-comment"></i></div></div>
                <div class="w-8 h-8 rounded-full hover:bg-white dark:hover:bg-darker-2 flex items-center justify-center text-xl text-dark dark:text-light transform duration-300"><div wire:ignore><i class="fa-light fa-bell"></i></div></div>
                <img class="h-10 w-10 rounded-full" src="{{ $profilePicture }}" alt="">
            </div>  
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
        Alpine.data('header_wizard', () => ({
            theme: '{{ $theme }}',
            dark_mode: false,

            toggleTheme() {
                if(this.theme == 'dark') {
                    dark_mode = false
                    this.theme = "light"
                    this.setTheme('light')
                }
                else {
                    dark_mode = true
                    this.theme = "dark"
                    this.setTheme('dark')
                }
                @this.call('changeTheme');
            },

            setTheme(theme) {
                if(theme == 'dark') {
                    document.getElementById('htmltag').classList.add('dark')
                    document.getElementById("moon").classList.remove("opacity-100")
                    document.getElementById("moon").classList.add("opacity-0")
                    document.getElementById("sun").classList.add("opacity-100")
                    document.getElementById("sun").classList.remove("opacity-0")
                }
                else {
                    document.getElementById('htmltag').classList.remove('dark')
                    document.getElementById("sun").classList.remove("opacity-100")
                    document.getElementById("sun").classList.add("opacity-0")
                    document.getElementById("moon").classList.add("opacity-100")
                    document.getElementById("moon").classList.remove("opacity-0")
                }
            },

            init() {

                localStorage.theme = '{{$theme}}'
                this.setTheme(localStorage.theme)
            }
        }))
    })
    </script>
</header>

