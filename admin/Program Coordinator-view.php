<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../Db_connection.php";
       include "data/Program Coordinator.php";
       
       if(isset($_GET['id_Program_Coord'])){

       
       $id_Program_Coord = $_GET['id_Program_Coord'];
       $Program_Coordinator = getProgramCoordById($id_Program_Coord , $conn);

        

       
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
        if ($Program_Coordinator != 0) {
     ?>
      <div class="container mt-2">
        <div class="card horizontal-card">
            <div class="row no-gutters">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div>
                    <img src="../img/<?=$Program_Coordinator['gender']?>.png" class="card-img" alt="Profile Image">
                    <br> <br>
                    <h5 class="card-title text-center">@<?=$Program_Coordinator['user_name']?></h5>
                    <h3 class="card-title text-center"><?=$Program_Coordinator['role']?></h3>
                </div>
            </div>
                <div class="col-md-8 ">
                    <div class="card-body mb-0">
                        
                        <p class="list-group-item">First Name: <?=$Program_Coordinator['first_name']?></p>
                        <p class="list-group-item">Last Name: <?=$Program_Coordinator['last_name']?></p>
                        <p class="list-group-item">Username: <?=$Program_Coordinator['user_name']?></p>

                        <p class="list-group-item">Employee number: <?=$Program_Coordinator['idUtilisateur']?></p>
                        <p class="list-group-item">Address: <?=$Program_Coordinator['Address']?></p>
                        <p class="list-group-item">Date of birth: <?=$Program_Coordinator['date_birth']?></p>
                        <p class="list-group-item">Phone number: <?=$Program_Coordinator['phone_number']?></p>

                        <p class="list-group-item">Email address: <?=$Program_Coordinator['email']?></p>
                        <p class="list-group-item">Gender: <?=$Program_Coordinator['gender']?></p>


                       
                    </div>
                    <div class="card-body ">
            <a href="Program Coordinator.php" class="btn btn-secondary">Go Back</a>
                </div>
                
          </div>
           
        </div>
   
     
     </div>
     <?php 
        }else {
          header("Location: Program Coordinator.php");
          exit;
        }
     ?>
     
     <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

    }else {
        header("Location: Program Coordinator.php");
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