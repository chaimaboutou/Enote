<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['school_name']) &&
    
    isset($_POST['current_year'])) {
    
    include '../../Db_connection.php';

    $school_name = $_POST['school_name'];
    $current_year = $_POST['current_year'];
    

   

    if (empty($school_name)) {
        $em  = "School name is required";
        header("Location: ../settings.php?error=$em");
        exit;
    
    }else if (empty($current_year)) {
        $em  = "Current year name is required";
        header("Location: ../settings.php?error=$em");
        exit;
    
    }else {
//         $id = 1;
//         $sql  = "UPDATE setting 
//         SET schoolName=?, currentCYear=?
//         WHERE id=?";
// $stmt = $conn->prepare($sql);
// $stmt->execute([$school_name, $current_year, $id]);
//         $sm = "Settings updated successfully";
//         header("Location: ../settings.php?success=$sm&$data");
//         exit;

        // Update the setting table
        $id = 1;
$updateSql = "UPDATE setting 
SET schoolName=?, currentCYear=?
WHERE id=?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->execute([$school_name, $current_year, $id]);

// Insert into the collegeYear table
$insertSql = "INSERT INTO collegeyear (nom) VALUES (?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->execute([$current_year]);
$sm = "Settings updated successfully";
        header("Location: ../settings.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../index.php?error=$em");
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