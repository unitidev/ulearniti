<div>
    @foreach($answers as $answer)
        <div class="flex">
            <div class="mr-2">
                @if( $answer->correct_answer == "true")
                    <i class="fa-solid fa-circle"></i>
                @else
                    <i class="fa-light fa-circle "></i>
                @endif
            </div>
            <div class="w-full">
                {{ $answer->title}}
            </div>
            
        </div>
    @endforeach
</div>
