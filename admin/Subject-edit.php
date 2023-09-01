<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])  && 
    isset($_GET['idmatiere'])
    ) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../Db_connection.php";
       include "data/Subject.php";
       
       include "data/Module.php";
       
       
      $id=$_GET['idmatiere'];

      $subject=getSubjectById($id, $conn);
      
       $modules = getAllModules($conn);
       

       if ($subject == 0) {
        
          header("Location: Subject.php");
          exit;
       }


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
        <a href="Subject.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/Subject-edit.php">
        <h3>Edit Subject</h3><hr>
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
        <label class="form-label">ID</label>
        <input type="number" class="form-control" value="<?=$subject['idmatiere']?>" name="idSubject" readonly>
        </div>

    <div class="mb-3">
        <label class="form-label">Subject name</label>
        <input type="text" class="form-control" value="<?=$subject['nom']?>" name="sname">
    </div>

    
       
        <div class="mb-3">
          <label class="form-label">Module name</label>
          <select name="module"
                  class="form-control" >
                  <?php foreach ($modules as $module) { 
                     $selected = 0;
                     if ($module['idmodule'] == $subject['idmodule'] ) {
                       $selected = 1;
                     }
                  ?>

                    <option  value="<?=$module['idmodule']?>"
                          <?php if ($selected) echo "selected"; ?> >
                          <?=$module['nom']?>
                    </option> 
                  <?php } ?>
                  
          </select>
        </div>
       
        

      <button type="submit" 
              class="btn btn-primary">
              Update</button>
     </form>
     
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
    
    header("Location:/");
    exit;
  } 
}else {
  $em="here";
  
	header("Location:/");
	exit;
} 

?>