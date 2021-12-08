<div class="w-full">
    <div id="videoPlyr" class="w-full h-full flex items-center justify-center ">
        <div class="container bg-black rounded-xl w-full max-w-2xl" id="plyrModalsContainer" @click.outside="modals = false; destroyPlyr();">
            <video controls crossorigin playsinline class="plyrmodalscontainer">
                <source 
                    id="plyrmodalssource"
                    type="application/x-mpegURL" 
                    src="{{$uid}}"
                >
            </video>
        </div>
    </div>
    <button type="hidden" id="showModalBtn" @click="modals = true"></button>
    <script>
       
        var modals = false;
        var modalsVideoPlyr = new Plyr();
        Livewire.on('mountVideo', uid => {
           
            document.getElementById('plyrmodalssource').src = "https://videodelivery.net/"+uid+"/manifest/video.m3u8";
            document.getElementById('showModalBtn').click();
            mountPlyrVideo();
        })

        modalsVideoPlyr.on('playing', event => {
            const instance = event.detail.plyr;
            console.log(instance);
        });

        function mountPlyrVideo()
        {
            modals = true;
            const source = document.getElementById('plyrmodalssource').src;
            modalsVideoPlyr = new Plyr();
            const video = document.querySelector(".plyrmodalscontainer");
            
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

                modalsVideoPlyr = new Plyr(video, defaultOptions);
                modalsVideoPlyr.on('ended', event => {
    const instance = event.detail.plyr;
    alert(instance);
});
                });

                hls.attachMedia(video);
                window.hls = hls;
            } else {
                modalsVideoPlyr = new Plyr(video, defaultOptions);
                modalsVideoPlyr.on('ended', event => {
    const instance = event.detail.plyr;
    alert(instance);
});
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

        function destroyPlyr()
        {
            if(modals == true)
            {
                setTimeout(function(){  
                    modalsVideoPlyr.destroy()
                    modalsVideoPlyr = new Plyr(); 
                }, 300);
                modals = false
            }
        }

        window.addEventListener('click', function(e) {
            if (document.getElementById('plyrModalsContainer').contains(e.target)) {
            } 
            else {
                destroyPlyr();
            }
        }) 


    </script>
</div>
