<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Program Coordinator') {
       include "../Db_connection.php";
       include "data/setting.php";
       include "data/professor.php";
       include "data/annee.php";
       include "data/session.php";
       include "data/Subject.php";
       include "data/Module.php";
       include "data/Program.php";

       $setting=getSetting($conn);
       $current_year =getCurrentYear($setting['currentCYear'], $conn);
       $id_year=$current_year['idannee'];

       
       if(isset($_GET['idseance'])){

       $id_session = $_GET['idseance'];

       $session=getSessiontById($id_session, $conn);
       $professor=getUserById($session['idtilisateur'], $conn);
       $subject=getSubjectById($session['idmatiere'], $conn);
       $module=getModuleById($subject['idmodule'], $conn);
       $program=getProgramById($module['idFiliere'], $conn);



      
       
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
    <link rel="stylesheet" href="../css/style2.css">
	<link rel="icon" href="../img/logo.png">
    <script src ="../js/jquery-3.6.0.min.js"> </script>

</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($professor != 0) {
     ?>
     <div class="centered">
  <div class="card custom-card mt-5 elegant-card larger-card">
    <div class="card-body">
      <h5 class="card-title mb-4">Session Details</h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <strong class="label">Professor:</strong>
          <span class="value"><?=$professor['last_name'].' '.$professor['first_name']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Subject:</strong>
          <span class="value"><?=$subject['nom']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Module:</strong>
          <span class="value"><?=$module['nom']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Program:</strong>
          <span class="value"><?=$program['nom']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Date:</strong>
          <span class="value"><?=$session['date']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Type:</strong>
          <span class="value"><?=$session['type']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Beginning Hour:</strong>
          <span class="value"><?=$session['heureDebut']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">End Hour:</strong>
          <span class="value"><?=$session['heureFin']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Objective:</strong>
          <span class="value"><?=$session['objectif']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Absent List:</strong>
          <span class="value"><?=$session['listeAbsents']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">Commentaire:</strong>
          <span class="value"><?=$session['commentaire']?></span>
        </li>
        <li class="list-group-item">
          <strong class="label">College Year:</strong>
          <span class="value"><?=$current_year['nom']?></span>
        </li>
      </ul>
    </div>
    <div class="card-footer">
      <a href="session-program.php" class="btn btn-secondary">Go Back</a>
    </div>
  </div>
</div>

     

     <?php 
        }else {
          header("Location: sesssion_module.php");
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
        header("Location: session_module.php");
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