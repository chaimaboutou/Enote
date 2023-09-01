<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../Db_connection.php";
       include "data/Program.php";
       include "data/Program Coordinator.php";
       
       $programs = getAllPrograms($conn);
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
        <a href="Program-add.php"
           class="btn btn-dark">Add New Program</a>

           <form action="program-search.php" 
                 class="mt-3 n-table"
                 method="get">
             <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchKey"
                       placeholder="Search program by it's name...">
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
        
        if ($programs != 0) {
     ?>

           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    
                    <th scope="col">Program</th>
                    <th scope="col">Program Coordinator</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($programs as $program ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                   
                    <td><?=$program['nom']?></td>
                    <td>
                      <?php 
                          $Program_Coordinator  = getProgramCoordById($program['idCoordFil'], $conn) ;
                          
                          
                          echo $Program_Coordinator['last_name'].'  '.$Program_Coordinator['first_name'];
                       ?>
                    </td>
                    <td>
                        <a href="Program-edit.php?idFiliere=<?=$program['idFiliere']?>"
                           class="btn btn-warning">Edit</a>
                        <a href="Program-delete.php?idFiliere=<?=$program['idFiliere']?>"
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
             $("#navLinks li:nth-child(7) a").addClass('active');
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