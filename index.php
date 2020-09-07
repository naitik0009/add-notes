<?php 
include "body.php";
$update=false;
$titles = "";
$contents = "";
?>

<?php 
require "database.php";
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!=true ){
    header("location: login.php");
}

?>
<?php 
if(isset($_GET['delete'])){
$id = $_GET['delete'];
$names = $_SESSION['name'];
$selects = "DELETE FROM `$names` WHERE `id` = $id ";
$quers = mysqli_query($connection,$selects);
if($quers){
    header("location: index.php");
}
}

?>

<?php 

if(isset($_GET['edit'])){
    $ids = $_GET['edit'];
    $namess = $_SESSION['name'];
    $selectss = "SELECT * FROM `$namess` WHERE `id` = $ids ";
    $queryss = mysqli_query($connection,$selectss);
    if($queryss){
        $update = true;
    while($grab=mysqli_fetch_array($queryss)){
       
        $titles=$grab['title'];
        $contents = $grab['content'];
    }
}
}

?>

<body>
<div class="container my-3 text-center">
<h2>Our Notes</h2>
</div>
<div align = "center" class="container">
<form action="database.php" method="POST">
    <input type="hidden" name="take" value="<?php $take= $_GET['edit']; echo $take;?>">
  <div class="form-group my-3 col-md-4 text-center">
    <label for="exampleInputEmail1">TITLE</label>
    <input type="text" value = "<?php echo  $titles;?>" name="title" class="form-control" id="exampleInputEmail1" placeholder="enter you note title" aria-describedby="emailHelp">

  <div class="form-group col-md-13 text-center">
    <label for="exampleFormControlTextarea1">Content</label>
    <textarea class="form-control" placeholder="enter you note content" name="content" id="exampleFormControlTextarea1" rows="3"><?php echo  $contents;?></textarea>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <?php  
  if($update==true):
      echo ' <button type="submit" name="update" class="btn btn-primary">update</button>'; ?>
 <?php 
  else: 
  
 echo ' <button type="submit" name="submit" class="btn btn-primary">Submit</button> '; ?>
<?php endif;?>

</form>
</div>
<div  class="container">

<table  class="table" id="myTable">
  <thead class="thead-dark" >
    <tr>
      <th scope="col">sno</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=0;
  $names = $_SESSION['name'];
  $sel = "SELECT * FROM `$names` ";
  $queri = mysqli_query($connection,$sel);
  while($bring=mysqli_fetch_assoc($queri)){
      $i++;
  echo '
 
    <tr>
      <th scope="row">'.$i.'</th>
      <td>'.$bring['title'].'</td>
      <td>'.$bring['content'].'</td>
     <td><a href="index.php?edit='.$bring['id'].'"> <button  class="btn btn-info" type="submit">edit</button></a> <a href="index.php?delete='.$bring['id'].'"  ><button   class="btn btn-danger"type="submit">delete</button></a> </td>
    </tr>
  
  ';
  }
  ?>
  </tbody>
</table>
</div>
<script>

    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<footer>
<div>
  <div class="container my-4 text-center">
  <p class="copyright text-muted">Copyright&copy; <a href="https://jackforum.epizy.com">Jack Forum 2020</a> | Design by <a href="https://www.instagram.com/naitik_rauniyar/">@naitik_rauniyar</a> </p>
  </div>
</div>
</footer>
</body>
