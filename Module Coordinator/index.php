<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Module Coordinator') {
       include "../Db_connection.php";
       include "data/Module Coordinator.php";
       

       $ModuleCoord_id = $_SESSION['idUtilisateur'];
       $ModuleCoord = getModuleCoordById($ModuleCoord_id, $conn);
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

        if ($ModuleCoord != 0) {
     ?>
     <div class="container mt-0">
        <div class="card horizontal-card">
            <div class="row no-gutters">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div>
                    <img src="../img/<?=$ModuleCoord['gender']?>.png" class="card-img" alt="Profile Image">
                    <br> <br>
                    <h5 class="card-title text-center">@<?=$ModuleCoord['user_name']?></h5>
                    <h3 class="card-title text-center"><?=$ModuleCoord['role']?></h3>
                </div>
            </div>
                <div class="col-md-8">
                    <div class="card-body">
                        
                        <p class="list-group-item">First Name: <?=$ModuleCoord['first_name']?></p>
                        <p class="list-group-item">Last Name: <?=$ModuleCoord['last_name']?></p>
                        <p class="list-group-item">Username: <?=$ModuleCoord['user_name']?></p>

                        <p class="list-group-item">Employee number: <?=$ModuleCoord['idUtilisateur']?></p>
                        <p class="list-group-item">Address: <?=$ModuleCoord['Address']?></p>
                        <p class="list-group-item">Date of birth: <?=$ModuleCoord['date_birth']?></p>
                        <p class="list-group-item">Phone number: <?=$ModuleCoord['phone_number']?></p>

                        <p class="list-group-item">Email address: <?=$ModuleCoord['email']?></p>
                        <p class="list-group-item">Gender: <?=$ModuleCoord['gender']?></p>


                       
                    </div>
                    <div class="card-body ">
                    <a href="Module Coordinator-edit.php?id_Module_Coordinator=<?=$ModuleCoord['idUtilisateur']?>"
                           class="btn btn-warning">Edit Your Profile</a>
            
                </div>
                </div>
            </div>
        </div>
    </div>
    

     <?php 
        }else {
          header("Location: logout.php?error=An error occurred");
          exit;
        }
     ?>
    
    <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>	
<script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
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