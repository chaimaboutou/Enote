<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['idFiliere'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../Db_connection.php";
     include "data/Program.php";

     $id = $_GET['idFiliere'];
     if (removeProgram($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: Program.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: Program.php?error=$em");
        exit;
     }


  }else {
    header("Location: Program.php");
    exit;
  } 
}else {
	header("Location: Program.php");
	exit;
} 