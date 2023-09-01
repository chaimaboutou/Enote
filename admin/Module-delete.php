<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['idmodule'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../Db_connection.php";
     include "data/Module.php";

     $id = $_GET['idmodule'];
     if (removeModule($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: Module.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: Module.php?error=$em");
        exit;
     }


  }else {
    header("Location: Module.php");
    exit;
  } 
}else {
	header("Location: Module.php");
	exit;
} 