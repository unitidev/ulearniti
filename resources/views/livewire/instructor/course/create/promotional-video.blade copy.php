<div x-data="uppyPromotionalVideo" class="pt-16 flex flex-col items-center justify-center flex-1 w-full h-full max-w-6xl px-4">
    <x-text.h class="text-3xl font-semibold text-center">Promotional Video</x-text.h>

    <x-text.p class="text-lg text-center">Please enter course title and subtitle</x-text.p>
    <div class="w-full max-w-xl bg-white dark:bg-darker-1  p-6 rounded-2xl mt-8">
        <div class="aspect-w-16 aspect-h-9 rounded-md">
            <div id="processing" class="hidden">Processing ... </div>
            @if($promotionalVideo)
                <div id="videoPlyr" class="">
                    <div class="container">
                        <video controls crossorigin playsinline >
                            <source 
                                type="application/x-mpegURL" 
                                src=""
                            >
                        </video>
                    </div>
                </div>
            @else
            <div id="videoPlyr" class="">
                
            </div>
            @endif
        </div>
        <div class="flex items-center justify-center mt-2">
            @if($promotionalVideo == "")
                <x-button.plain @click="$refs.promotionalVideoTriggerBtn.click()" class=" bg-primary w-40">Upload</x-button.plain>
            @else
                <x-button.plain @click="removePromotionalVideo" class="bg-red-400 w-40">Clear</x-button.plain>
            @endif
            <button type="hidden" x-ref="promotionalVideoTriggerBtn" class="promotionalVideoTrigger"></button>
        </div>
    </div>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('uppyPromotionalVideo', () => ({
            hlsUrl: '{{ $promotionalVideo }}',

            removePromotionalVideo()
            {
                @this.call('removePromotionalVideo');
            },

            init()
            {
                Livewire.on('resetUppy', e => {
                    promotionalVideoUppy.reset();
                })

                Livewire.on('pauseVideo', e => {
                    promotionalVideoPlyr.pause();
                })

                if(this.hlsUrl != "")
                {
                    checkReadyToStream(this.hlsUrl);
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
                    trigger: '.promotionalVideoTrigger',
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

                    document.getElementById("processing").classList.remove('hidden');
                })

                async function checkReadyToStream(uid)
                {
                    let promise = new Promise((resolve, reject) => {
                        var interval = setInterval(function()
                        {
                            var url = "https://api.cloudflare.com/client/v4/accounts/524d39d6dc0fc86e4f92f618260e6f1e/stream/"+uid+"";

                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", url);

                            xhr.setRequestHeader("Authorization", "Bearer C-nnJ30BneWGMn1RKIo6zSmKp3HOm5sUM5ganWlZ");

                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4) {
                                    var xhrObj = JSON.parse(xhr.responseText);
                                    console.log(xhrObj);
                                    console.log(xhrObj.result.readyToStream);
                                    if(xhrObj.result.readyToStream === true)
                                    {
                                        resolve(xhrObj.result.playback.hls);
                                    }
                                    if(xhrObj.result.status.pctComplete >= 99)
                                    {
                                        clearInterval(interval);
                                    }
                                }
                            };

                            xhr.send();
    
                        },1000);
                    });

                    var result = await promise; // wait until the promise resolves (*)

                    console.log(result);
                    mountVideo(result);
                }

                function mountVideo(videoUrl)
                {
                    const video = document.querySelector("video");
                    const source = videoUrl;
                    var promotionalVideoPlyr = new Plyr();
                    
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

