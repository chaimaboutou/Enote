<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Professor') {
    	

    if (isset($_POST['professor_pass']) &&
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) &&
    isset($_POST['id_professor'])) {
    
    include '../../Db_connection.php';
    include "../data/professor.php";
    

    $professor_pass = $_POST['professor_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $id_professor = $_POST['id_professor'];
    $id = $_SESSION['idUtilisateur'];
    
    // $data = 'teacher_id='.$teacher_id.'#change_password';
    $data = 'id_professor=' . urlencode($id_professor) . '#change_password';

    if (empty($professor_pass)) {
		$em  = " password is required";
		header("Location: ../professor-edit.php?perror=$em&$data");
		exit;
	}else if (empty($new_pass)) {
		$em  = "New password is required";
		header("Location: ../professor-edit.php?perror=$em&$data");
		exit;
	}else if (empty($c_new_pass)) {
		$em  = "Confirmation password is required";
		header("Location: ../professor-edit.php?perror=$em&$data");
		exit;
	}else if ($new_pass !== $c_new_pass) {
        $em  = "New password and confirm password does not match";
        header("Location: ../professor-edit.php?perror=$em&$data");
        exit;
    }else if (!professorPasswordVerify($professor_pass, $conn, $id)) {
        $em  = "Incorrect password";
        header("Location: ../professor-edit.php?perror=$em&$data");
        exit;
    }else {
        // hashing the password
        // $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET
                password = ?
                WHERE idUtilisateur=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $id_professor]);
        $sm = "The password has been changed successfully!";
        header("Location: ../professor-edit.php?psuccess=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../professor-edit.php?error=$em&$data");
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