<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
      include "../Db_connection.php";
      include "data/professor.php";
      include "data/Module Coordinator.php";
      include "data/Program Coordinator.php";
      include "data/Subject.php";
      include "data/Module.php";
      include "data/Program.php";



      $professor_number=countProfessors($conn);
      $ModCoord_number=countModuleCoords($conn);
      $ProgramCoord_number=countProgramCoords($conn);
      $subject_number=countsubject($conn);
      $module_number=countmodule($conn);
      $program_number=countprogram($conn);
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
<body >
<?php 
        include "inc/navbar.php";
     ?>

<div class="container mt-5">
         <div class="container text-center">
             <div class="row row-cols-4">
             <a href="professor.php" class="col btn btn-dark m-4 py-3">
            <span class="fs-1 pr-2"><?=$professor_number?></span>
            <i class="fa-solid fa-chalkboard-user fs-1" aria-hidden="true"></i>
            <br>
            Professors
          </a>

               <a href="Module Coordinator.php" class="col btn btn-dark m-4 py-3">
               <span class="fs-1 pr-2"><?=$ModCoord_number?></span>
                 <i class="fa-solid fa-address-book fs-1" aria-hidden="true"></i><br>
                 Module Coordinators
               </a> 

               <a href="Program Coordinator.php" class="col btn btn-dark m-4 py-3">
               <span class="fs-1 pr-2"><?=$ProgramCoord_number?></span>
                 <i class="fa-solid fa-street-view fs-1" aria-hidden="true"></i><br>
                 Program Coordinators
               </a> 

               <a href="subject.php" class="col btn btn-dark m-4 py-3">
              <span class="fs-1 pr-2"><?=$subject_number?></span>
                 <i class="fa-solid fa-microscope fs-1" aria-hidden="true"></i><br>
                 Subjects
               </a> 

               <a href="module.php" class="col btn btn-dark m-4 py-3">
              <span class="fs-1 pr-2"><?=$module_number?></span>
                 <i class="fa-solid fa-book-open-reader fs-1" aria-hidden="true"></i><br>
                  Modules
               </a> 

               <a href="program.php" class="col btn btn-dark m-4 py-3">
               <span class="fs-1 pr-2"><?=$program_number?></span>
                 <i class="fa fa-book fs-1" aria-hidden="true"></i><br>
                 Programs
               </a> 

               <a href="message.php" class="col btn btn-success m-4 py-3">
                 <i class="fa-solid fa-message fs-1" aria-hidden="true"></i><br>
                 Messages
               </a> 
               
               <a href="settings.php" class="col btn btn-primary m-4 py-3 ">
                 <i class="fa fa-cogs fs-1" aria-hidden="true"></i><br>
                  Settings
               </a> 
               <a href="../logout.php" class="col btn btn-warning m-4 py-3 ">
                 <i class="fa fa-sign-out fs-1" aria-hidden="true"></i><br>
                  Logout
               </a> 
             </div>
         </div>
     </div>

		
		




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