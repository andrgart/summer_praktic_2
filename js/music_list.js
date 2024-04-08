const boxForPlayer = document.querySelector(".box_for_player");
var MusicDiv = document.querySelector(".music_list");

MusicDiv.addEventListener('click', (event) => {
    if(event.target.classList.contains("play_circle") || event.target.classList.contains("play_circle_play"))  
    {
        let musListItem = event.target.closest(".music_list_item");
        let musicName = musListItem.querySelector(".song_name").innerHTML;

        const musicNameList = document.querySelectorAll(".song_name");
        musicNameList.forEach(name => {
            if(name.innerHTML == musicName){
                var musicListItem = name.closest(".music_list_item");
                CreatePlayer(musicListItem);
            }
        });
    }  
})

function CreatePlayer(musListItem) {
        boxForPlayer.innerHTML = "";

        let thumbnail = musListItem.querySelector(".list_item_thumbnail");
        let thumbnailPath = thumbnail.getAttribute("src");
        let musicName = musListItem.querySelector(".song_name").innerHTML;
        let musicPath = musListItem.querySelector(".song_path").innerHTML;
        let artist = musListItem.querySelector(".artist").innerHTML;

        
        var audio = document.createElement("audio");
        audio.setAttribute("id", "mySong");

        var source = document.createElement("source");
        source.setAttribute("src", musicPath);

        audio.append(source);

        /*----*/
        var playerDiv = document.createElement("div");
        playerDiv.classList.add("player");

        /*-----*/
        var progressBar = document.createElement("input");
        progressBar.setAttribute("type", "range");
        progressBar.setAttribute("value", "0");
        progressBar.classList.add("progressBar");

        /*--*/
        var controlsDiv = document.createElement("div");
        controlsDiv.classList.add("controls_div");


        var controls = document.createElement("div");
        controls.classList.add("controls");

        var imgBackArr = document.createElement("img");
        imgBackArr.setAttribute("src", "icons/backward-fast-solid.svg");
        imgBackArr.setAttribute("id", "backBtn");
        imgBackArr.classList.add("control_item");
        var imgForwArr = document.createElement("img");
        imgForwArr.setAttribute("src", "icons/forward-fast-solid.svg");
        imgForwArr.setAttribute("id", "forBtn");
        imgForwArr.classList.add("control_item");
        var imgPlay = document.createElement("img");
        imgPlay.setAttribute("src", "icons/pause-solid.svg");
        imgPlay.setAttribute("id", "playBtn");
        imgPlay.classList.add("control_item");

        controls.append(imgBackArr);
        controls.append(imgPlay);
        controls.append(imgForwArr);

        controlsDiv.append(controls);


        var thumbnailDiv = document.createElement("div");
        thumbnailDiv.classList.add("player_thumbnail_div");

        var tHumbnail = document.createElement("img");
        tHumbnail.setAttribute("src", thumbnailPath);
        tHumbnail.classList.add("list_item_thumbnail");

        var div = document.createElement("div");
        var h3 = document.createElement("h3");
        h3.classList.add("currentSongName");
        h3.innerHTML = musicName;
        var p = document.createElement("p");
        p.innerHTML = artist;

        div.append(h3);
        div.append(p);

        thumbnailDiv.append(tHumbnail);
        thumbnailDiv.append(div);

        controlsDiv.append(thumbnailDiv);


        var volumeBarDiv = document.createElement("div");
        volumeBarDiv.classList.add("div_bar");

        var infoimg = document.createElement("img");
        infoimg.classList.add("songInfo");
        infoimg.setAttribute("id", "songInfo");
        infoimg.setAttribute("src", "icons/info.svg");

        var volumeimg = document.createElement("img");
        volumeimg.setAttribute("src", "icons/volume-high-solid.svg");

        var volumeBar = document.createElement("input");
        volumeBar.setAttribute("type", "range");
        volumeBar.setAttribute("value", "0");
        volumeBar.setAttribute("id", "volumeBar");
        volumeBar.classList.add("volumeBar");

        volumeBarDiv.append(volumeimg);
        volumeBarDiv.append(volumeBar);
        volumeBarDiv.append(infoimg);

        controlsDiv.append(volumeBarDiv);


        playerDiv.append(progressBar);
        playerDiv.append(controlsDiv);


        boxForPlayer.innerHTML = "";
        boxForPlayer.append(audio);
        boxForPlayer.append(playerDiv);


        /*  ---   ---  */
        audio
        imgPlay
        progressBar
        volumeBar

        volumeBar.max = 100;
        volumeBar.value = 25;
        audio.volume = 0.25;


        audio.play();
        imgPlay.addEventListener('click', ()=>{
            if(audio.paused){
                audio.play();
                imgPlay.removeAttribute("src");
                imgPlay.setAttribute("src", "icons/pause-solid.svg");
            }
            else {
                audio.pause();
                imgPlay.removeAttribute("src");
                imgPlay.setAttribute("src", "icons/play-solid.svg");
            }
        })

        audio.onloadeddata = function(){
            progressBar.max = audio.duration;
            progressBar.value = audio.currentTime;
        }

        if(audio.play){
            setInterval(()=>{
                progressBar.value = audio.currentTime;
            },500)
        }

        progressBar.onchange = function(){
            audio.currentTime = progressBar.value;
        }

        volumeBar.onchange = function(){
            var vol = volumeBar.value / 100;
            audio.volume = vol;
        }

        PlayerBtns(musListItem);
}

