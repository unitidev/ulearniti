<div {{ $attributes->only('class')->merge(['class' => 'group relative rounded-xl']) }}>
    <img class="absolute top-0 rounded-xl object-cover w-full h-full" src="{{ $courseImage }}" alt="">
    <div class="group-hover:opacity-20 opacity-80 transform duration-300 absolute top-0 z-20 w-full h-full bg-gradient-to-t from-black rounded-xl"></div>
    <div class="group-hover:opacity-0 opacity-50 transform duration-300 flex absolute top-0 z-10 w-full h-full bg-gradient-to-t from-primary rounded-xl"></div>

    <div class="absolute w-full h-full top-0 flex flex-col justify-between p-6">
        <div class="flex justify-between z-30">
            <button @click="modals = ! modals" class="w-14 h-14 rounded-xl bg-lightest flex hover:w-16 hover:h-16 text-base hover:text-2xl transform duration-300 items-center justify-center text-darker">
                <i class="fa-solid fa-play"></i>
            </button>
        </div>
        <div class="z-30">
            <p class="text-3xl font-mont text-white font-bold text-">{{ $title }}</p>
            <div class="flex mt-2 items-center">
                <img class="w-8 h-8 rounded-full bg-white" src="{{ $profilePhoto }}" alt="">
                <p class="text-white pl-2">{{ $name }}</p>
            </div>
        </div>
    </div>
</div>