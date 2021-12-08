<div x-data="uppyCourseImage" class="pt-16 flex flex-col items-center justify-center flex-1 w-full h-full max-w-6xl px-4">
    <x-text.h class="text-3xl font-semibold text-center">Upload your course image here.</x-text.h>
    <x-text.p class="text-lg text-center max-w-xl mt-2">Must meet our course image quality standards to be accepted. Important guidelines: 16:9 aspect ratio and no text in the image.</x-text.p>
    <div class="w-full max-w-xl bg-white dark:bg-darker-1 p-6 rounded-2xl mt-8">
        <div class="aspect-w-16 aspect-h-9 rounded-md">
            @if($imgurl == "")
                <div class="w-full h-full text-9xl text-light flex items-center justify-center">
                    <i class="fa-thin fa-image-landscape"></i>
                </div>
            @else
                <img class="rounded-sm" src="{{ $imgurl }}" alt="">
            @endif
            
        </div>
        <div class="flex items-center justify-center mt-2">
            @if($imgurl == "")
                <x-button.plain @click="$refs.courseImageTriggerBtn.click()" class="bg-primary w-40">Upload</x-button.plain>
            @else
                <x-button.plain @click="removeCourseImage" class="bg-red-400 w-40">Clear</x-button.plain>
            @endif
            <button type="hidden" x-ref="courseImageTriggerBtn" class="courseImageTrigger"></button>
        </div>
    </div>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('uppyCourseImage', () => ({

            removeCourseImage()
            {
                @this.call('removeCourseImage');
            },
            
            init()
            {

                Livewire.on('resetUppy', e => {
                    uppyCourseImage.reset();
                })

                uppyCourseImage = new Uppy({
                    restrictions: {
                        maxNumberOfFiles: 1,
                        minNumberOfFiles: 1,
                        allowedFileTypes: ['image/*', '.jpg', '.jpeg', '.png'],
                    },
                })
                .use(Dashboard, {
                    trigger: '.courseImageTrigger',
                    inline: false,
                    autoOpenFileEditor: true,
                    closeAfterFinish: true,
                    thumbnailHeight: 90,
                    thumbnailHeight: 160,
                    proudlyDisplayPoweredByUppy: false,
                    theme: 'dark',
                })

                .use(ImageEditor, {
                    target: Dashboard,
                    cropperOptions: {
                        viewMode: 1,
                        background: false,
                        autoCropArea: 1,
                        responsive: true,
                        initialAspectRatio: 16/9,
                        aspectRatio: 16/9,
                    },
                    actions: {
                        revert: true,
                        rotate: false,
                        granularRotate: false,
                        flip: false,
                        zoomIn: true,
                        zoomOut: true,
                        cropSquare: true,
                        cropWidescreen: false,
                        cropWidescreenVertical: false
                    },   
                })
                .use(AwsS3Multipart, {
                    companionUrl: '/',
                    companionHeaders:
                    {
                        'X-CSRF-TOKEN': window.csrfToken,
                    },
                })

                .on('upload-success', (file, response) => {
                    console.log(file.s3Multipart.key, file, response);
                    @this.call('getImgUrl', file.s3Multipart.key);
                    @this.call('saveImage', file.s3Multipart.key);
                })
            }
        }))
    })
</script>
</div>

