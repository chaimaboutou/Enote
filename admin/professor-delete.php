<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['id_professor'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../Db_connection.php";
     include "data/professor.php";

     $id = $_GET['id_professor'];
     if (removeProfessor($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: professor.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: professor.php?error=$em");
        exit;
     }


  }else {
    header("Location: professor.php");
    exit;
  } 
}else {
	header("Location: professor.php");
	exit;
} 