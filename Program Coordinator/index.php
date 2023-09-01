<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Program Coordinator') {
       include "../Db_connection.php";
       include "data/Program Coordinator.php";
       

       $id_ProgramCoord = $_SESSION['idUtilisateur'];
       $ProgramCoord = getProgramCoordById($id_ProgramCoord, $conn);
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

        if ($ProgramCoord != 0) {
     ?>
     <div class="container mt-0">
        <div class="card horizontal-card">
            <div class="row no-gutters">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div>
                    <img src="../img/<?=$ProgramCoord['gender']?>.png" class="card-img" alt="Profile Image">
                    <br> <br>
                    <h5 class="card-title text-center">@<?=$ProgramCoord['user_name']?></h5>
                    <h3 class="card-title text-center"><?=$ProgramCoord['role']?></h3>
                </div>
            </div>
                <div class="col-md-8">
                    <div class="card-body">
                        
                        <p class="list-group-item">First Name: <?=$ProgramCoord['first_name']?></p>
                        <p class="list-group-item">Last Name: <?=$ProgramCoord['last_name']?></p>
                        <p class="list-group-item">Username: <?=$ProgramCoord['user_name']?></p>

                        <p class="list-group-item">Employee number: <?=$ProgramCoord['idUtilisateur']?></p>
                        <p class="list-group-item">Address: <?=$ProgramCoord['Address']?></p>
                        <p class="list-group-item">Date of birth: <?=$ProgramCoord['date_birth']?></p>
                        <p class="list-group-item">Phone number: <?=$ProgramCoord['phone_number']?></p>

                        <p class="list-group-item">Email address: <?=$ProgramCoord['email']?></p>
                        <p class="list-group-item">Gender: <?=$ProgramCoord['gender']?></p>


                       
                    </div>
                    <div class="card-body ">
                    <a href="Program Coordinator-edit.php?id_Program_Coord=<?=$ProgramCoord['idUtilisateur']?>"
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