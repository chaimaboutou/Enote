<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['idmatiere'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../Db_connection.php";
     include "data/Subject.php";

     $id = $_GET['idmatiere'];
     if (removeSubject($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: Subject.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: Subject.php?error=$em");
        exit;
     }


  }else {
    header("Location: Subject.php");
    exit;
  } 
}else {
	header("Location: Subject.php");
	exit;
} 