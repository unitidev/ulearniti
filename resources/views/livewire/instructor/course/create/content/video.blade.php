<div x-data="
{
    async checkReadyToStream(uid)
    {
        let promise = new Promise((resolve, reject) => {
            var interval = setInterval(function()
            {
                var url = 'https://api.cloudflare.com/client/v4/accounts/'+'{{env('CFS_ACCOUNT_ID')}}'+'/stream/'+uid+'';

                var xhr = new XMLHttpRequest();
                xhr.open('GET', url);

                xhr.setRequestHeader('Authorization', 'Bearer '+'{{env('CFS_BEARER_TOKEN')}}'+'');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        var xhrObj = JSON.parse(xhr.responseText);
                        document.getElementById('videofilename{{$content_id}}').innerHTML = xhrObj.result.meta.filename;
                        if(xhrObj.result.readyToStream === true)
                        {
                            resolve(xhrObj.result.playback.hls);
                            document.getElementById('uploadicon{{$content_id}}').classList.add('hidden');
                            document.getElementById('processloading{{$content_id}}').classList.add('hidden');
                            document.getElementById('thumbnailcontainer{{$content_id}}').classList.remove('hidden');
                            document.getElementById('gifthumbnail{{$content_id}}').src='https://videodelivery.net/'+uid+'/thumbnails/thumbnail.jpg?time=10s&height=270';
                        }
                        if(xhrObj.result.status.pctComplete >= 99)
                        {
                            clearInterval(interval);
                        }
                        else
                        {
                            if(!xhrObj.result.status.pctComplete)
                            {
                                document.getElementById('percentage{{$content_id}}').innerHTML = '0%';
                            }
                            else
                            {
                                document.getElementById('percentage{{$content_id}}').innerHTML = parseInt(xhrObj.result.status.pctComplete) + '%';
                            }
                        }
                    }
                };

                xhr.send();

            },1000);
        });

        var result = await promise;
    },

    init()
    {
        var uid = '{{$uid}}';

        if(uid)
        {
            this.checkReadyToStream(uid)
        }
    }

}
"
x-init="
{
    content_video{{$content_id}}: new Uppy({
    
    })   

    .use(Dashboard, {
        trigger: '.trigger{{$content_id}}',
        inline: false,
        height: 400,
        proudlyDisplayPoweredByUppy: false,
        closeAfterFinish: true,
        theme: 'dark',
    })
    .use(Tus, {
        endpoint: 'https://api.cloudflare.com/client/v4/accounts/'+'{{env('CFS_ACCOUNT_ID')}}'+'/stream',
        chunkSize: 50 * 1024 * 1024,
        headers: {
            'Authorization': 'Bearer '+'{{env('CFS_BEARER_TOKEN')}}'+'',
        },
    })
    .on('progress', (progress) => {
        console.log(progress)
    })
    .on('upload-success', (file, response) => {
        console.log('{{env('CFS_ACCOUNT_ID')}}');
        var url = response.uploadURL;

        var pathname = new URL(url).pathname;
        var splitUrl = pathname.split('media/');

        console.log(splitUrl[1]);

        checkReadyToStream(splitUrl[1]);

        getVideoDuration(splitUrl[1]);

        @this.call('saveVideo', splitUrl[1]);

        document.getElementById('uploadicon{{$content_id}}').classList.add('hidden');
        document.getElementById('processloading{{$content_id}}').classList.remove('hidden');

        async function checkReadyToStream(uid)
        {
            console.log('called');
            let promise = new Promise((resolve, reject) => {
                var interval = setInterval(function()
                {
                    var url = 'https://api.cloudflare.com/client/v4/accounts/'+'{{env('CFS_ACCOUNT_ID')}}'+'/stream/'+uid+'';

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', url);

                    xhr.setRequestHeader('Authorization', 'Bearer '+'{{env('CFS_BEARER_TOKEN')}}'+'');

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            var xhrObj = JSON.parse(xhr.responseText);
                            document.getElementById('videofilename{{$content_id}}').innerHTML = xhrObj.result.meta.filename;
                            if(xhrObj.result.readyToStream === true)
                            {
                                resolve(xhrObj.result.playback.hls);
                                @this.call('saveVideoDuration', xhrObj.result.duration);
                                document.getElementById('processloading{{$content_id}}').classList.add('hidden');
                                document.getElementById('thumbnailcontainer{{$content_id}}').classList.remove('hidden');
                                document.getElementById('gifthumbnail{{$content_id}}').src='https://videodelivery.net/'+uid+'/thumbnails/thumbnail.jpg?time=10s&height=270';
                                
                            }
                            if(xhrObj.result.status.pctComplete >= 99)
                            {
                                clearInterval(interval);
                            }
                            else
                            {
                                if(!xhrObj.result.status.pctComplete)
                                {
                                    document.getElementById('percentage{{$content_id}}').innerHTML = '0%';
                                }
                                else
                                {
                                    document.getElementById('percentage{{$content_id}}').innerHTML = parseInt(xhrObj.result.status.pctComplete) + '%';
                                }
                            }
                        }
                    };

                    xhr.send();

                },1000);
            });

            var result = await promise;
        }

        async function getVideoDuration(uid)
        {
            console.log('called');
            let promise = new Promise((resolve, reject) => {
                var interval = setInterval(function()
                {
                    var url = 'https://api.cloudflare.com/client/v4/accounts/'+'{{env('CFS_ACCOUNT_ID')}}'+'/stream/'+uid+'';

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', url);

                    xhr.setRequestHeader('Authorization', 'Bearer '+'{{env('CFS_BEARER_TOKEN')}}'+'');

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            var xhrObj = JSON.parse(xhr.responseText);
                            document.getElementById('videofilename{{$content_id}}').innerHTML = xhrObj.result.meta.filename;
                            if(xhrObj.result.readyToStream === true)
                            {
                                @this.call('saveVideoDuration', xhrObj.result.duration);   
                                resolve(xhrObj.result.duration);
                                clearInterval(interval);                           
                            }
                        }
                    };

                    xhr.send();

                },1000);
            });

            var result = await promise;
        }
    })
}" 


