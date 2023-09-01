<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../DB_connection.php";
       include "data/setting.php";
       $setting = getSetting($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENote</title>
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
    <script src ="../js/jquery-3.6.0.min.js"> </script>
</head>
<body>
    <?php 
        include "inc/navbar.php";

     ?>
   <div class="container mt-5">
        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/setting-edit.php">
        <h3>Edit</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>
        <div class="mb-3">
          <label class="form-label">School Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$setting['schoolName']?>" 
                 name="school_name">
        </div>
        
        
        <div class="mb-3">
          <label class="form-label">Current college year</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$setting['currentCYear']?>" 
                 name="current_year">
                 </div>
        
      <button type="submit" 
              class="btn btn-primary">
              Update</button>
     </form>
 </div>
     
 <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>
<script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(9) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>