/*  Попытка создать лист музычки   */
function PlayerBtns(musListItem) {
    /* кнопки вперёд и назад*/
    const musicNameList = document.querySelectorAll(".song_name");
    const backArr = document.getElementById("backBtn");
    const forArr = document.getElementById("forBtn");

    var player = backArr.closest(".player");
    var currentSongName = player.querySelector(".currentSongName");

    var currentMusNum = 0;
    var counter = 0;
    musicNameList.forEach(item => {
        counter++;
        if(item.innerHTML == currentSongName.innerHTML){
            currentMusNum = counter;
        }
    });


    if(!(currentMusNum == 1)){
        backArr.addEventListener('click', ()=>{
            console.log(musicNameList[currentMusNum - 1 - 1].innerHTML); // - 1 - 1 = гениально

            musicNameList.forEach(name => {
                if(name.innerHTML == musicNameList[currentMusNum - 1 - 1].innerHTML){
                    var musicListItem = name.closest(".music_list_item");
                    CreatePlayer(musicListItem);
                }
            });
        })
    }
    if(!(currentMusNum == musicNameList.length)){
        forArr.addEventListener('click', ()=>{
            console.log(musicNameList[currentMusNum - 1 + 1].innerHTML); // - 1 + 1 = гениально

            musicNameList.forEach(name => {
                if(name.innerHTML == musicNameList[currentMusNum - 1 + 1].innerHTML){
                    var musicListItem = name.closest(".music_list_item");
                    CreatePlayer(musicListItem);
                }
            });
        })
    }

    /* модальное окно с информацией о песне*/
    infoSvg = document.querySelector(".songInfo");
    backModel = document.getElementById("back_modal");
    mainModal = document.getElementById("main_modal");

    infoSvg.addEventListener('click', ()=>{
        console.log(currentSongName.innerHTML);
        modal_thumbnail_div = document.querySelector(".modal_thumbnail_div");
        modal_thumbnail_div.innerHTML = "";

        let thumbnail = musListItem.querySelector(".list_item_thumbnail");
        let thumbnailPath = thumbnail.getAttribute("src");
        let musicName = musListItem.querySelector(".song_name").innerHTML;
        let artist = musListItem.querySelector(".artist").innerHTML;
        let song_text = musListItem.querySelector(".song_text").innerHTML;


        var modalThumbnailimg = document.createElement("img");
        modalThumbnailimg.setAttribute("src", thumbnailPath);

        var modalThumbnailDiv = document.createElement("div");
        var modalThumbnailh1 = document.createElement("h1");
        modalThumbnailh1.innerHTML = musicName;
        var modalThumbnailh2 = document.createElement("h2");
        modalThumbnailh2.innerHTML = artist;


        modalThumbnailDiv.append(modalThumbnailh1);
        modalThumbnailDiv.append(modalThumbnailh2);

        var modal_song_text_div = document.querySelector(".modal_song_text_div");
        modal_song_text_div.innerHTML = "";
        var song_text_p = document.createElement("p");

        song_text_p.innerHTML = song_text;

        modal_song_text_div.append(song_text_p);


        modal_thumbnail_div.append(modalThumbnailimg);
        modal_thumbnail_div.append(modalThumbnailDiv);

        back_modal.classList.add("back_modal_div_active");
    })

    backModel.addEventListener('click', ()=>{
        back_modal.classList.remove("back_modal_div_active");
    })
}