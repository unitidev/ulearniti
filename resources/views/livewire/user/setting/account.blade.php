<div x-data="accountSetting" class="w-full h-full bg-white dark:bg-dark-2 rounded-md">
    <div class="px-4 py-3 border-b border-lightest dark:border-dark flex justify-start">
        <div class="font-mont">
            <div class="text-light text-lg font-bold">Account Setting</div>
            <div class="text-dark text-xs">Edit your account's general information</div>
        </div>
    </div>
    <div class="max-w-lg mx-auto px-4 pt-8 pb-8">
        <div class="w-full h-full">
            <div class="my-2 font-mont">
                <div class="text-sm font-semibold text-light">Change Email</div>
                <div class="text-xs text-light">You need to re-verify email after change</div>
            </div>  
        </div>
        <div class="mt-3 font-mont">
            <div class="w-full max-w-2xl mt-4">
                <div class="text-xs font-semibold text-light">Current email : {{ $email }}</div>
                <x-input.icon id="email" type="text" icon="fa-light fa-envelope" placeholder="New Email Address" wire:model.lazy="input_email" wire:focusout="checkEmail"/>
            </div>
        </div>
    </div>

    <div class="max-w-lg mx-auto px-4 pt-8 pb-8">
        <div class="w-full h-full">
            <div class="my-2 font-mont">
                <div class="text-sm font-semibold text-light">Change Username</div>
                <div class="text-xs text-light">Your username should be unique</div>
            </div>  
        </div>
        <div class="mt-3 font-mont">
            <div class="w-full max-w-2xl mt-4">
            
                <div class="text-xs font-semibold text-light">Current username : {{ $username }}</div>
                <x-input.icon id="username" type="text" icon="fa-light fa-user" placeholder="New Username" wire:model.lazy="input_username" wire:focusout="checkUsername"/>
            </div>
        </div>
    </div>

    <div class="max-w-lg mx-auto px-4 pt-8 pb-20">
        <div class="w-full h-full">
            <div class="my-2 font-mont">
                <div class="text-sm font-semibold text-light">Change Password</div>
                <div class="text-xs text-light">For an improved account security</div>
            </div>  
        </div>
        <div class="mt-3 font-mont">
            <div class="w-full max-w-2xl mt-4">
                <x-input.icon id="current_password" type="password" icon="fa-light fa-lock-open" placeholder="Current Password" wire:model="input_password" wire:focusout="checkCurrentPassword"/>
            </div>
            <div class="w-full max-w-2xl mt-4">
                <x-input.icon id="new_password" wire:model="new_password" type="password" icon="fa-light fa-lock" placeholder="New Password"/>
            </div> 
            <div class="w-full max-w-2xl mt-4">
                <x-input.icon id="confirm_password" wire:model="confirm_password" type="password" icon="fa-light fa-lock" placeholder="Confirm New Password"/>
            </div> 
        </div>
        <div class="w-full flex items-center justify-end mt-2">
            <button id="disable_button" disabled class="font-robo text-sm px-4 py-2 border bg-white dark:bg-dark-2 border-lightest dark:border-dark text-light rounded-md transition duration-300 cursor-not-allowed">Update Password</button>
            <button id="enable_button" class="hidden font-robo text-sm px-4 py-2 border bg-white dark:bg-dark-2 border-lightest hover:text-primary dark:hover:border-primary dark:border-dark hover:border-light text-light rounded-md transition duration-300" wire:model="updatePassword">Update Password</button>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('accountSetting', () => ({
                
                init()
                {
                    Livewire.on('emailValidation', result => {
                        if(result == 'valid') {
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-green-500');
                        }
                        else {
                            document.getElementById('email').classList.remove('border-lighter');
                            document.getElementById('email').classList.add('border-yellow-500');
                        }
                    })

                    Livewire.on('usernameValidation', result => {
                        if(result == 'valid') {
                            document.getElementById('username').classList.remove('border-lighter');
                            document.getElementById('username').classList.add('border-green-500');
                        }
                        else {
                            document.getElementById('username').classList.remove('border-lighter');
                            document.getElementById('username').classList.add('border-yellow-500');
                        }
                    })

                    Livewire.on('passwordValidation', result => {
                        if(result == 'valid') {
                            document.getElementById('current_password').classList.remove('border-lighter');
                            document.getElementById('current_password').classList.add('border-green-500');
                        }
                        else {
                            document.getElementById('current_password').classList.remove('border-lighter');
                            document.getElementById('current_password').classList.add('border-yellow-500');
                        }
                    })
                }
        
            }))
        })

        
    </script>
    <script>
        var newpw = document.getElementById('new_password')
        var confirmpw = document.getElementById('confirm_password')

        confirmpw.addEventListener('input', validatePassword)

        function validatePassword() {
            if(newpw.value == confirmpw.value)
            {
                document.getElementById('confirm_password').classList.remove('border-lighter');
                document.getElementById('confirm_password').classList.remove('border-yellow-500');
                document.getElementById('confirm_password').classList.add('border-green-500');
                document.getElementById('new_password').classList.remove('border-lighter');
                document.getElementById('new_password').classList.remove('border-yellow-500');
                document.getElementById('new_password').classList.add('border-green-500');
                document.getElementById('disable_button').classList.add('hidden');
                document.getElementById('enable_button').classList.remove('hidden');
            }
            else
            {
                document.getElementById('confirm_password').classList.remove('border-lighter');
                document.getElementById('confirm_password').classList.add('border-yellow-500');
                document.getElementById('new_password').classList.remove('border-lighter');
                document.getElementById('new_password').classList.add('border-yellow-500');
                document.getElementById('disable_button').classList.remove('hidden');
                document.getElementById('enable_button').classList.add('hidden');
            }
        }
    </script>
</div>
        

