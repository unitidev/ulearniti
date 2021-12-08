<div class="pt-16 flex flex-col items-center justify-center flex-1 w-full max-w-6xl px-4"> 
    <x-text.h class="text-3xl font-semibold text-center">Make your course more specific</x-text.h>
    <x-text.p class="text-lg text-center">Specify course language, level and categories.</x-text.p>
    <div class="w-full flex flex-col items-center justify-center max-w-2xl">
  
        <label class="mt-4 w-full pl-3 text-light">Language</label>
        <x-input.select id="courseLanguage" name="courseLanguage" wire:model="courseLanguage">
            <option value="default">Select Language</option>
            @foreach($languages as $language)
            <option value="{{ $language->id }}">{{ $language->language }}</option>
            @endforeach
        </x-input.select>

        <label class="mt-4 w-full pl-3 text-light">Level</label>
        <x-input.select id="courseLevel" name="courseLevel" wire:model="courseLevel">
            <option value="default">-- Select level --</option>
            @foreach($levels as $level)
            <option value="{{ $level->id }}">{{ $level->level }}</option>
            @endforeach
        </x-input.select>
        
        <label class="mt-4 w-full pl-3 text-light">Category</label>
        <x-input.select id="courseCategory" name="courseCategory" wire:model="courseCategory"  wire:poll="setSub">
            <option value="default">-- Select category --</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
        </x-input.select>
        
        @if($subCategoryStatus == "active")
            <label class="mt-4 w-full pl-3 text-light">Sub Category</label>
            <x-input.select id="category" name="category" wire:model="selectedCategory">            
                <option value="default" name="default">-- Select Subcategory --</option>
                @foreach($subCategory as $data)
                <option value="{{ $data->id }}" name="{{ $data->subcategory }}">{{ $data->subcategory }}</option>
                @endforeach
            </x-input.select>
        @endif

        
    </div>


    
</div>