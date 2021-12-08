<header x-data="header" class="fixed z-10 w-full h-20 bg-white dark:bg-dark-1 transform duration-300" :class="{'bg-lightest dark:bg-darkest-1' : !scrollAtTop && !subnav, 'bg-white dark:bg-darker-1' : !scrollAtTop && subnav, 'bg-light dark:bg-darker-1' : scrollAtTop && subnav, 'bg-light dark:bg-dark-1' : scrollAtTop && !subnav}" @scroll.window="scrollAtTop = (window.pageYOffset > 50) ? false : true"}>
    <div class="pr-4 w-full h-full flex items-center justify-between mx-auto">
        <div class="flex">
            <div class="w-20 h-20 flex items-center justify-center bg-red">
                <div class="w-20 h-10 border-dark border-r-2 flex items-center justify-center">
                    <div class="w-10 h-10">
                        <img src="/svg/ulearniti-logo.svg" alt="">
                    </div>
                </div>            
            </div>
            <div class="items-center ml-4 hidden md:flex">
                <h1 class="hidden md:flex text-xl ml-2 font-medium font-mont text-darker dark:text-light">{{ $navigation }}</h1>
            </div>
        </div>
        <div class="w-full max-w-xl h-20 py-3 flex items-center justify-center">
            <a href="/admin/analytics/1" class="w-full h-full group hover:bg-white dark:hover:bg-darker-1 hover:text-primary mx-1 transform duration-300 rounded-md flex flex-col items-center justify-center" :class="{' border-lighter' : navigation == 'Analytics', 'bg-lightest dark:bg-darker-1' : scrollAtTop && navigation == 'Analytics', 'bg-white shadow-md dark:shadow-none dark:bg-darker-1' : ! scrollAtTop && navigation == 'Analytics'}">
                <div class="w-6 h-6 flex group-hover:text-primary items-center justify-center text-xl text-light" :class="{'text-primary' : navigation == 'Analytics'}">
                    <i class="fa-light fa-chart-mixed"></i>
                </div>
                <div class="flex items-center group-hover:text-primary justify-center font-robo text-xxs text-light" :class="{'text-primary' : navigation == 'Analytics'}">
                    ANALYTICS
                </div>
            </a>
            <a href="/admin/users/1" class="w-full h-full group hover:bg-white dark:hover:bg-darker-1 hover:text-primary mx-1 transform duration-300 rounded-md flex flex-col items-center justify-center" :class="{' border-lighter' : navigation == 'Users', 'bg-lightest dark:bg-darker-1' : scrollAtTop && navigation == 'Users', 'bg-white shadow-md dark:shadow-none dark:bg-darker-1' : ! scrollAtTop && navigation == 'Users'}">
                <div class="w-6 h-6 flex group-hover:text-primary items-center justify-center text-xl text-light" :class="{'text-primary' : navigation == 'Users'}">
                    <i class="fa-light fa-address-book"></i>
                </div>
                <div class="flex items-center group-hover:text-primary justify-center font-robo text-xxs text-light" :class="{'text-primary' : navigation == 'Users'}">
                    USERS
                </div>
            </a>
            <a href="/admin/courses/1" class="w-full h-full group hover:bg-white dark:hover:bg-darker-1 hover:text-primary mx-1 transform duration-300 rounded-md flex flex-col items-center justify-center" :class="{' border-lighter' : navigation == 'Courses', 'bg-lightest dark:bg-darker-1' : scrollAtTop && navigation == 'Courses', 'bg-white shadow-md dark:shadow-none dark:bg-darker-1' : ! scrollAtTop && navigation == 'Courses'}">
                <div class="w-6 h-6 flex group-hover:text-primary items-center justify-center text-xl text-light" :class="{'text-primary' : navigation == 'Courses'}">
                    <i class="fa-light fa-chalkboard-user"></i>
                </div>
                <div class="flex items-center group-hover:text-primary justify-center font-robo text-xxs text-light" :class="{'text-primary' : navigation == 'Courses'}">
                    COURSES
                </div>
            </a>
            <a href="/admin/finances/1" class="w-full h-full group hover:bg-white dark:hover:bg-darker-1 hover:text-primary mx-1 transform duration-300 rounded-md flex flex-col items-center justify-center" :class="{' border-lighter' : navigation == 'Finances', 'bg-lightest dark:bg-darker-1' : scrollAtTop && navigation == 'Finances', 'bg-white shadow-md dark:shadow-none dark:bg-darker-1' : ! scrollAtTop && navigation == 'Finances'}">
                <div class="w-6 h-6 flex group-hover:text-primary items-center justify-center text-xl text-light" :class="{'text-primary' : navigation == 'Finances'}">
                    <i class="fa-light fa-money-from-bracket"></i>
                </div>
                <div class="flex items-center group-hover:text-primary justify-center font-robo text-xxs text-light" :class="{'text-primary' : navigation == 'Finances'}">
                    FINANCES
                </div>
            </a>
            <a href="/admin/search/1" class="w-full h-full group hover:bg-white dark:hover:bg-darker-1 hover:text-primary mx-1 transform duration-300 rounded-md flex flex-col items-center justify-center" :class="{' border-lighter' : navigation == 'Search', 'bg-lightest dark:bg-darker-1' : scrollAtTop && navigation == 'Search', 'bg-white shadow-md dark:shadow-none dark:bg-darker-1' : ! scrollAtTop && navigation == 'Search'}">
                <div class="w-6 h-6 flex group-hover:text-primary items-center justify-center text-xl text-light" :class="{'text-primary' : navigation == 'Search'}">
                    <i class="fa-light fa-magnifying-glass"></i>
                </div>
                <div class="flex items-center group-hover:text-primary justify-center font-robo text-xxs text-light" :class="{'text-primary' : navigation == 'Search'}">
                    SEARCH
                </div>
            </a>
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
                <img class="h-10 w-10 rounded-full" src="{{ $this->profilePicture }}" alt="">
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
            navigation: '{{ $navigation }}',

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
