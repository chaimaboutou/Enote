<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Professor') {
    	

if (
    isset($_POST['subject'])&&
    isset($_POST['date'])&&
    isset($_POST['type'])&&
    isset($_POST['beginhour'])&&
    isset($_POST['endhour'])&&
    isset($_POST['objective'])&&
    isset($_POST['Absentlist'])&&
    
    isset($_POST['commentaire'])&&
    isset($_POST['prof_id'])&&
    isset($_POST['year_id'])
    ) {
    
    include '../../Db_connection.php';
    

    
    $id_sub = $_POST['subject'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $begin_hour = $_POST['beginhour'];
    $end_hour = $_POST['endhour'];
    $absentList = $_POST['Absentlist'];
    $objective = $_POST['objective'];
    $commentaire = $_POST['commentaire'];
    $prof_id = $_POST['prof_id'];
    $year_id = $_POST['year_id'];


    $data = 'prof_id=' . urlencode( $prof_id)  ;

   
	if (empty($id_sub)) {
		$em  = "Subject name is required";
		header("Location: ../session-add.php?error=$em");
		exit;

    }else if (empty($date  )) {
		$em  = "Date is required";
		header("Location: ../session-add.php?error=$em");
		exit;
    }else if (empty($type  )) {
		$em  = "Type is required";
		header("Location: ../session-add.php?error=$em");
		exit;
    }else if (empty($begin_hour )) {
		$em  = "Begin hour is required";
		header("Location: ../session-add.php?error=$em");
		exit;
    }else if (empty($end_hour )) {
		$em  = "End hour is required";
		header("Location: ../session-add.php?error=$em");
		exit;
	}else {
        // check if the class already exists
        $sql_check = "SELECT * FROM session 
                      WHERE idseance=? ";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$id_session]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "The session id already exists";
           header("Location: ../session-add.php?error=$em");
           exit;
        }else {
          $sql  = "INSERT INTO
                 session(date,objectif,type,heureDebut,heureFin,listeAbsents,commentaire,idtilisateur,idmatiere,idannee)
                 VALUES(?,?,?,?,?,?,?,?,?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$date,$objective,$type,$begin_hour, $end_hour,$absentList,$commentaire,$prof_id,$id_sub,$year_id]);
          
          
          $sm = "New session created successfully";
          header("Location: ../session-add.php?success=$sm");
          exit;
        } 
	}
    
  }else {
    
    $em = "An error occurred: " ;
    header("Location: ../session-add.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 