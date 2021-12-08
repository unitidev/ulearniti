<nav class="fixed z-30 md:-left-0 transform duration-300 bg-lightest dark:bg-darkest-1 w-20 h-screen" :class="{'-left-0': subnav, '-left-20': ! subnav}">
    <div class="w-full h-full flex flex-col items-center justify-between">
        <div>
            <div class="flex items-center justify-center w-full h-16">
                <div class="w-10 h-10">
                    <img src="/svg/ulearniti-logo.svg" alt="">
                </div>        
            </div>
            <div class="w-full h-16 flex items-center justify-center">
                <a href="/" class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-house"></i>
                </a>
            </div>
            <div class="w-full h-16 flex items-center justify-center">
                <a href="/instructor/become-instructor" class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-users"></i>
                </a>
            </div>
            <div class="w-full h-16 flex items-center justify-center">
                <div class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-book-open-reader"></i>
                </div>
            </div>
            <div class="w-full h-16 flex items-center justify-center">
                <div class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-diploma"></i>
                </div>
            </div>
            <div class="w-full h-16 flex items-center justify-center">
                <div class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-comment"></i>
                </div>
            </div>
        </div>  
        <div>
            <div class="w-full h-16 flex items-center justify-center">
                <div class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="w-full h-16 flex items-center justify-center">
                <div class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                    <i class="fa-light fa-gear"></i>
                </div>
            </div>
            @if($auth)
                <form method="POST" action="{{ route('logout') }}" class="w-full h-16 flex items-center justify-center"> @csrf
                    <button type="submit" class="w-10 h-10 flex items-center justify-center text-xl text-dark dark:text-light hover:text-primary dark:hover:text-primary">
                        <i class="fa-light fa-arrow-right-from-bracket fa-rotate-180"></i>
                    </button>
                </form>
            @endif
        </div> 
    </div>   
</nav>