<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../Db_connection.php";
       include "data/Module Coordinator.php";
       
       if(isset($_GET['id_Module_Coordinator'])){

       
       $id_Module_Coordinator = $_GET['id_Module_Coordinator'];
       $Module_Coordinator = getModuleCoordById($id_Module_Coordinator , $conn);

        

       
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
        /* Center the card */
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Adjust the card width */
        .custom-card {
            width: 25rem; /* Increase the width as desired */
        }
    </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($Module_Coordinator != 0) {
     ?>
     
     <div class="container mt-2">
        <div class="card horizontal-card">
            <div class="row no-gutters">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div>
                    <img src="../img/<?=$Module_Coordinator['gender']?>.png" class="card-img" alt="Profile Image">
                    <br> <br>
                    <h5 class="card-title text-center">@<?=$Module_Coordinator['user_name']?></h5>
                    <h3 class="card-title text-center"><?=$Module_Coordinator['role']?></h3>
                </div>
            </div>
                <div class="col-md-8 ">
                    <div class="card-body mb-0">
                        
                        <p class="list-group-item">First Name: <?=$Module_Coordinator['first_name']?></p>
                        <p class="list-group-item">Last Name: <?=$Module_Coordinator['last_name']?></p>
                        <p class="list-group-item">Username: <?=$Module_Coordinator['user_name']?></p>

                        <p class="list-group-item">Employee number: <?=$Module_Coordinator['idUtilisateur']?></p>
                        <p class="list-group-item">Address: <?=$Module_Coordinator['Address']?></p>
                        <p class="list-group-item">Date of birth: <?=$Module_Coordinator['date_birth']?></p>
                        <p class="list-group-item">Phone number: <?=$Module_Coordinator['phone_number']?></p>

                        <p class="list-group-item">Email address: <?=$Module_Coordinator['email']?></p>
                        <p class="list-group-item">Gender: <?=$Module_Coordinator['gender']?></p>


                       
                    </div>
                    <div class="card-body ">
            <a href="Module Coordinator.php" class="btn btn-secondary">Go Back</a>
                </div>
                
          </div>
           
        </div>
   
     
     </div>
     <?php 
        }else {
          header("Location: Module Coordinator.php");
          exit;
        }
     ?>
     
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