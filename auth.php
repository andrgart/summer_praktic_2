<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <script defer src="js/music_list.js"></script>
    <script defer src="js/add_new_song.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <section class="section_header">
            <div class="header_div">
                <h1><a href="index.php">Андрей музыка</a></h1>
                <ul class="header_list">
                </ul>
                <?php 
                    $user_name = $_POST['user_name'];
                    $password = $_POST['pass'];

                    if(empty($user_name) || empty($password)){
                        header("Location: index.php");
                    }

                    require_once ("php/config.php");
                    $connect = mysqli_connect($host,$user,$pass,$db);
                    if(!$connect) {
                        die();
                    }

                    $is_there_user = 0;
                    $username = '';
                    mysqli_query($connect, "SET CHARSET UTF8;");
                    $result = mysqli_query($connect, "SELECT * FROM `users`;");
                    while($row = mysqli_fetch_array($result)){
                        if($user_name == $row['user_name'] && $password == $row['password']){
                            $is_there_user = 1;
                            $username = $row['user_name'];
                        }
                    }
                    if($is_there_user == 1){
                        echo '<h2 class="user_name">'.$username.'</h2> ';
                    } else {
                        header("Location: index.php");
                    }
                ?>       
            </div>
        </section>
    </header>
    <main>
        <section class="section">
            <div class="music_list_main_div">
                <div class="music_list">
                <?php                
                    $result = mysqli_query($connect, "SELECT `id` FROM `users` WHERE `user_name` = '$user_name'");
                    $user_id_list = mysqli_fetch_array($result);
                    $user_id = $user_id_list[0];     

                    $array = array();
                    $result2 = mysqli_query($connect, "SELECT * FROM `user_songs` WHERE `user_id` = '$user_id'");
                    while($row = mysqli_fetch_array($result2)){
                        array_push($array, $row['song_id']);
                    }

                    $result3 = mysqli_query($connect, "SELECT * FROM `songs`;");
                    while($row1 = mysqli_fetch_array($result3)){
                        if(in_array($row1['id'], $array)){
                            echo "<div class='music_list_item'>
                                <img class='list_item_thumbnail' src='$row1[thumbnail_path]' alt=''>
                                <p class='song_name'>$row1[name]</p>
                                <svg class='heart_svg' viewBox='0 0 512 512'><path class='heart_svg_path' d='M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z'> </path> </svg>
                                <div class='play_circle'>
                                    <img src='icons/play-solid.svg' alt='' class='play_circle_play' id='playBtn'>
                                </div>
                                <p class='song_path hide'>$row1[song_path]</p>
                                <p class='id hide'>$row1[id]</p>
                                <p class='artist hide'>$row1[artist]</p>
                                <p class='song_text hide'>$row1[song_text]</p>
                             </div>";
                        }
                    }
                ?>
                </div>
            </div>
        </section>
        <div class="box_for_player">

        </div>
    </main>
    <div class="box_modal">
        <div id="back_modal" class="back_modal_div">
            <div id="main_modal" class="main_modal_div">
                <div class="modal_thumbnail_div">
                    <img src="img/Ten_klouna.jpg" alt="">
                    <div>
                        <h1>Король и Шут</h1>
                        <h2>MTV</h2>
                    </div>
                </div>
                <div class="modal_song_text_div">
                <p>
                    [Интро]
                    <br>
                    Порою возвращает меня память
                    <br>
                    В тот страшный летний день
                    <br>
                    Когда, бредя вдоль речки безымянной
                    <br>
                    Наткнулся я на труп несчастной женщины
                    <br>
                    Она лежала, запрокинув свою голову
                    <br>
                    На шее рану я увидел безобразную
                    <br>
                    Откуда здесь она, босая, полуголая?
                    <br>
                    Какой-то грязью непонятной вся измазана
                    <br>
                    Но что за взгляд недобрый, что за ненависть
                    <br>
                    С какой покойница смотрела на меня
                    <br>
                    Воскликнул я, значения слов своих не ведая:
                    <br>
                    "Не смей смотреть, меня во всем виня!"
                    <br>
                    Не понимал свое я состояние
                    <br>
                    Ужасный взгляд затмил мое сознание
                    <br>
                    И побежал я прочь от места этого
                    <br>
                    Свели с ума проклятые глаза ее
                    <br>
                    Бежал, пока совсем не обессилел я
                    <br>
                    Но, обернувшись, я увидел эту женщину
                    <br>
                    Не может быть! Какой ужасной силою
                    <br>
                    Был этот труп вдруг приведен в движение?
                    <br>
                    И тело мертвое столкнул я в речку быструю
                    <br>
                    И понеслось оно, потоку подчиняемо
                    <br>
                    А я опять бежать, что было сил моих
                    <br>
                    И падал на пути, кричал отчаянно...
                    <br>
                    А нынче глянул я в окно, со сна опухший -
                    <br>
                    А под окном - размокший труп ужасной женщины!
                    <br>
                    Протер глаза - и тень не растворилась!
                    <br>
                    Избавь, Господь, меня от тех воспоминаний!
                    <br>
                    <br>
                    
                    [Куплет]
                    <br>
                    Хлещет дождь который час
                    <br>
                    Бьет вода по крыше
                    <br>
                    На столе горит свеча
                    <br>
                    Пламя тихо дышит
                    <br>
                    <br>

                    [Припев]
                    <br>
                    Будто вечен
                    <br>
                    Этот вечер
                    <br>
                    <br>

                    [Куплет 2]
                    <br>
                    И никак душе моей
                    <br>
                    Не найти покоя
                    <br>
                    Слышу шорох у дверей
                    <br>
                    Что же там такое?
                    <br>
                    <br>

                    [Припев]
                    <br>
                    Будто вечен
                    <br>
                    Этот вечер
                    <br>
                    <br>

                    [Куплет 3]
                    <br>
                    Слышишь, стерва, голос мой?
                    <br>
                    Ты ведь где-то рядом!
                    <br>
                    Не стучись ко мне домой
                    <br>
                    Мне тебя не надо!
                    <br>
                    <br>

                    [Припев]
                    <br>
                    Будто вечен
                    <br>
                    Этот вечер
                </p>
                </div>
            </div>
        </div>
    </div>

    <div class="user_page_forms_box">
        <form class="form_user_new_song" action="./php/test.php" method="POST" enctype="multipart/form-data">
            <div class="input_div">
                <label for="song_name">название песни</label>
                <input type="text" name="add_song_name">
            </div>

            <div class="input_div">
                <label for="song_author">автор</label>
                <input type="text" name="add_song_author">
            </div>

            <div class="input_div">
                <label for="song_up">песня</label>
                <input type="file" name="add_song_up">
            </div>

            <div class="input_div">
                <label for="thumbnail_up">картинка</label>
                <input type="file" name="add_thumbnail_up">
            </div>

            <div class="input_div"> 
                <label for="add_song_text">текст</label>
                <textarea name="add_song_text"></textarea>
            </div>

            <input class="form_button" type="submit" value="load">
        </form>

        <form class="form_user_new_song" action="./php/addNewSong.php" method="POST">
            <input class="hide" type="text" name="add_song_to_user_name" value='<?php echo $user_name ?>'>
            <div class="input_div">
                <label for="select_song">песня</label>
                <select name="select_song" id="select_song">
                    <?php 
                        $result2 = mysqli_query($connect, "SELECT * FROM `songs`");
                        while($row = mysqli_fetch_array($result2)){
                            echo "<option value='$row[name]'>$row[name]</option>";
                        }
                    ?>
                </select>
            </div>
            <button class="form_button" type="submit">Добавить</button>
        </form>
    </div>

    <div class="empty">
    </div>               
</body>
</html>