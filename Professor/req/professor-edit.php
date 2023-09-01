<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Professor') {
    	

if (isset($_POST['idUtilisateur']) &&
    isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    
    
    isset($_POST['address'])  &&
    isset($_POST['phone_number'])  &&
    isset($_POST['email']) &&
    
    isset($_POST['gender'])&
    isset($_POST['date_of_birth']) ) {
    
    include '../../Db_connection.php';
    include "../data/professor.php";

    $idUtilisateur = $_POST['idUtilisateur'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    
    $address = $_POST['address']; 
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    
    
    
    $data = 'id_professor=' . urlencode($idUtilisateur) .
    '&uname=' . urlencode($username) .
    '&fname=' . urlencode($fname) .
    '&lname=' . urlencode($lname) .
    '&address=' . urlencode($address) .
    '&pn=' . urlencode($phone_number) .
    '&email=' . urlencode($email);
    // $data = '$id_professor='.$idUtilisateur.'$uname='.$username.'$fname='.$fname.'&lname='.$lname.'&address='.$address.'&pn='.$phone_number.'email='.$email;

    if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../professor-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Last name is required";
		header("Location: ../professor-edit.php?error=$em&$data");
		exit;
	}else if (empty($username)) {
		$em  = "Username is required";
		header("Location: ../professor-edit.php?error=$em&$data");
		exit;
	
	}else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../professor-edit.php?error=$em&$data");
        exit;
    }else if (empty($idUtilisateur)) {
        $em  = "Employee number is required";
        header("Location: ../professor-edit.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em  = "Phone number is required";
        header("Location: ../professor-edit.php?error=$em&$data");
        exit;
    
    }else if (empty($email)) {
        $em  = "Email address is required";
        header("Location: ../professor-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender address is required";
        header("Location: ../professor-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth address is required";
        header("Location: ../professor-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE user SET
                first_name=?, last_name=?, user_name=?, email=?,
                Address = ?, phone_number=?, date_birth = ?, gender = ?
                WHERE idUtilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fname, $lname , $username, $email, $address, $phone_number, $date_of_birth, $gender,$idUtilisateur]);
      
      
        $sm = "successfully updated!";
        header("Location: ../professor-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../index.php?error=$em");
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