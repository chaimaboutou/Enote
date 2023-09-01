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
    isset($_POST['ProgramCoord_id'])&&
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
    $ProgramCoord_id = $_POST['ProgramCoord_id'];
    $year_id = $_POST['year_id'];


    // $data = 'id_fil=' . urlencode( $idFil) .
    // '$pro_name=' . urlencode($pname) ;

   
	if (empty($id_sub)) {
		$em  = "subject name is required";
		header("Location: ../session-add.php?error=$em");
		exit;

    }else if (empty($date  )) {
		$em  = "date  name is required";
		header("Location: ../session-add.php?error=$em");
		exit;
    }else if (empty($type  )) {
		$em  = "type  name is required";
		header("Location: ../session-add.php?error=$em");
		exit;
    }else if (empty($begin_hour )) {
		$em  = "begin hour  name is required";
		header("Location: ../session-add.php?error=$em");
		exit;
    }else if (empty($end_hour )) {
		$em  = "end hour  name is required";
		header("Location: ../session-add.php?error=$em");
		exit;
	}else {
        
        
       
          $sql  = "INSERT INTO
                 session(date,objectif,type,heureDebut,heureFin,listeAbsents,commentaire,idtilisateur,idmatiere,idannee)
                 VALUES(?,?,?,?,?,?,?,?,?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$date,$objective,$type,$begin_hour, $end_hour,$absentList,$commentaire,$ProgramCoord_id,$id_sub,$year_id]);
          
          
          $sm = "New session created successfully";
          header("Location: ../session-add.php?success=$sm");
          exit;
        
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