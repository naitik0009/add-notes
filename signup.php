<?php
include "body.php";
$signup=false;
?>
<?php
include "database.php";
if(isset($_POST['signup'])){
    $user = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $insert = "INSERT INTO `sign` (`username`, `email`, `password`) VALUES ('$user', '$email', '$hash')";
    $querys  = mysqli_query($connection,$insert);
    if(!$querys){
        $signup = true;
        $message = "You dumb username already exists ";
    }
    else{
    if($querys){
        $create_table = "CREATE TABLE `advance`.`$user` ( `id` INT NOT NULL AUTO_INCREMENT ,  `title` VARCHAR(200) NOT NULL ,  `content` VARCHAR(5000) NOT NULL ,  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB";
        $make = mysqli_query($connection,$create_table);
        if($make){
        header("location: login.php");
        }
    }
    }
}
?>
<?php 
if($signup==true){
    echo '<div class="alert alert-danger" role="alert">
    '.$message.'
  </div>';
}
?>
<body>
<div class="container text-center">
<h2>Signup here</h2>
</div>
<div align = "center" class="container">
<form action="signup.php" method="POST">
<div class="form-group col-md-4">
    <label for="exampleInputPassword1">Username</label>
    <input type="text" name=username maxlength="10" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group my-3 col-md-4 text-center">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group col-md-4">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name = "password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" name="signup" class="btn btn-primary">Signup</button>
</form>
</div>
<footer>
<div>
  <div class="container my-4 text-center">
  <p class="copyright text-muted">Copyright&copy; <a href="https://jackforum.epizy.com">Jack Forum 2020</a> | Design by <a href="https://www.instagram.com/naitik_rauniyar/">@naitik_rauniyar</a> </p>
  </div>
</div>
</footer>
</body>

