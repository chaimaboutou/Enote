<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       if (isset($_GET['searchKey'])) {

       $search_key = $_GET['searchKey'];
       include "../Db_connection.php";
       include "data/Module Coordinator.php";
       
       
       $Module_Coordinators = searchModuleCoords($search_key, $conn);
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
        if ($Module_Coordinators != 0) {
     ?>
     <div class="container mt-5">
        <a href="Module Coordinator-add.php"
           class="btn btn-dark">Add New Module Coordinator</a>

           <form action="Module Coordinator-search.php"
                 method="get" 
                 class="mt-3 n-table">
             <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchKey"
                       value="<?=$search_key?>" 
                       placeholder="Search...">
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

           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                  <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">User name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($Module_Coordinators as $Module_Coordinator ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$Module_Coordinator['idUtilisateur']?></td>
                    <td><a href="Module Coordinator-view.php?id_Module_Coordinator=<?=$Module_Coordinator['idUtilisateur']?>">
                         <?=$Module_Coordinator['first_name']?></a></td>
                    <td><?=$Module_Coordinator['last_name']?></td>
                    <td><?=$Module_Coordinator['user_name']?></td>
                    <td><?=$Module_Coordinator['email']?></td>
                    
                    <td>
                        <a href="Module Coordinator-edit.php?id_Module_Coordinator=<?=$Module_Coordinator['idUtilisateur']?>"
                           class="btn btn-warning">Edit</a>
                        <a href="Module Coordinator-delete.php?id_Module_Coordinator=<?=$Module_Coordinator['idUtilisateur']?>"
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
                  No Results Found
                <a href="Module Coordinator.php"
                   class="btn btn-dark">Go Back</a>
              </div>
         <?php } ?>
     </div>
     
     <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(3) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

   }else {
    header("Location: Module Coordinator.php");
    exit;
   } 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>