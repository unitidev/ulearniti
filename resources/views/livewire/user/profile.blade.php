<div class="bg-yellow-400 min-h-screen">
    <div class="w-fulll flex items-center justify-center flex-col">
        <div class="w-20 h-20 rounded-full">
            <img src="{{ $profilePicture }}" alt="">
        </div>
        <div class="bg-red-300">{{ $user->full_name }}</div>
        <input type="text" wire:modal="bio">
        <div>Bio : {{ $user->bio}}</div>
        <div>About me: {{ $user->about_me}}</div>
    </div>
</div>
