<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['idseance'])) {

  if ($_SESSION['role'] == 'Professor') {
     include "../Db_connection.php";
     include "data/session.php";

     $id = $_GET['idseance'];
     if (removeSession($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: session.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: session.php?error=$em");
        exit;
     }


  }else {
    header("Location: session.php");
    exit;
  } 
}else {
	header("Location: session.php");
	exit;
} 