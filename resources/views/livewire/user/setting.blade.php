<div class="mx-auto">
    <div class="w-full lg:flex justify-between items-start">
        <div class="w-full lg:w-1/3 pr-0 lg:pr-5 mb-6 lg:mb-0">
            <div class="w-full h-full bg-white dark:bg-dark-2 rounded-md flex flex-col">
                <div class="w-full flex p-6">
                    <div class=""><img class="w-12 h-12 md:w-16 md:h-16 rounded-full" src="{{ $this->getProfilePhoto($user->profile_photo) }}" alt=""></div>
                    <div class="flex-1 pl-2 md:pl-4 h-12 md:h-16 text-light justify-between flex flex-col py-2">
                        <div class="font-mont text-sm md:text-lg font-semibold line-clamp-1">{{ $user->full_name }}</div>
                        <div class="text-xxs md:text-xs text-dark line-clamp-1">{{ $user->professional_headline }}</div>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="$store.userSetting.changePage('profile')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : $store.userSetting.page=='profile'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : $store.userSetting.page=='profile'}">
                                <i class="fa-light fa-user"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : $store.userSetting.page=='profile'}">Profile</div>
                        </div>
                        <div wire:ignore x-show="$store.userSetting.page=='profile'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : $store.userSetting.page=='profile'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="$store.userSetting.changePage('account')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : $store.userSetting.page=='account'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : $store.userSetting.page=='account'}">
                                <i class="fa-light fa-user-lock"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : $store.userSetting.page=='account'}">Account</div>
                        </div>
                        <div wire:ignore x-show="$store.userSetting.page=='account'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : $store.userSetting.page=='account'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="$store.userSetting.changePage('payment')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : $store.userSetting.page=='payment'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : $store.userSetting.page=='payment'}">
                                <i class="fa-light fa-credit-card"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : $store.userSetting.page=='payment'}">Payment</div>
                        </div>
                        <div wire:ignore x-show="$store.userSetting.page=='payment'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : $store.userSetting.page=='payment'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                    <button class="w-full h-12 hover:bg-lightest dark:hover:bg-dark-1 mb-2 rounded-lg transition duration-200 flex items-center justify-between border border-transparent" @click="$store.userSetting.changePage('privacy-security')" :class="{'bg-lightest dark:bg-dark-1 border-lightest dark:border-dark shadow-sm' : $store.userSetting.page=='privacy-security'}">
                        <div class="flex text-dark">
                            <div class="w-12 h-full" :class="{'text-primary' : $store.userSetting.page=='privacy-security'}">
                                <i class="fa-light fa-shield-blank"></i>
                            </div>
                            <div class="text-sm font-mont font-medium" :class="{'text-primary' : $store.userSetting.page=='privacy-security'}">Privacy and Security</div>
                        </div>
                        <div wire:ignore x-show="$store.userSetting.page=='privacy-security'" class="w-12 h-12 flex items-center justify-center" :class="{'text-primary' : $store.userSetting.page=='privacy-security'}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>       
        <div class="w-full lg:w-2/3 h-full">
            <div wire:ignore x-show="$store.userSetting.page == 'profile'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            >
                @livewire('user.setting.profile')
            </div>
            <div wire:ignore x-show="$store.userSetting.page == 'account'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            > 
                @livewire('user.setting.account')
            </div>
            <div wire:ignore x-show="$store.userSetting.page == 'payment'"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 translate-x-20"
            >
                @livewire('user.setting.payment')
            </div>
            <div wire:ignore x-show="$store.userSetting.page == 'privacy-security'"
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
            Alpine.store('userSetting', {
                page: '{{ $page }}',
                prevPage: '',
    
                changePage(page)
                {
                    this.prevPage = this.page
                    this.page = page
                    @this.call('changePage', page)
                },

                init()
                {
                    
                }
            })
        })

        window.addEventListener('popstate', (event) => {
            location.reload();
        });
    </script>
</div>
