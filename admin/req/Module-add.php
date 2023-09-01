<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (
    isset($_POST['mname'])&&
    isset($_POST['Module_Coordinator']) &&
    isset($_POST['program'])
    ) {
    
    include '../../Db_connection.php';
    

    
    $name = $_POST['mname'];
    $MCoord = $_POST['Module_Coordinator'];
    $program = $_POST['program'];


    

   if (empty($name)) {
		$em  = "Module name is required";
		header("Location: ../Module-add.php?error=$em");
		exit;

    }else if (empty($MCoord )) {
		$em  = "Module Coordinator name is required";
		header("Location: ../Module-add.php?error=$em");
		exit;
    }else if (empty($program)) {
		$em  = "Program  name is required";
		header("Location: ../Module-add.php?error=$em");
		exit;
	}else {
        // check if the class already exists
        $sql_check = "SELECT * FROM module 
                      WHERE  nom=? and idFiliere=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$name,$program]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "The module already exists";
           header("Location: ../Module-add.php?error=$em");
           exit;
        }else {
          $sql  = "INSERT INTO
                 module(nom,idFiliere,idCoordMod)
                 VALUES(?,?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$name,$program, $MCoord]);
          $sm = "New module created successfully";
          header("Location: ../Module-add.php?success=$sm");
          exit;
        } 
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Module-add.php?error=$em");
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