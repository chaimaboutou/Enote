<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['idSubject']) &&
    isset($_POST['sname']) &&
    isset($_POST['module'])) {
    
    include '../../Db_connection.php';
    

    $idSub = $_POST['idSubject'];
    $name_sub = $_POST['sname'];
    $module = $_POST['module'];

    // $data = 'idmatiere='.$idmatiere;
    $data = 'idmatiere='.urlencode($idSub);

    if (empty($idSub)) {
        $em  = "Subject name id is required";
        header("Location: ../Subject-edit.php?error=$em&$data");
        exit;
    }else if (empty($name_sub)) {
        $em  = "Subject  name is required";
        header("Location: ../Subject-edit.php?error=$em&$data");
        exit;
    }else if (empty($module)) {
        $em  = "Module name is required";
        header("Location: ../Subject-edit.php?error=$em&$data");
        exit;
    }else {
      $sql  = "UPDATE subject SET  nom=?,idmodule=?
      WHERE idmatiere=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name_sub, $module,$idSub]);
    $sm = "Subject updated successfully";
    header("Location: ../Subject-edit.php?success=$sm&$data");
    exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Subject.php?error=$em");
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