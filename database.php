<?php

$server = "localhost";
$username = "root";
$passowrd = "";
$database = "advance";
$connection = mysqli_connect($server,$username,$passowrd,$database);


if(isset($_POST['submit'])){
    session_start();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $name = $_SESSION['name'];
    $sql = "INSERT INTO `$name` (`title`, `content`) VALUES ('$title', '$content')";
    $ins = mysqli_query($connection,$sql);
    if($ins){
        header("location: index.php");
    }
}
if(isset($_POST['update'])){
    session_start();
    $idsss = $_POST['take'];
    $names = $_SESSION['name'];
    $tit = $_POST['title'];
    $cont = $_POST['content'];
    $update = "UPDATE `$names` SET `title`='$tit',`content`='$cont' WHERE `id`=$idsss ";
    $enter = mysqli_query($connection,$update);
    if($enter){
        header("location: index.php");
    }
}
?>