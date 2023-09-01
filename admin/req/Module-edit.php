<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['idmodule']) &&
    isset($_POST['mname']) &&
    isset($_POST['Module_Coordinator'])&&
    isset($_POST['program'])) {
    
    include '../../Db_connection.php';
    

    $idMod = $_POST['idmodule'];
    $name_mod = $_POST['mname'];
    $mc_prog = $_POST['Module_Coordinator'];
    $program = $_POST['program'];

    // $data = 'idmodule='.$idmodule;
    $data = 'idmodule='.urlencode($idMod);

    if (empty($name_mod)) {
        $em  = "Module name id is required";
        header("Location: ../Module-edit.php?error=$em&$data");
        exit;
    }else if (empty($mc_prog)) {
        $em  = "Module Coordinator name is required";
        header("Location: ../Module-edit.php?error=$em&$data");
        exit;
    }else if (empty($program)) {
        $em  = "Module name is required";
        header("Location: ../Module-edit.php?error=$em&$data");
        exit;
    }else {
      $sql  = "UPDATE module SET  nom=?,idFiliere=?,idCoordMod=?
      WHERE idmodule=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name_mod, $program,$mc_prog,$idMod]);
    $sm = "Module updated successfully";
    header("Location: ../Module-edit.php?success=$sm&$data");
    exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Module.php?error=$em");
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