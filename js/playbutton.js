const Progress = document.getElementById("progBar");
const Volume = document.getElementById("volumeBar");
const PlayBtn = document.getElementById("playBtn");
const Music = document.getElementById("mySong");

Volume.max = 100;
Music.volume = 0.25;
Volume.value = Music.volume;


PlayBtn.addEventListener('click', ()=>{
    if(Music.paused){
        Music.play();
        PlayBtn.classList.add("playbutton_active");
        PlayBtn.classList.remove("control_item");
    }
    else {
        Music.pause();
        PlayBtn.classList.add("control_item");
        PlayBtn.classList.remove("playbutton_active");
    }
})

Music.onloadeddata = function(){
    Progress.max = Music.duration;
    Progress.value = Music.currentTime;
}

if(Music.play){
    setInterval(()=>{
        Progress.value = Music.currentTime;
    },500)
}

Progress.onchange = function(){
    Music.currentTime = Progress.value;
}

Volume.onchange = function(){
    var vol = Volume.value / 100;
    Music.volume = vol;
}