<div x-data="paymentSetting" class="w-full h-full bg-white dark:bg-dark-2 rounded-md">
    <div class="px-4 py-3 border-b border-lightest dark:border-dark flex justify-between">
        <div class="font-mont">
            <div class="text-light text-lg font-bold">Account Setting</div>
            <div class="text-dark text-xs">Edit your account's general information</div>
        </div>
    </div>
    <div class="max-w-lg mx-auto pt-8 pb-8 flex px-8">
        <div class="w-full h-full flex-col items-center">
            <div class="my-5 font-mont">
                <div class="text-sm font-semibold text-light">Cards Informations</div>
                <div class="text-xs text-light">You may save your payment method to make transaction going smooth</div>
            </div> 
            <div class="w-full flex items-center justify-center">
                <div class="w-full flex items-center justify-end max-w-xs md:max-w-md mb-4">
                    <button x-show="!add_card" @click="add_card = ! add_card" class="flex justify-center font-robo text-sm items-center pr-4 border bg-white dark:bg-dark-2 border-lightest hover:text-primary dark:hover:border-primary dark:border-dark hover:border-light text-light rounded-md transition duration-300" :class="{'text-primary border-primary' : add_card }">
                        <div class="h-8 w-8 flex items-center justify-center text-sm" :class="{'text-primary' : add_card }">
                            <i class="fa-light fa-plus"></i>
                        </div>
                        <div :class="{'text-primary' : add_card }">
                            Add Card
                        </div>
                    </button>
                    <button x-show="add_card" @click="add_card = ! add_card" class="flex justify-center font-robo text-sm items-center px-4 border bg-white dark:bg-dark-2 border-lightest hover:text-primary dark:hover:border-primary dark:border-dark hover:border-light text-light rounded-md transition duration-300" :class="{'text-primary border-primary' : add_card }">
                        <div class="h-8 flex items-center justify-center text-sm" :class="{'text-primary' : add_card }">
                            Cancel
                        </div>
                </div> 
            </div>

            <div class="w-full relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="addCardContainer" :style="add_card == true ? 'max-height: ' + $refs.addCardContainer.scrollHeight + 'px' : ''">
                <div class="w-full">
                    @livewire('user.setting.payment.add-card-form')
                </div>
            </div>

            <div class="w-full relative overflow-hidden transition-all max-h-0 duration-300" style="" x-ref="listCardContainer" :style="add_card == false ? 'max-height: ' + $refs.listCardContainer.scrollHeight + 'px' : ''">
                <div class="w-full flex justify-center">
                        @livewire('user.setting.payment.bank-card')
                </div>
                <div class="w-full flex justify-center">
                        @livewire('user.setting.payment.bank-card')
                </div>
                <div class="w-full flex justify-center">
                        @livewire('user.setting.payment.bank-card')
                </div>
            </div>
        </div>    
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('paymentSetting', () => ({
                add_card: false,
                
            }))
        })
    </script>
</div>
        

