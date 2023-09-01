<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../Db_connection.php";
       include "data/Subject.php";
       include "data/Module.php";
       

       $search_key = $_GET['searchKey'];
       
       $subjects = searchSubjects($search_key, $conn);
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
    <style>
      /* Add this CSS code to your stylesheet */
      .n-table { 
	max-width: 1000px;
} 
</style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        
     ?>
     <div class="container mt-5">
        <a href="Subject-add.php"
           class="btn btn-dark">Add New Subject</a>

           <form action="subject-search.php" 
                 class="mt-3 n-table"
                 method="get">
             <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchKey"
                       placeholder="Search subject by name...">
                <button class="btn btn-primary">
                        <i class="fa fa-search" 
                           aria-hidden="true"></i>
                      </button>
             </div>
           </form>

           <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" 
                 role="alert">
              <?=$_GET['error']?>
            </div>
            <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" 
                 role="alert">
              <?=$_GET['success']?>
            </div>
            <?php } ?>
            <?php 
        
        if ($subjects!= 0) {
     ?>

           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                   
                    <th scope="col">Subject name</th>
                    <th scope="col">Module name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($subjects as $subject ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$subject['nom']?></td>
                    <td>
                      <?php 
                          $module  = getModuleById($subject['idmodule'], $conn) ;
                          
                          
                          echo $module['nom'];
                       ?>
                    </td>
                    <td>
                        <a href="Subject-edit.php?idmatiere=<?=$subject['idmatiere']?>"
                           class="btn btn-warning">Edit</a>
                        <a href="Subject-delete.php?idmatiere=<?=$subject['idmatiere']?>"
                           class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
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