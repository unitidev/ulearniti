<div x-data="privacySecuritySetting" class="w-full h-full bg-white dark:bg-dark-2 rounded-md">
    <div class="px-4 py-3 border-b border-lightest dark:border-dark flex justify-between">
        <div class="font-mont">
            <div class="text-light text-lg font-bold">Account Setting</div>
            <div class="text-dark text-xs">Edit your account's general information</div>
        </div>
        <div class="text-sm">
            <button wire:click="updateProfile" class="py-2 w-36 bg-primary text-white rounded-md">Save Changes</button>
        </div>
    </div>
    <div class="max-w-lg mx-auto px-4 pt-8 pb-8">
        
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('privacySecuritySetting', () => ({
                
        
            }))
        })
    </script>
</div>
        

