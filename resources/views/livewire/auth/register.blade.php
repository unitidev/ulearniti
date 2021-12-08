<div x-data="register" class="min-h-screen flex flex-col items-center justify-between">
    <div class="relative w-full h-full flex flex-col items-center justify-center">
        <div class="z-10 top-4 w-full h-32 p-4 flex items-center justify-center text-primary">
            <img class="w-full h-full" src="{{ URL::asset('svg/ulearniti-logo.svg') }}" alt="">
        </div>
    </div>
    
    <div class="flex w-full h-full flex-1 items-center justify-center md:justify-start">
        <div class="w-full flex justify-center md:w-1/2">
            <div class="w-full max-w-sm p-4 flex items-center">
                <div class="w-full">
                    <h1 class="font-mont text-3xl text-primary font-medium mb-2">Register</h1>
                    <p class="text-light mb-4">Welcome back to your account</p>
                    <div class="w-full flex items-center justify-between mb-2 text-light text-sm">
                        <div class=" w-24 h-px bg-light dark:bg-dark-1"></div>    
                        Continue or Sign Up
                        <div class=" w-24 h-px bg-light dark:bg-dark-1"></div>  
                    </div>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <x-button.auth-facebook href="/auth/facebook/redirect"/>
                        <x-button.auth-google href="/auth/google/redirect"/>
                        <x-button.auth-microsoft href="/auth/microsoft/redirect"/>
                        <x-button.auth-apple href="/auth/apple/redirect"/>
                    </div>
                    <div class="w-full flex items-center justify-between mb-2 text-light text-sm">
                        <div class="w-32 h-px bg-light dark:bg-dark-1"></div>    
                        Or
                        <div class="w-32 h-px bg-light dark:bg-dark-1"></div>  
                    </div>
                    <div>
                        
                        <x-input.label-icon label="Email Address" type="email" wire:focusout="validateEmail" icon="fa-light fa-envelope" class="mb-4" id="email" name="email" :value="old('email')" wire:model="email" required autofocus/>
                    </div>
                    <p class="text-light text-sm mb-4">By continuing you agree to our <a href="" class="text-primary font-medium">Terms</a>  and <a href="" class="text-primary font-medium">Privacy</a></p>
                    <div class="w-full flex items-center justify-between">
                        <button class="h-10 w-40 bg-primary/90 hover:bg-primary rounded-md text-white dark:text-darker font-medium" wire:click="validateUser">Continue</button>
                        <div class="text-light text-sm">Or <a href="/login" class="text-primary font-medium">Sign In</a> to your account.</div>
                    </div> 
                </div>
            </div>      
        </div>
    </div>

    <div class="w-full flex justify-center h-full pt-4">
    
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('register', () => ({
                
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
                }
            }))
        })
    </script>

</div>
