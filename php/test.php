<?php 
$add_song_name = $_FILES['add_song_up']['name'];
$add_song_tmp_name = $_FILES['add_song_up']['tmp_name'];

$add_img_name = $_FILES['add_thumbnail_up']['name'];
$add_img_tmp_name = $_FILES['add_thumbnail_up']['tmp_name'];


$song_name = $_POST['add_song_name'];
$song_author = $_POST['add_song_author'];
$song_text = $_POST['add_song_text'];
$song_path = "songs/". $add_song_name;
$img_path = "img/". $add_img_name;


$parts_of_song = explode('.', $song_path);
$parts_of_img = explode('.', $img_path);

$_parts_of_song = explode('.', $add_song_name);
$_parts_of_img = explode('.', $add_img_name);


//echo($add_song_name. " | " .$add_img_name . " | " . $song_name . " | " . $song_author . " | ");

require_once "config.php";
$connect = mysqli_connect($host, $user, $pass, $db); 
if(!$connect){
    echo false;
    die();
}


// $arr_img_path = [];
// $arr_song_path = [];

// $result_t = mysqli_query($connect, "SELECT * FROM `songs`;");
// while($row = mysqli_fetch_array($result_t)){
//     array_push($arr_img_path, $row['thumbnail_path']);
//     array_push($arr_song_path, $row['song_path']);
// }


// $isImgThere = true;
// $isSongThere = true;
// while($isImgThere || $isSongThere){
//     if(in_array($song_path, $arr_song_path)){
//         $song_path = $parts_of_song[0]. "q" . "." . $parts_of_song[1];
//         $add_song_name = $_parts_of_song[0]. "q" . "." . $_parts_of_song[1];
//     }
//     if(in_array($img_path, $arr_img_path)){
//         $img_path = $parts_of_img[0]. "q" . "." . $parts_of_img[1];
//         $add_img_name = $_parts_of_img[0]. "q" . "." . $_parts_of_img[1];
//     }
// }

// echo $song_path . " | " . $img_path;

move_uploaded_file($add_song_tmp_name, "../songs/". $add_song_name);
move_uploaded_file($add_img_tmp_name, "../img/". $add_img_name);


$result = mysqli_prepare($connect, "INSERT INTO `songs`(`thumbnail_path`, `name`, `song_path`, `artist`, `song_text`) VALUES (?,?,?,?,?)");
mysqli_stmt_bind_param($result, "sssss", $img_path, $song_name, $song_path, $song_author, $song_text); //ss
$res = mysqli_stmt_execute($result);


?>