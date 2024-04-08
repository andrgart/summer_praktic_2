<?php
$user_name = $_POST['user_name'];
$password = $_POST['pass'];


require_once "config.php";
$connect = mysqli_connect($host, $user, $pass, $db); //соед с БД
if(!$connect){
    echo false;
    die();
}

$name_is_free = 1;
$result = mysqli_query($connect, "SELECT * FROM `users`;");
while($row = mysqli_fetch_array($result)){
    if($user_name == $row['user_name']){
        $name_is_free = 0;
    }
}

if($name_is_free == 1){
    $result = mysqli_prepare($connect, "INSERT INTO `users`(`user_name`, `password`) VALUES (?,?)");
    mysqli_stmt_bind_param($result, "ss", $user_name, $password); //ss
    $res = mysqli_stmt_execute($result);
    echo 'пользователь зарегистрирован';
} else {
    echo 'имя пользователя занято';
}
