<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Professor') {
       include "../DB_connection.php";
       include "data/professor.php";
       

       $professor_id = $_SESSION['idUtilisateur'];
       $professor = getProfessorrById($professor_id, $conn);
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

        if ($professor != 0) {
     ?>
     <div class="container mt-0">
        <div class="card horizontal-card">
            <div class="row no-gutters">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div>
                    <img src="../img/<?=$professor['gender']?>.png" class="card-img" alt="Profile Image">
                    <br> <br>
                    <h5 class="card-title text-center">@<?=$professor['user_name']?></h5>
                    <h3 class="card-title text-center"><?=$professor['role']?></h3>
                </div>
            </div>
                <div class="col-md-7">
                    <div class="card-body">
                        
                        <p class="list-group-item">First Name: <?=$professor['first_name']?></p>
                        <p class="list-group-item">Last Name: <?=$professor['last_name']?></p>
                        <p class="list-group-item">Username: <?=$professor['user_name']?></p>

                        <p class="list-group-item">Employee number: <?=$professor['idUtilisateur']?></p>
                        <p class="list-group-item">Address: <?=$professor['Address']?></p>
                        <p class="list-group-item">Date of birth: <?=$professor['date_birth']?></p>
                        <p class="list-group-item">Phone number: <?=$professor['phone_number']?></p>

                        <p class="list-group-item">Email address: <?=$professor['email']?></p>
                        <p class="list-group-item">Gender: <?=$professor['gender']?></p>


                       
                    </div>
                    <div class="card-body ">
                    <a href="professor-edit.php?id_professor=<?=$professor['idUtilisateur']?>"
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