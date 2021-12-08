<x-ui.card class="mt-2">
    <div class="w-full md:flex md:justify-between">
        <div class="w-full h-full md:flex">
            <div class="h-32 w-80 bg-pink-400 rounded-md mr-4">gambar</div>
            <div class="w-full h-full flex flex-col justify-between"> 
                <x-text.h class="text-md font-semibold mr-5">{{ $title }}</x-text.h>
                <x-text.p class="text-sm text-dark">{{ $subtitle }}</x-text.p>
                
                <div class="flex w-96 text-primary text-sm items-center">
                    @if( $section > 1 )
                        <div class="mr-2">{{ $section }} Sections</div>
                        <i class="fa-solid fa-circle-small text-dark text-xs"></i>
                    @endif
                    @if($video > 0 && $video == 1)
                        <div class="mx-2">{{ $video }} Video</div>
                        <i class="fa-solid fa-circle-small text-dark text-xs"></i>
                    @elseif($video > 0)
                        <div class="mx-2">{{ $video }} Videos</div>
                        <i class="fa-solid fa-circle-small text-dark text-xs"></i>
                    @endif
                    <?php $hour = (int) ($duration/60); 
                        $minute = $duration%60;
                    ?>
                    <div class="mx-2">@if($hour > 0){{ $hour }} hr @endif{{ $minute }} min</div>
                    <i class="fa-solid fa-circle-small text-dark text-xs"></i>

                    @if($quiz > 0 && $quiz == 1)
                        <div class="ml-2">{{ $quiz }} Quiz</div>
                    @elseif($video > 0)
                        <div class="ml-2">{{ $quiz }} Quizes</div>
                    @endif
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="text-red-500 font-bold">RM{{ $price }}</div>
                    <div class="flex text-xs">
                        <?php $j=0 ?>
                        @for($i = 0; $i < 5; $i++)
                            @for($j; $j < $star; $j++)
                                <i class="fa-solid fa-star text-yellow-500"></i>
                                <?php $i++ ?>
                            @endfor
                            @if($i == 5)
                                @break
                            @endif
                            <i class="fa-solid fa-star text-lighter dark:text-[#1E1E21]"></i>
                        @endfor
                    </div>
                </div>
                <div class="flex justify-between w-96 max-w-2xl text-sm text-dark">
                    <div>{{ $microcredential }}</div>
                    <div>{{ $certificate }}</div>
                    <div>{{ $examination }}</div>
                    <div>{{ $project }}</div>
                </div>
            </div>
            
        </div>
        <div class="w-60 h-full flex items-center justify-center">
            <x-button.plain class="bg-primary">Settings</x-button.plain>
        </div>
    </div>
</x-ui.card>