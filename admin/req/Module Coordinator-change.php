<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

    if (isset($_POST['admin_pass']) &&
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) &&
    isset($_POST['id_Module_Coordinator'])) {
    
    include '../../Db_connection.php';
    include "../data/Module Coordinator.php";
    include "../data/admin.php";

    $admin_pass = $_POST['admin_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $id_Module_Coordinator = $_POST['id_Module_Coordinator'];
    $id = $_SESSION['idUtilisateur'];
    
    // $data = 'teacher_id='.$teacher_id.'#change_password';
    $data = 'id_Module_Coordinator=' . urlencode($id_Module_Coordinator) . '#change_password';

    if (empty($admin_pass)) {
		$em  = "Admin password is required";
		header("Location: ../Module Coordinator-edit.php?perror=$em&$data");
		exit;
	}else if (empty($new_pass)) {
		$em  = "New password is required";
		header("Location: ../Module Coordinator-edit.php?perror=$em&$data");
		exit;
	}else if (empty($c_new_pass)) {
		$em  = "Confirmation password is required";
		header("Location: ../Module Coordinator-edit.php?perror=$em&$data");
		exit;
	}else if ($new_pass !== $c_new_pass) {
        $em  = "New password and confirm password does not match";
        header("Location: ../Module Coordinator-edit.php?perror=$em&$data");
        exit;
    }else if (!adminPasswordVerify($admin_pass, $conn, $id)) {
        $em  = "Incorrect admin password";
        header("Location: ../Module Coordinator-edit.php?perror=$em&$data");
        exit;
    }else {
        // hashing the password
        // $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET
                password = ?
                WHERE idUtilisateur=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $id_Module_Coordinator]);
        $sm = "The password has been changed successfully!";
        header("Location: ../Module Coordinator-edit.php?psuccess=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Module Coordinator-edit.php?error=$em&$data");
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