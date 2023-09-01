<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['idFiliere']) &&
    isset($_POST['pname']) &&
    isset($_POST['Program_Coordinator'])) {
    
    include '../../Db_connection.php';
    

    $idFiliere = $_POST['idFiliere'];
    $name_prog = $_POST['pname'];
    $pc_prog = $_POST['Program_Coordinator'];

    $data = 'idFiliere='.urlencode($idFiliere);

    if (empty($idFiliere)) {
        $em  = "Id id is required";
        header("Location: ../Program-edit.php?error=$em&$data");
        exit;
    }else if (empty($name_prog)) {
        $em  = "Grade is required";
        header("Location: ../Program-edit.php?error=$em&$data");
        exit;
    }else if (empty($pc_prog)) {
        $em  = "Section is required";
        header("Location: ../Program-edit.php?error=$em&$data");
        exit;
    }else {
      $sql  = "UPDATE program SET  nom=?,idCoordFil=?
      WHERE idFiliere=?";
$stmt = $conn->prepare($sql);
$stmt->execute([ $name_prog,$pc_prog, $idFiliere]);
$sm = "Program updated successfully";
header("Location: ../Program-edit.php?success=$sm&$data");
exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Program.php?error=$em");
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