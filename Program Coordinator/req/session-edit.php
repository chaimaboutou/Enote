<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Program Coordinator') {
    	

if (
    isset($_POST['subject'])&&
    isset($_POST['date'])&&
    isset($_POST['type'])&&
    isset($_POST['beginhour'])&&
    isset($_POST['endhour'])&&
    isset($_POST['objective'])&&
    isset($_POST['Absentlist'])&&
    isset($_POST['commentaire'])&&

    isset($_POST['idsession'])
    
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
    
    $session_id = $_POST['idsession'];
    
    $data = 'idseance='.urlencode($session_id);
    
   

   
	if (empty($id_sub)) {
		$em  = "subject name is required";
		header("Location: ../session-edit.php?error=$em&$data");
		exit;

    }else if (empty($date  )) {
		$em  = "date  name is required";
		header("Location: ../session-edit.php?error=$em&$data");
		exit;
    }else if (empty($type  )) {
		$em  = "type  name is required";
		header("Location: ../session-edit.php?error=$em&$data");
		exit;
    }else if (empty($begin_hour )) {
		$em  = "begin hour  name is required";
		header("Location: ../session-edit.php?error=$em&$data");
		exit;
    }else if (empty($end_hour )) {
		$em  = "end hour  name is required";
		header("Location: ../session-edit.php?error=$em&$data");
		exit;
	}else {
    
    $sql = "UPDATE session SET date=?, objectif=?, type=?, heureDebut=?, heureFin=?, listeAbsents=?, commentaire=?, idmatiere=?
    WHERE idseance=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$date, $objective, $type, $begin_hour, $end_hour, $absentList, $commentaire, $id_sub, $session_id]);

         
          
          
          $sm = " session updute successfully";
          header("Location: ../session-edit.php?success=$sm&$data");
          exit;
        
	}
    
  }else {
    
    $em = "An error occurred: " ;
    header("Location: ../session-edit.php?error=$em");
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