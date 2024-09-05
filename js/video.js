function playVideo(videoId, videoThumbId, playBtnId) {
    var videoElement = document.getElementById(videoId);
    var thumbnail = document.getElementById(videoThumbId);
    var playBtn = document.getElementById(playBtnId);

    // console.log(thumbnail);
    playBtn.classList.add('played');
    
    if(thumbnail && thumbnail != null) {
        thumbnail.style.display = 'none';
    }

    if (videoElement && playBtn) {
        videoElement.style.display = 'block';
        videoElement.play();
    }
}

