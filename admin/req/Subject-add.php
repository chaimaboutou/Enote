<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (
    isset($_POST['sname'])&&
    isset($_POST['Module'])
    ) {
    
    include '../../Db_connection.php';
    

    
    $name = $_POST['sname'];
    $Module = $_POST['Module'];



    if (empty($name)) {
		$em  = "Subject name is required";
		header("Location: ../Subject-add.php?error=$em");
		exit;

    }else if (empty($Module  )) {
		$em  = "Module  name is required";
		header("Location: ../Subject-add.php?error=$em");
		exit;
	}else {
        // check if the class already exists
        $sql_check = "SELECT * FROM subject 
                      WHERE  nom=? and idmodule=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$name,$Module]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "The subject already exists";
           header("Location: ../Subject-add.php?error=$em");
           exit;
        }else {
          $sql  = "INSERT INTO
                 subject(nom,idmodule)
                 VALUES(?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$name,$Module]);
          $sm = "New subject created successfully";
          header("Location: ../Subject-add.php?success=$sm");
          exit;
        } 
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Subject-add.php?error=$em");
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