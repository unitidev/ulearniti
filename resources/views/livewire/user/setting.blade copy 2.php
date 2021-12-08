<div id="settingDiv" x-data="userSetting" class="mx-auto">
    <div class="w-full lg:flex justify-between items-start">
        <div class="w-full lg:w-1/3 pr-0 lg:pr-5 mb-10 lg:mb-0">
            <div class="w-full h-full bg-white dark:bg-dark-2 rounded-md flex flex-col">
                <div class="w-full flex p-6">
                    <div class=""><img class="w-16 h-16 rounded-full" src="{{ $this->getProfilePhoto($user->profile_photo) }}" alt=""></div>
                    <div class="flex-1 pl-4 h-16 text-light justify-between flex flex-col py-2">
                        <div class="font-mont text-lg font-semibold line-clamp-1">{{ $user->full_name }}</div>
                        <div class="text-xs text-dark">{{ $user->professional_headline }}</div>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="changePage('profile')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : page=='profile'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : page=='profile'}">
                                <i class="fa-light fa-user"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : page=='profile'}">Profile</div>
                        </div>
                        <div x-show="page=='profile'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : page=='profile'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="changePage('account')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : page=='account'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : page=='account'}">
                                <i class="fa-light fa-user-lock"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : page=='account'}">Account</div>
                        </div>
                        <div x-show="page=='account'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : page=='account'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="changePage('payment')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : page=='payment'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : page=='payment'}">
                                <i class="fa-light fa-credit-card"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : page=='payment'}">Payment</div>
                        </div>
                        <div x-show="page=='payment'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : page=='payment'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="changePage('privacy-security')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : page=='privacy-security'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : page=='privacy-security'}">
                                <i class="fa-light fa-shield-blank"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : page=='privacy-security'}">Privacy and Security</div>
                        </div>
                        <div x-show="page=='privacy-security'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : page=='privacy-security'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>        
        <div class="w-full lg:w-2/3 h-full">
            <div x-show="page == 'profile'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            >
                @livewire('user.setting.profile')
            </div>
            <div x-show="page == 'account'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            > 
                @livewire('user.setting.account')
            </div>
            <div x-show="page == 'payment'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            >
                @livewire('user.setting.payment')
            </div>
            <div x-show="page == 'privacy-security'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            >
                @livewire('user.setting.privacy-security')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userSetting', () => ({
                page: '{{ $page }}',
                
                changePage(page)
                {
                    this.page = page
                    @this.call('changePage', page)
                },

                init()
                {
                    console.log(this.page);
                }
            }))
        })
        window.addEventListener('popstate', (event) => {
            document.getElementById('settingDiv')._x_.$data.page = 'profile';
        });
    </script>

</div>
