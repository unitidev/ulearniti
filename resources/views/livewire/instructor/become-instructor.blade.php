<div class="py-12">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex items-center justify-center">
            <x-button.plain @click="modals = true;" class="bg-primary">Create first course</x-button.plain>
        </div>
    </div>
    <x-ui.modal maxWidth="max-w-7xl">
        @livewire('modals.course-create-type')
    </x-ui.modal>
</div>