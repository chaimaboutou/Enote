<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['id_Module_Coordinator'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../Db_connection.php";
     include "data/Module Coordinator.php";

     $id = $_GET['id_Module_Coordinator'];
     if (removeModuleCoord($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: Module Coordinator.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: Module Coordinator.php?error=$em");
        exit;
     }


  }else {
    header("Location: Module Coordinator.php");
    exit;
  } 
}else {
	header("Location: Module Coordinator.php");
	exit;
} 