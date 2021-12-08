<div x-data="course_price" class="w-full h-full flex-col justify-center">
    <x-text.h class="text-3xl font-semibold text-center">Course Price</x-text.h>
    <x-text.p class="text-lg text-center">Name your price, we'll calculate it for you</x-text.p>

    <div class="flex flex-col items-center w-full mt-6">
        <div class="flex items-center justify-center w-48 text-2xl">
            
            <x-input.label label="RM" type="text" id="price" wire:model.lazy="price" wire:focusout="checkPrice" class="w-full" placeholder="MYR" type="tel" onkeypress="return onlyNumberKey(event)"/>
        </div>
    </div>
    <script>
        
        document.addEventListener('alpine:init', () => {
            Alpine.data('course_price', () => ({
                share: false,

                init()
                {
                    Livewire.on('priceFloor', price => {
                        if(price < 35){
                            document.getElementById('price').classList.remove('border-lighter');
                            document.getElementById('price').classList.add('border-red-500');
                        }
                        else{
                            @this.call('updatePrice');
                            document.getElementById('price').classList.remove('border-red-500');
                            document.getElementById('price').classList.remove('border-lighter');
                            document.getElementById('price').classList.add('border-green-500');
                        }
                    })
                    
                }
            }))
        })

        function onlyNumberKey(evt) {
            
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
</div>