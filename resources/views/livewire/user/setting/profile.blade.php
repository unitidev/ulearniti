<div x-data="profileSetting" class="w-full h-full bg-white dark:bg-dark-2 rounded-md">
    <div class="px-4 py-3 border-b border-lightest dark:border-dark flex justify-between">
        <div class="font-mont">
            <div class="text-light text-lg font-bold">Edit Profile</div>
            <div class="text-dark text-xs">Edit your account's general information</div>
        </div>
        <div class="text-sm">
            <button wire:click="updateProfile" class="py-2 w-36 bg-primary text-white rounded-md">Save Changes</button>
        </div>
    </div>
    <div class="max-w-lg mx-auto px-4 pt-8">
        <div class="w-full h-full">
            <div class="my-2 font-mont">
                <div class="text-sm font-semibold text-light">Profile Picture</div>
                <div class="text-xs text-light">This is how others will recognize you</div>
            </div>  
            <div class="mt-4">
                <div class="flex justify-center w-full mb-4">
                    <div class="relative w-36">
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
                <div class="relative w-full max-w-xl flex items-center justify-center text-light text-sm mb-8">
                    <div class="absolute w-full h-px bg-[#999999]"></div>    
                    <div class="absolute px-8 bg-white dark:bg-dark-2">Or select an avatar</div>
                </div>
                <div class="grid grid-flow-col gap-2 md:gap-4 grid-rows-1 items-center justify-center h-14 md:h-20 transform duration-300">
                    @foreach($avatars as $avatar)
                        <button @click="changeAvatar('{{ $avatar->id }}')" class="rounded-full w-10 h-10 hover:w-12 hover:h-12 md:w-12 md:h-12 md:hover:w-16 md:hover:h-16 transform duration-300" :class="avatar_id == '{{ $avatar->id }}' && 'border-2 border-primary'">
                            <img wire:ignore src="{{$this->getAvatar($avatar->id)}}" alt="">
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="mt-10 font-mont">
                <div class="text-sm font-semibold text-light">Personal Info</div>
                <div class="text-xs text-light">Others diserve to know you more</div>
            </div>  
            <div class="mt-3 font-mont">
                <div class="w-full max-w-2xl mt-4">
                    <x-input.icon type="text" icon="fa-light fa-user" placeholder="Full Name" wire:model.lazy="fullname" />
                </div>
                <div class="w-full max-w-2xl mt-4">
                    <x-input.icon type="text" icon="fa-light fa-user-tag" placeholder="Professional Headline" wire:model.lazy="professional_headline" />
                </div> 
                <div class="w-full max-w-2xl my-4">
                    <x-input.text-area class="h-40" wire:model.lazy="bio" placeholder="About / Bio"/>                         
                </div> 
            </div>

            <div class="mt-10 flex justify-between">
                <div>
                    <div class="text-sm font-semibold text-light">Social Profiles</div>
                    <div class="text-xs text-light">This can help others finding you on social media</div>
                </div>
                
                <div class="flex h-auto items-end">
                    <div class="w-full flex justify-end relative font-mont">
                        <button @click="socialLink = ! socialLink" @click.outside="socialLink = false" class="flex justify-center font-robo text-sm items-center pr-4 border bg-white dark:bg-dark-2 border-lightest hover:text-primary dark:hover:border-primary dark:border-dark hover:border-light text-light rounded-md transition duration-300" :class="{ 'text-primary dark:border-primary' : socialLink == true }"><div class="h-8 w-8 flex items-center justify-center text-sm"><i class="fa-light fa-plus"></i></div> Add </button>
                        <div x-show="socialLink == true" class="absolute w-48 py-2 dark:bg-darkest-1 bg-white border border-lightest dark:border-dark rounded-md top-8">
                            <button wire:click="addSocial('facebook')" @click="socialLink = false" class="w-full h-10 flex justify-start items-center pl-4 text-dark hover:bg-dark-2"> <div class="text-base mr-4"><i class="fa-brands fa-facebook"></i> </div> <div class="text-xs">Facebook</div></button>
                            <button wire:click="addSocial('linkedin')" @click="socialLink = false" class="w-full h-10 flex justify-start items-center pl-4 text-dark hover:bg-dark-2"><div class="text-base mr-4"><i class="fa-brands fa-linkedin"></i> </div> <div class="text-xs">LinkedIn</div></button>
                            <button wire:click="addSocial('github')" @click="socialLink = false" class="w-full h-10 flex justify-start items-center pl-4 text-dark hover:bg-dark-2"><div class="text-base mr-4"><i class="fa-brands fa-github"></i> </div> <div class="text-xs">GitHub</div></button>
                            <button wire:click="addSocial('youtube')" @click="socialLink = false" class="w-full h-10 flex justify-start items-center pl-4 text-dark hover:bg-dark-2"><div class="text-base mr-4"><i class="fa-brands fa-youtube"></i> </div> <div class="text-xs">Youtube</div></button>
                            <button wire:click="addSocial('pinterest')" @click="socialLink = false" class="w-full h-10 flex justify-start items-center pl-4 text-dark hover:bg-dark-2"><div class="text-base mr-4"><i class="fa-brands fa-pinterest"></i> </div> <div class="text-xs">Pinterest</div></button>
                        </div>
                    </div>
                </div>
                
            </div>  
            <div class="mt-3 mb-20">                            
                @foreach($social_links as $social_link)
                    <div>
                    @livewire('user.profile.social-links',['id' => $social_link->id ], key($social_link->id))
                    </div>
                @endforeach                            
            </div>
                                
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('profileSetting', () => ({
                socialLink: false,
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
                }
            }))
        })
    </script>
</div>
        

