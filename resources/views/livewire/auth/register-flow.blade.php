<div x-data="register_flow" class="min-h-screen flex flex-col items-center">
    <div class="relative w-full h-full flex flex-col items-center">
        <div class="w-full h-40 flex items-center justify-center max-w-sm flex-col">
            <div class="w-full h-20 flex p-2 justify-center text-primary">
                <img src="{{ URL::asset('svg/ulearniti-logo.svg') }}" alt="">
            </div>
            <div class="relative w-full h-full max-w-sm px-4">
                <div class="absolute top-0 left-0 flex w-full h-full  items-center justify-center px-6">
                    <div class="w-full h-2">
                        <div wire:ignore class="h-full bg-primary transform duration-300" :class="{'w-0': page == 'avatar', 'w-1/2': page == 'account', 'w-full': page == 'done'}"></div>
                    </div>
                </div>
                <div class="absolute left-0 top-0 w-full flex items-center justify-between mt-4 px-4">
                    <div>
                        <button x-show="page == 'avatar' || page == 'done'" class="w-12 h-12 bg-light dark:bg-[#4a4a50] p-1 rounded-full">
                            <div class="w-full h-full bg-white dark:bg-primary rounded-full border-2 border-primary dark:border-[#3b3b41] flex items-center justify-center text-primary dark:text-white">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </button>
                        <button x-show="page == 'account'" @click="changePage('avatar');" class="w-12 h-12 bg-light dark:bg-[#4a4a50] p-1 rounded-full">
                            <div class="w-full h-full bg-white dark:bg-primary rounded-full border-2 border-primary dark:border-[#3b3b41] flex items-center justify-center text-primary dark:text-white">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </button>
                        <p class="font-robo text-darker dark:text-lighter text-xs text-center">Avatar</p>
                    </div>

                    <div>
                        <button x-show="page == 'avatar'" class="w-12 h-12 bg-light dark:bg-[#4a4a50] p-1 rounded-full">
                            <div class="w-full h-full bg-[#cccccc] dark:bg-[#3b3b41] rounded-full border-2 border-[#cccccc] dark:border-[#3b3b41] flex items-center justify-center text-light">
                                <i class="fa-regular fa-shield-blank"></i>
                            </div>
                        </button>
                        <button x-show="page != 'avatar'" class="w-12 h-12 bg-light dark:bg-[#4a4a50] p-1 rounded-full">
                            <div class="w-full h-full bg-white dark:bg-primary rounded-full border-2 border-primary dark:border-[#3b3b41] flex items-center justify-center text-primary dark:text-white">
                                <i class="fa-regular fa-shield-blank"></i>
                            </div>
                        </button>
                        <p class="font-robo text-darker dark:text-lighter text-xs text-center">Account</p>
                    </div>
                    
                    <div>
                        <button x-show="page != 'done'" class="w-12 h-12 bg-light dark:bg-[#4a4a50] p-1 rounded-full">
                            <div class="w-full h-full bg-[#cccccc] dark:bg-[#3b3b41] rounded-full border-2 border-[#cccccc] dark:border-[#3b3b41] flex items-center justify-center text-light">
                                <i class="fa-regular fa-check"></i>
                            </div>
                        </button>
                        <button x-show="page == 'done'" class="w-12 h-12 bg-light dark:bg-[#4a4a50] p-1 rounded-full">
                            <div class="w-full h-full bg-white dark:bg-primary rounded-full border-2 border-primary dark:border-[#3b3b41] flex items-center justify-center text-primary dark:text-white">
                                <i class="fa-regular fa-check"></i>
                            </div>
                        </button>
                        <p class="font-robo text-darker dark:text-lighter text-xs text-center">Done</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   <div class="flex w-full h-full flex-1 items-center justify-center">
        <div x-data="avatar" x-show="page == 'avatar'" class="w-full max-w-2xl flex flex-1 flex-col items-center justify-center px-4"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            <x-text.h class="text-xl font-semibold text-center">Add a profile picture</x-text.h>
            <x-text.p class="text-base text-center">This is your visual identity</x-text.p>
            <div class="mt-4">
                <div class="relative">
                    <div class="w-36 h-36 rounded-full border-4 border-lightest dark:border-dark">
                    @if($profile_photo)
                        <img class="object-contain rounded-full h-full w-full" src="{{ $profile_photo }}" alt="">
                    @else
                        <img class="object-contain rounded-full h-full w-full" src="{{ $avatar_photo }}" alt="">
                    @endif
                    </div>
                    
                    <button x-show="profile_photo == ''" class="butangUppy absolute bottom-3 right-0 w-9 h-9 bg-white dark:bg-darker-1 rounded-full border-2 boder-lightest dark:border-dark flex items-center justify-center">
                        <i class=" fa-light fa-plus text-darker dark:text-light"></i>
                    </button>

                    <button x-show="profile_photo != ''" @click="clearProfilePhoto" class="absolute bottom-3 right-0 w-9 h-9 bg-white dark:bg-darker-1 rounded-full border-2 boder-lightest dark:border-dark flex items-center justify-center">
                        <i class="fa-light fa-xmark text-darker dark:text-light"></i>
                    </button>
                </div>
            </div>
            <div class="relative w-full max-w-xl flex items-center justify-center mb-2 text-light text-sm mt-8">
                <div class="absolute w-full h-px bg-[#999999]"></div>    
                <div class="absolute bg-light dark:bg-dark-1 px-8">Or select an avatar</div>
            </div>

            <div class="grid grid-flow-col gap-2 md:gap-4 grid-rows-1 items-center h-14 md:h-20 transform duration-300">
                @foreach($avatars as $avatar)
                    <button @click="changeAvatar('{{ $avatar->id }}')" class="rounded-full w-10 h-10 hover:w-12 hover:h-12 md:w-14 md:h-14 md:hover:w-20 md:hover:h-20 transform duration-300" :class="avatar_id == '{{ $avatar->id }}' && 'border-2 border-primary'">
                        <img wire:ignore src="{{ $avatar->url }}" alt="">
                    </button>
                @endforeach
            </div>

                <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('avatar', () => ({
                        profile_photo: '{{ $profile_photo }}',
                        avatar_id: 4,

                        clearProfilePhoto() {
                            uppyProfilePhoto.reset();
                            this.profile_photo = '';
                            @this.call('destroyProfilePhoto')
                        },

                        changeAvatar(avatar_id) {
                            this.clearProfilePhoto()
                            this.avatar_id = avatar_id;
                            @this.call('changeAvatar', avatar_id)
                        },

                        init() {
                            uppyProfilePhoto = new Uppy({
                                restrictions: {
                                    maxNumberOfFiles: 1,
                                    minNumberOfFiles: 1,
                                    allowedFileTypes: ['image/*', '.jpg', '.jpeg', '.png'],
                                },
                            })
                            
                            .use(Dashboard, {
                                trigger: '.butangUppy',
                                inline: false,
                                autoOpenFileEditor: true,
                                closeAfterFinish: true,
                                theme: 'dark',
                            })

                            .use(ImageEditor, {
                                target: Dashboard, 
                                cropperOptions: {
                                    viewMode: 1,
                                    background: false,
                                    autoCropArea: 1,
                                    responsive: true,
                                    initialAspectRatio: 1/1,
                                    aspectRatio: 1/1,

                                },
                                actions: {
                                    revert: true,
                                    rotate: false,
                                    granularRotate: false,
                                    flip: false,
                                    zoomIn: true,
                                    zoomOut: true,
                                    cropSquare: true,
                                    cropWidescreen: false,
                                    cropWidescreenVertical: false
                                }                   
                            })

                            .use(AwsS3Multipart, {
                                companionUrl: '/',
                                companionHeaders:
                                {
                                    'X-CSRF-TOKEN': window.csrfToken,
                                },
                            })
                            
                            .on('upload-success', (file, response) => {
                                @this.call('updateProfilePhoto', file.s3Multipart.key)
                                this.profile_photo = file.s3Multipart.key
                            })

                            this.changeAvatar(this.avatar_id);
                        }
                    }))
                })
            </script>

        </div>

        <div x-show="page == 'account'" class="flex flex-1 flex-col items-center justify-center w-full"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            <div class="w-full max-w-sm">
                <x-text.h class="text-xl font-semibold text-center">Pick a username</x-text.h>
                <x-text.p class="text-base text-center">Your username is how others will find you on Ulearniti so pick a good one. You can change it later.</x-text.p>
            </div>
            <div class="grid grid-cols-1 gap-4 w-full max-w-sm mt-8">
                <x-input.label class="w-full" type="text" label="Full Name" wire:model="full_name" id="full_name"/>
                <x-input.label type="text" label="Username" id="username" wire:model="username" wire:focusout="validateUsername" id="username"/>
                <x-input.label type="password" label="Password" wire:model="password" id="password"/>
                <x-input.label type="password" label="Confirm password" id="confirm_password"/>
            </div>        
            
            <div class="mt-4">
                
            </div>
        </div>

        <div x-show="page == 'done'" class="flex flex-1 flex-col items-center justify-center w-full"
            x-transition:enter="ease-out duration-300 hidden"
            x-transition:enter-start.delay-300ms="opacity-0 flex"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 -translate-x-20"
        >
            <div class="w-full max-w-sm mt-4">
            @if($register_method == "email")
                <x-text.h class="text-xl font-semibold text-center">Ready to discover?</x-text.h>
                <x-text.p class="text-base text-center">Verify your email address now!</x-text.p>
            @else
                <x-text.h class="text-xl font-semibold text-center">You are good to go</x-text.h>
                <x-text.p class="text-base text-center">Thank you for being part of Ulearniti</x-text.p>
            @endif
            </div>
        </div>

    </div>

    <div class="w-full flex flex-1 justify-center h-full pt-4">
        <x-button.plain x-show="page == 'avatar'" @click="changePage('account');" class="bg-primary w-40">Continue</x-button.plain>
        <x-button.plain x-show="page == 'account'" @click="registerUser;" class="bg-primary w-40" id="register_now">Done</x-button.plain>
        @if($register_method == "email")
            <form action="{{ route('verification.send') }}" method="POST" x-show="page == 'done'">
                    @csrf
                <x-button.plain type="submit" class="bg-primary px-8">Send Verification Code</x-button.plain>
            </form>
        @else
            <x-button.href-plain href="/dashboard" x-show="page == 'done'" class="bg-primary px-8">Login</x-button.href-plain>
        @endif
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('register_flow', () => ({
                page: '{{ $page }}',
    
                changePage(page) {
                    this.page = page
                },

                registerUser() {
                    full_name = this.validateFullName()
                    username = this.validateUsername()
                    password = this.validatePassword()

                    if( full_name && username && password) {
                        @this.call('registerUser')
                        this.page = 'done'
                    }
                },

                validateFullName() {
                    
                    if(document.getElementById('full_name').value == '') {
                        document.getElementById('full_name').classList.add('border-red-500', 'dark:border-red-500')
                        console.log('Full name empty')
                        return false;
                    }
                    else {
                        return true;
                    }
                },

                validateUsername() {
                    
                    if(document.getElementById('username').value == '') {
                        document.getElementById('username').classList.add('border-red-500', 'dark:border-red-500')
                        console.log('User name empty')
                        return false;
                    }
                    else {
                        return true;
                    }
                },

                validatePassword() {
                    if(document.getElementById('password').value == '' && document.getElementById('confirm_password').value == '') {
                        document.getElementById('password').classList.add('border-red-500', 'dark:border-red-500')
                        document.getElementById('confirm_password').classList.add('border-red-500', 'dark:border-red-500')
                        return false;

                    }
                    else if(document.getElementById('password').value == ''){
                        document.getElementById('password').classList.add('border-red-500', 'dark:border-red-500')
                        return false;
                    }
                    else if(document.getElementById('confirm_password').value == '')
                    {
                        document.getElementById('confirm_password').classList.add('border-red-500', 'dark:border-red-500')
                        return false
                    }
                    else {
                        if(document.getElementById('password').value === document.getElementById('confirm_password').value) {
                        document.getElementById('password').classList.add('border-green-500', 'dark:border-green-500')
                        document.getElementById('confirm_password').classList.add('border-green-500', 'dark:border-green-500')
                        return true
                        }
                        else {
                            document.getElementById('password').classList.add('border-red-500', 'dark:border-red-500')
                            document.getElementById('confirm_password').classList.add('border-red-500', 'dark:border-red-500')
                            return false
                        }
                    }
                },

                init() {
                    Livewire.on('validatedUsername', username_status => {
                        if(username_status == 'contain_space') {
                            document.getElementById('username').classList.add('border-red-500', 'dark:border-red-500')
                            console.log('contain Spaces')
                            return false
                        }
                        else if(username_status == 'available') {
                            document.getElementById('username').classList.add('border-green-500', 'dark:border-green-500')
                            console.log('this username is available')
                            return true
                        }
                        else if(username_status == 'unavailable') {
                            document.getElementById('username').classList.add('border-red-500', 'dark:border-red-500') 
                            console.log('Username is already taken')
                            return false
                        }
                    })
                }
            }))
        })
    </script>

</div>
