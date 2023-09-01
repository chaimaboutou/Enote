<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../Db_connection.php";
        include "data/Subject.php";
       include "data/Module.php";

      
       $modules = getAllModules($conn);

       
    
    

    //    if (isset($_GET['$id_fil'])) $id_fil = $_GET['$id_fil'];
    //    if (isset($_GET['$pro_name'])) $fname = $_GET['$pro_name'];
       
       

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
        if ($modules == 0 ) { ?>
           
          <div class="alert alert-info" role="alert">
           First add Module 
          </div>
           <a href="Subject.php"
           class="btn btn-dark">Go Back</a>
      <?php } ?>
     <div class="container mt-5">
        <a href="Subject.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/Subject-add.php">
        <h3>Add New Subject</h3><hr>
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
        <label class="form-label">Subject name</label>
        <input type="text" class="form-control"  name="sname">
    </div>

    
        <div class="mb-3">
          <label class="form-label"> Module</label>
          <select name="Module"
                  class="form-control" >
                  <?php foreach ($modules as $module) { ?>
                    <option value="<?=$module['idmodule']?>">
                       <?=$module['nom']?>
                    </option> 
                  <?php } ?>
                  
          </select>
        </div>
       
        
      <button type="submit" class="btn btn-primary">Create</button>
     </form>
     </div>
     
     <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(5) a").addClass('active');
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