<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['id_Program_Coord'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../Db_connection.php";
     include "data/Program Coordinator.php";

     $id = $_GET['id_Program_Coord'];
     if (removeProgramCoord($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: Program Coordinator.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: Program Coordinator.php?error=$em");
        exit;
     }


  }else {
    header("Location: Program Coordinator.php");
    exit;
  } 
}else {
	header("Location: Program Coordinator.php");
	exit;
} 