class="group relative w-full focus-within:shadow-md bg-white dark:bg-darker-2 border border-lighter dark:border-darkest rounded-md transform duration-200">
    <div class="w-full bg-light dark:bg-darker-1 relative transform duration-200 rounded-t-md text-2xl flex items-center justify-center" :class="focused_content != {{ $content_id }} ? '' : 'py-2'">
        <span handle class="handle absolute iconify cursor-move" data-icon="mdi:drag-horizontal" x-show="focused_content == {{ $content_id }}"></span>
    </div>
    <div class="w-full transform duration-300">
        <div class="flex items-center">
            <div class="h-10 w-12 rounded-md items-center justify-center flex">
                <i class="fa-solid fa-circle-play"></i>
            </div>
            <input wire:model.lazy="title" wire:focusout="updateContent" class="rounded-md content-input w-full outline-none bg-transparent ring-0 border-none focus:ring-0 font-mont text-lg font-semibold text-darker dark:text-light placeholder-darker dark:placeholder-light" type="text"/>  

        </div>
        <div class="w-full relative overflow-hidden transition-all pl-4 max-h-0 duration-300" style="" x-ref="container{{ $content_id }}" :style="focused_content == {{ $content_id }} ? 'max-height: ' + $refs.container{{ $content_id }}.scrollHeight + 'px' : ''">
            <div class="w-full flex mb-4">
                <div class="w-60">
                    <div class="aspect-w-16 aspect-h-9 bg-light dark:bg-darker-1 rounded-md">
                        <div class="w-full h-full flex items-center justify-center text-4xl text-primary dark:text-primary">
                            <div id="processloading{{$content_id}}" wire:ignore class="hidden">
                                <div class="w-full flex items-center justify-center text-xl"><i class="animate-spin fa-duotone fa-spinner-third"></i></div>
                                <div class="flex mt-2">
                                    <div class="text-darker dark:text-light text-sm">
                                        Processing...
                                    </div> 
                                    <div id="percentage{{$content_id}}"class="text-darker dark:text-light text-sm">
                                        0%
                                    </div>
                                </div>
                            </div>
                            <button wire:ignore id="uploadicon{{$content_id}}" class="trigger{{$content_id}}"><i class="fa-light fa-arrow-up-from-square"></i></button>
                            <div wire:ignore id="thumbnailcontainer{{$content_id}}" class="w-full h-full relative hidden items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center">
                                    <img class="shadow-inner absolute top-0 rounded-md object-cover h-full" id="gifthumbnail{{$content_id}}" src="" alt="">
                                    <button wire:click="emitVideoUrl" class="absolute h-1/2 text-primary text-2xl hover:text-4xl transform duration-100"><i class="fa-solid fa-play"></i></button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="w-full px-8">
                    Uploaded video must at least 720p, or 1080p if possible. 
                    <div class="flex ">
                        Filename :&nbsp<div wire:ignore id="videofilename{{$content_id}}"></div>
                    </div>
                    <div> {{ $video_duration }}</div>
                </div>
            </div>
        </div>
    </div>
</div>