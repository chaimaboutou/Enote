<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../Db_connection.php";
       include "data/Module.php";
       include "data/Module Coordinator.php";
       include "data/Program.php";

       $search_key = $_GET['searchKey'];
       
       $modules = searchModuless($search_key, $conn);
       
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
/* Add this CSS code to your stylesheet */
.n-table th:nth-child(5),
.n-table td:nth-child(5) {
    width: 150px; /* Adjust the width as needed */
}

    </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        
     ?>
     <div class="container mt-5">
        <a href="Module-add.php"
           class="btn btn-dark">Add New Module</a>
           
           <form action="module-search.php" 
                 class="mt-3 n-table"
                 method="get">
             <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchKey"
                       placeholder="Search module by it's name...">
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
        
        if ($modules != 0) {
     ?>

           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Module</th>
                    <th scope="col">Module Coordinator</th>
                    <th scope="col">Program</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($modules as $module ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$module['nom']?></td>
                    <td>
                      <?php 
                          $Module_Coordinator  = getModuleCoordById($module['idCoordMod'], $conn) ;
                          
                          
                          echo $Module_Coordinator['last_name'].'  '.$Module_Coordinator['first_name'];
                       ?>
                    </td>
                    <td>
                      <?php 
                          $program  = getProgramById($module['idFiliere'], $conn) ;
                          
                          
                          echo $program['nom'];
                       ?>
                    </td>
                    <td>
                        <a href="Module-edit.php?idmodule=<?=$module['idmodule']?>"
                           class="btn btn-warning">Edit</a>
                        <a href="Module-delete.php?idmodule=<?=$module['idmodule']?>"
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
             $("#navLinks li:nth-child(6) a").addClass('active');
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