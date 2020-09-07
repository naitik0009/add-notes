<?php 
include "body.php";
$login=false;
?>
<?php
include "database.php";
if(isset($_POST['login'])){
    $user = $_POST['user'];
    $password = $_POST['password'];
    $check = "SELECT * FROM `sign` WHERE `username` = '$user'  ";
    $quer = mysqli_query($connection,$check);
    $row = mysqli_num_rows($quer);
    if(!$row){
        $login=true;
        $message = "You dumb your username or password is invalid";
    }
    else{
    if($row){
        while($show=mysqli_fetch_assoc($quer)){
            if(password_verify($password,$show['password'])){
                session_start();
                $_SESSION['login']=true;
                $_SESSION['name']=$user;
                header("location: index.php");
            }
        }
    }
}

}

?>
<?php 
if($login==true){
    echo '<div class="alert alert-danger" role="alert">
    '.$message.'
  </div>';
}
?>
<body>
<div class="container text-center">
<h2>Login here</h2>
</div>
<div align = "center" class="container">
<form action="login.php" method="POST">
  <div class="form-group my-3 col-md-4 text-center">
    <label for="exampleInputEmail1">Username</label>
    <input type="text"  name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your Username with anyone else.</small>
  </div>
  <div class="form-group col-md-4">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
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