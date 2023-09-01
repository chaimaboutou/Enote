<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Module Coordinator') {
        include "../Db_connection.php";
       include "data/setting.php";
       include "data/annee.php";
       include "data/Subject.php";
       include "data/Module.php";
       include "data/Program.php";
       include "data/session.php";


       $id_ModCoord=$_SESSION['idUtilisateur'];

       $setting=getSetting($conn);
       $current_year =getCurrentYear($setting['currentCYear'], $conn);
       $id_year=$current_year['idannee'];
       
        $subjects =getAllSubjects($conn);
        $modules=getAllModules($conn);
        $programs=getAllPrograms($conn);

        $id=$_GET['idseance'];
        $session=getSessiontById($id, $conn);

        if ($session == 0) {
        
            header("Location: session.php");
            
            exit;
         }

       
    
    

    //    if (isset($_GET['$id_fil'])) $id_fil = $_GET['$id_fil'];
    //    if (isset($_GET['$pro_name'])) $fname = $_GET['$pro_name'];
       
       

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
        <a href="session.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/session-edit.php">
        <h3>View session</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>

        <div class="mb-3">
          <label class="form-label">Subject</label>
          <select name="subject"
                  class="form-control" >
                  <?php foreach ( $subjects as $subject) { 
                     $selected = 0;
                     if ($subject['idmatiere'] == $session['idmatiere'] ) {
                       $selected = 1;
                     }
                  ?>

                    <option  value="<?=$subject['idmatiere']?>"
                          <?php if ($selected) echo "selected"; ?> >
                          <?=$subject['nom']?>
                    </option> 
                  <?php } ?>
                  
          </select>
        </div>

        

       

        <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" class="form-control"  value="<?=$session['date']?>" name="date">
        </div>

        <div class="mb-3">
          <label class="form-label">Type</label><br>
          <input type="radio"
                 value="Course"
                 <?php if($session['type'] == 'Course') echo 'checked';  ?> 
                 name="type"> Course
                 &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio"
                 value="TP"
                 <?php if($session['type'] == 'TP') echo 'checked';  ?> 
                 name="type"> TP
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="radio"
                 value="TD"
                 <?php if($session['type'] == 'TD') echo 'checked';  ?> 
                 name="type"> TD

        </div>
        

    <div class="mb-3">
        <label class="form-label">Beginning hour</label>
        <input type="text" class="form-control" value="<?=$session['heureDebut']?>" name="beginhour">
        </div>

        <div class="mb-3">
        <label class="form-label">End hour</label>
        <input type="text" class="form-control" value="<?=$session['heureFin']?>"  name="endhour">
        </div>

        <div class="mb-3">
        <label class="form-label">objective</label>
        <input type="text" class="form-control" value="<?=$session['objectif']?>"  name="objective">
        </div>

        <div class="mb-3">
        <label class="form-label">Absent list</label>
        <textarea class="form-control"  name="Absentlist" rows="4"><?=$session['listeAbsents']?></textarea>
        </div>

        <div class="mb-3">
    <label class="form-label">commentaire</label>
    <textarea class="form-control" name="commentaire" rows="4"><?=$session['commentaire']?></textarea>
</div>

    
<input type="number" 
                 class="form-control"
                 value="<?=$id?>"
                 name="idsession"
                 hidden>
   
    
       
        
      <button type="submit" class="btn btn-primary">Update</button>
     </form>
     </div>
     
     <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
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