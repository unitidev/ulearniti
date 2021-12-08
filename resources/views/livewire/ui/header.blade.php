<header x-data="header" class="fixed z-10 md:pl-20 w-full h-16 bg-white dark:bg-dark-1 transform duration-300" :class="{'md:pl-80': subnav, 'bg-lightest dark:bg-darkest-1' : !scrollAtTop && !subnav, 'bg-white dark:bg-darker-1' : !scrollAtTop && subnav, 'bg-light dark:bg-darker-1' : scrollAtTop && subnav, 'bg-light dark:bg-dark-1' : scrollAtTop && !subnav}" @scroll.window="scrollAtTop = (window.pageYOffset > 50) ? false : true"}>
    <div class="relative px-4 w-full h-full flex items-center justify-between max-w-6xl mx-auto">
        <div class="flex items-center">
            <button wire:ignore @click="toggleSubNav" class="w-12 h-12 flex items-center text-lg text-primary">
                <i x-show="! subnav" class="fa-light fa-bars"></i>
                <i x-show="subnav" class="fa-light fa-angle-left"></i>
            </button>
            <h1 class="hidden md:flex text-xl ml-2 font-medium font-mont text-darker dark:text-light">{{ $page }}</h1>
        </div>
        <div class="grid grid-flow-col gap-4 items-center justify-center">
            <button class="relative w-8 h-8 rounded-full bg-yellow-300">
                <div @click="toggleTheme" wire:ignore class="absolute w-8 h-8 flex items-center justify-center top-0 text-xl transform duration-500"><i id="moon" class="fa-light fa-moon"></i></div>
                <div @click="toggleTheme" wire:ignore class="absolute w-8 h-8 flex items-center justify-center top-0 text-xl transform duration-500"><i id="sun" class="fa-light fa-sun"></i></div>
            </button>
            
            @if($auth)
                <div class="w-8 h-8 rounded-full hover:bg-white dark:hover:bg-darker-2 flex items-center justify-center text-xl text-dark dark:text-light transform duration-300"><div wire:ignore><i class="fa-light fa-comment"></i></div></div>
                <div class="w-8 h-8 rounded-full hover:bg-white dark:hover:bg-darker-2 flex items-center justify-center text-xl text-dark dark:text-light transform duration-300"><div wire:ignore><i class="fa-light fa-bell"></i></div></div>
            @endif
           
            @if($auth)
                <button @click="profile_dropdown = ! profile_dropdown" class="w-10 h-10 rounded-full">
                    <img class="h-10 w-10 rounded-full" src="{{ $this->profilePicture }}" alt="">
                </button>
                <!--     -->
                <div @click.outside="profile_dropdown = false" x-show="profile_dropdown" class="w-full max-w-[18rem] absolute h-auto top-16 right-4 bg-white dark:bg-darker-2 flex-col items-center justify-center rounded border border-lightest dark:border-dark" 
                    x-transition:enter="transition ease-out duration-300" 
                    x-transition:enter-start="transform opacity-0 scale-95" 
                    x-transition:enter-end="transform opacity-100 scale-100" 
                    x-transition:leave="transition ease-in duration-75" 
                    x-transition:leave-start="transform opacity-100 scale-100" 
                    x-transition:leave-end="transform opacity-0 scale-95"
                >
                    <div  class="p-4 cursor-pointer flex justify-start w-full border-b border-lightest dark:border-dark mb-2">
                        <div class="w-14 h-14 rounded-full mr-4">
                            <img class="w-14 h-14 rounded-full" src="{{ $this->profilePicture }}" alt="">
                        </div>
                        <div class="flex flex-col items-start h-14 justify-center">
                            <div class="flex items-center justify-start text-left font-mont text-sm font-medium dark:text-light line-clamp-1">{{$user->full_name}}</div>
                            <div class="text-xs font-robo text-dark font-light">Send a message to course owner</div>
                        </div>
                    </div>
                    <a href="{{$username}}" class="p-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start hover:bg-light dark:hover:bg-dark-2 w-full">
                        <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-user"></i></div>
                        <div class="flex flex-col items-start">
                            <div class="flex items-center justify-start text-left font-mont text-xs font-medium">View Profile</div>
                            <div class="text-xs font-robo text-dark font-light">Send a message to course owner</div>
                        </div>
                    </a>
                    <div class="mb-2">
                        <a href="/user/settings/profile" class="p-2 text-darker dark:text-lighter hover:text-primary dark:hover:text-primary cursor-pointer flex justify-start hover:bg-light dark:hover:bg-dark-2 w-full">
                            <div class="h-8 w-8 rounded-full mr-3 flex items-center justify-center"><i class="fa-thin fa-gear"></i></div>
                            <div class="flex flex-col items-start">
                                <div class="flex items-center justify-start text-left font-mont text-xs font-medium">Settings</div>
                                <div class="text-xs font-robo text-dark font-light">Change and updates</div>
                            </div>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('logout') }}"  class="border-t border-lightest dark:border-dark px-4 py-4"> @csrf
                        <button type="submit" class="w-full h-10 bg-primary rounded-md text-white font-robo font-light text-sm transform duration-200 hover:-translate-y-1 hover:shadow-lg"><i class="fa-light fa-arrow-right-from-bracket fa-rotate-180 mr-2"></i>Logout</button>
                    </form>
                </div>
                    <!--     -->
            @else
                <a href="/register" class="text-primary hover:underline font-robo text-xs font-light">Register</a>
                <a href="/login" class="w-24 h-8 flex items-center justify-center border border-primary rounded-md text-primary dark:text-lighter hover:text-primary transform duration-200 hover:shadow-md font-robo text-xs">Login</a>
            @endif
            
        </div>  
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
        Alpine.data('header', () => ({
            theme: '{{ $theme }}',
            dark_mode: false,
            scrollAtTop: true,
            profile_dropdown: false,

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
                this.setTheme(this.theme)
            }
        }))
    })
    </script>
</header>
