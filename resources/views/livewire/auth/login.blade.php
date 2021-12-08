<div x-data="login" class="flex w-full justify-end">
    <div class="w-2/3 hidden lg:flex min-h-screen"></div>
    <div class="w-full lg:w-1/3 min-h-screen bg-white dark:bg-darkest-2 flex justify-center">
        <div class="w-full max-w-sm p-4 flex items-center">
            <div class="w-full">
                <div class="w-full h-32 p-4 flex justify-center mb-4 text-primary">
                    <img src="{{ URL::asset('svg/ulearniti-logo.svg') }}" alt="">
                </div>
                <h1 class="font-mont text-3xl text-primary font-medium mb-2">Log In</h1>
                <p class="text-light mb-4">Welcome back to your account</p>
                <div class="w-full flex items-center justify-between mb-2 text-light text-sm">
                    <div class=" w-24 h-px bg-light dark:bg-dark-1"></div>    
                    Continue or Log In
                    <div class=" w-24 h-px bg-light dark:bg-dark-1"></div>  
                </div>
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <x-button.auth-facebook href="/"/>
                    <x-button.auth-google href="/auth/google/redirect"/>
                    <x-button.auth-microsoft href="/register"/>
                    <x-button.auth-apple href="/"/>
                </div>
                <div class="w-full flex items-center justify-between mb-2 text-light text-sm">
                    <div class="w-32 h-px bg-light dark:bg-dark-1"></div>    
                    Or
                    <div class="w-32 h-px bg-light dark:bg-dark-1"></div>  
                </div>
                <x-input.icon wire:model.lazy="email" wire:focusout="validateEmail" type="email" placeholder="Email Address" icon="fa-light fa-envelope" class="mb-4 " id="email" name="email" :value="old('email')" required autofocus/>
                <x-input.icon wire:model.lazy="password" type="password" placeholder="Password" icon="fa-light fa-lock-keyhole" class="mb-4" id="password" name="password" required autocomplete="current-password"/>
                <div class="w-full flex justify-between mb-4">
                    <div class="flex h-6 items-center">
                        <x-jet-checkbox id="remember_me" name="remember" class="mr-2"/>
                        <div class="text-light text-sm">Remember Me</div>
                    </div>
                    <div class="mb-2 h-6 text-light text-sm flex items-center">Forgot password?</div>
                </div>
                <div class="w-full flex items-center justify-between">
                    <button class="h-10 w-40 bg-primary/90 hover:bg-primary rounded-md text-white dark:text-darker font-medium" wire:click="validateUser">Login</button>
                    <div class="text-light text-sm">Or <a href="/register" class="text-primary font-medium">Create</a> an account.</div>
                </div> 
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('login', () => ({
                
                init()
                {
                    Livewire.on('emailValidation', result => {
                        if(result == 'valid') {
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-green-500');
                        }
                        else {
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-red-500');
                        }
                    })

                    Livewire.on('passwordValidation', result => {
                        if(result == 'valid') {
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-green-500');
                            document.getElementById('password').classList.remove('border-lighter');
                            document.getElementById('password').classList.add('border-green-500');
                        }
                        else if(result == 'invalid'){
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-green-500');
                            document.getElementById('password').classList.remove('border-lighter');
                            document.getElementById('password').classList.add('border-red-500');
                        }
                        else
                        {
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-red-500');
                            document.getElementById('password').classList.remove('border-lighter');
                            document.getElementById('password').classList.add('border-red-500');
                        }
                    })
                }
            }))
        })
    </script>
    
</div>