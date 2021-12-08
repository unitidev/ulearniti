<div x-data="uppyPromotionalVideo" class="pt-16 flex flex-col items-center justify-center flex-1 w-full h-full max-w-6xl px-4">
    <x-text.h class="text-3xl font-semibold text-center">Upload your promotional video here.</x-text.h>
    <x-text.p class="text-lg text-center max-w-xl mt-2">Students who watch a well-made promo video are 5X more likely to enroll in your course.</x-text.p>
    <div class="w-full max-w-xl bg-white dark:bg-darker-1 md:p-6 rounded-2xl mt-8">
        <div class="aspect-w-16 aspect-h-9 bg-light dark:bg-darker-1 rounded-md">
            <div class="w-full h-full flex items-center justify-center text-4xl text-primary dark:text-primary">

                <button wire:ignore id="promotionalVideoUppyTrigger" class="promotionalVideoUppyTrigger absolute top-0 w-full h-full flex items-center justify-center"><i class="fa-light fa-arrow-up-from-square"></i></button>
                <button type="hidden" @click="openPromotionalVideoUppy"></button>

                <div id="promotionalVideoProcessLoading" wire:ignore class="hidden absolute top-0 w-full h-full">
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <div class="w-full flex items-center justify-center text-xl"><i class="animate-spin fa-duotone fa-spinner-third"></i></div>
                        <div class="flex mt-2">
                            <div class="text-darker dark:text-light text-sm">
                                Processing...
                            </div> 
                            <div id="promotionalVideoPercentage"class="text-darker dark:text-light text-sm">
                                0%
                            </div>
                        </div>
                    </div>
                </div>

                <div wire:ignore id="promotionalVideoPlyr" class="hidden absolute top-0 bg-red w-full h-full">
                    <div class="relative w-full h-full">
                        <div class="absolute top-4 right-4 z-20">                        
                            <x-button.plain @click="removePromotionalVideo" class="bg-red-400 px-2">Remove</x-button.plain>
                        </div>
                        <video controls crossorigin playsinline class="promotionalvideoplyrcontainer w-full h-full">
                            <source 
                                id="promotionalvideosource" 
                                type="application/x-mpegURL" 
                                src=""
                            >
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('uppyPromotionalVideo', () => ({
            hlsUrl: '{{ $promotionalVideo }}',

            removePromotionalVideo()
            {
                @this.call('removePromotionalVideo');
                document.getElementById('promotionalVideoUppyTrigger').classList.remove('hidden');
            },

            openPromotionalVideoUppy()
            {
                document.getElementById('promotionalVideoUppyTrigger').click();
            },

            init()
            {
                promotionalVideoPlyr = new Plyr();
                
                Livewire.on('resetUppy', e => {
                    promotionalVideoUppy.reset();
                    promotionalVideoPlyr.destroy();
                    document.getElementById('promotionalVideoPlyr').classList.add('hidden');
                })

                Livewire.on('stopPlyr', e => {
                    promotionalVideoPlyr.pause();
                })
                

                if(this.hlsUrl != "")
                {
                    checkReadyToStream(this.hlsUrl);
                    document.getElementById('promotionalVideoUppyTrigger').classList.add('hidden');
                }

                var promotionalVideoUppy = new Uppy({
                    debug: true,
                    autoProceed: true,
                    allowMultipleUploads: false,
                    allowMultipleUploadBatches: false,
                    restrictions: {
                        maxFileSize: null,
                        minFileSize: null,
                        maxTotalFileSize: null,
                        maxNumberOfFiles: 1,
                        minNumberOfFiles: null,
                        allowedFileTypes: null,
                    },
                });
                promotionalVideoUppy
                .use(Dashboard, {
                    trigger: '.promotionalVideoUppyTrigger',
                    inline: false,
                    height: 400,
                    proudlyDisplayPoweredByUppy: false,
                    doneButtonHandler: null,
                    closeAfterFinish: true,
                    theme: 'dark',
                })
                .use(Tus, {
                    endpoint: "https://api.cloudflare.com/client/v4/accounts/524d39d6dc0fc86e4f92f618260e6f1e/stream",
                    chunkSize: 50 * 1024 * 1024,
                    headers: {
                        'Authorization': 'Bearer C-nnJ30BneWGMn1RKIo6zSmKp3HOm5sUM5ganWlZ',
                    }
                })
                uppy.on('progress', (progress) => {
                    console.log(progress)
                })

                .on('upload-success', (file, response) => {
                    console.log(file);
                    var url = response.uploadURL;

                    var pathname = new URL(url).pathname;
                    var splitUrl = pathname.split('media/');

                    console.log(splitUrl[1]);

                    checkReadyToStream(splitUrl[1]);

                    @this.call('saveVideo', splitUrl[1]);

                    document.getElementById("promotionalVideoProcessLoading").classList.remove('hidden');
                    document.getElementById("promotionalVideoUppyTrigger").classList.add('hidden');

                })

                async function checkReadyToStream(uid)
                {       
                        let promise = new Promise((resolve, reject) => {
                        var interval = setInterval(function()
                        {
                            var url = "https://api.cloudflare.com/client/v4/accounts/"+"{{env('CFS_ACCOUNT_ID')}}"+"/stream/"+uid+"";

                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", url);

                            xhr.setRequestHeader("Authorization", "Bearer "+"{{env('CFS_BEARER_TOKEN')}}");

                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4) {
                                    var xhrObj = JSON.parse(xhr.responseText);
                                    console.log(xhrObj);
                                    console.log(xhrObj.result.readyToStream);
                                    if(xhrObj.result.readyToStream === true)
                                    {
                                        resolve(xhrObj.result.playback.hls);
                                        document.getElementById('promotionalVideoProcessLoading').classList.add('hidden');
                                        document.getElementById('promotionalVideoPlyr').classList.remove('hidden');
                                        document.getElementById('promotionalvideosource').src = xhrObj.result.playback.hls;
                                    }
                                    if(xhrObj.result.status.pctComplete >= 99)
                                    {
                                        clearInterval(interval);
                                    }
                                    else
                                    {
                                        console.log(xhrObj.result.status.pctComplete);
                                        if(!xhrObj.result.status.pctComplete)
                                        {
                                            document.getElementById('promotionalVideoPercentage').innerHTML = '0%';
                                        }
                                        else
                                        {
                                            document.getElementById('promotionalVideoPercentage').innerHTML = parseInt(xhrObj.result.status.pctComplete) + '%';
                                        }
                                    }
                                }
                            };

                            xhr.send();
    
                        },1000);
                    });

                    var result = await promise; // wait until the promise resolves (*)

                    console.log(result);
                    mountVideo();
                }

                function mountVideo()
                {
                    const video = document.querySelector(".promotionalvideoplyrcontainer");
                    const source = document.getElementById('promotionalvideosource').src;
                    promotionalVideoPlyr = new Plyr();
                    
                    const defaultOptions = {};

                    if (Hls.isSupported()) {
                        const hls = new Hls();
                        hls.loadSource(source);

                        hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {

                        var availableQualities = hls.levels.map((l) => l.height)
                        availableQualities.reverse();

                        defaultOptions.quality = {
                            default: availableQualities[1],
                            options: availableQualities,
                            forced: true,        
                            onChange: (e) => updateQuality(e),
                        }
                        defaultOptions.ratio = '16:9';

                        promotionalVideoPlyr = new Plyr(video, defaultOptions);
                        });
                        hls.attachMedia(video);
                        window.hls = hls;
                    } else {
                        promotionalVideoPlyr = new Plyr(video, defaultOptions);
                    }

                    function updateQuality(newQuality) {
                        window.hls.levels.forEach((level, levelIndex) => {
                            if (level.height === newQuality) {
                                console.log("Found quality match with " + newQuality);
                                window.hls.currentLevel = levelIndex;
                            }
                        });
                    }
                }
            }
        }))
    })

    
</script>
</div>

