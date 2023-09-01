<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Module Coordinator') {
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

       $id_ModCoord =$_SESSION['idUtilisateur'] ;

       $moduleOfCords =getModulesByIdCoordModule($id_ModCoord, $conn);
      
       



$sessions = [];


foreach ($moduleOfCords as $moduleOfCord) {
    $module_subjects = getSubjectOfModule($moduleOfCord['idmodule'], $conn);
    
    foreach ($module_subjects as $subject) {
        $module_sessions = getSessionsOfYearBySubject($id_year, $subject['idmatiere'], $conn);
        $sessions = array_merge($sessions, $module_sessions);
    }
}

       



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
        <h3>College Year : <?=$current_year['nom']?></h3>
        <br> <br>

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
            <?php  if ($sessions != 0) { ?>
           <div class="table-responsive">
              <table class="table table-bordered mt-0 n-table" ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    
                    <th scope="col">Subject name</th>
                    <th scope="col">type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Module name</th>
                    <th scope="col">Program name</th>
                    <th scope="col">Professor name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($sessions as $session ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    
                    <td>
                      <?php 
                          $subject  = getSubjectById($session['idmatiere'], $conn) ;
                          echo $subject['nom'];
                       ?>
                    </td>
                    <td><?=$session['type']?></td>
                    
                    
                    <td><?=$session['date']?></td>
                    <td>
                      <?php 
                          $module  = getModuleById($subject['idmodule'], $conn) ;
                          
                          echo $module['nom'];
                       ?>
                    </td>
                    
                    <td>
                      <?php 
                          $program  = getProgramById($module['idFiliere'], $conn) ;
                          echo $program['nom'];
                       ?>
                    </td>
                    <td>
                      <?php 
                          $professor  = getUserById($session['idtilisateur'], $conn) ;
                          echo $professor['last_name'].' '.$professor['first_name'];
                       ?>
                    </td>
                    <td>
                        <a href="session-view.php?idseance=<?=$session['idseance']?>"
                           class="btn btn-primary">View</a>
                        
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
           </div>
         
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
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>