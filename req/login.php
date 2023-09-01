<?php 
session_start();

if (
    isset($_POST['user_name'])&&
    isset($_POST['pass']) &&
    isset($_POST['role'])) {

	include "../Db_connection.php";
	
	$uname = $_POST['user_name'];
	$pass = $_POST['pass'];
	$role = $_POST['role'];

	if (empty($uname)) {
		$em  = "User name name is required";
		header("Location: ../login.php?error=$em");
		exit;
    
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../login.php?error=$em");
		exit;
	}else if (empty($role)) {
		$em  = "An error Occurred";
		header("Location: ../login.php?error=$em");
		exit;
	}else {
        
        if($role == '1'){
        	
        	$role = "Admin";
        }else if($role == '2'){
        	
        	$role = "Professor";
        }else if($role == '3'){
        	
        	$role = "Module Coordinator";
        }else if($role == '4'){
        	
        	$role = "Program Coordinator";
        }

		$sql = "SELECT * FROM user WHERE user_name=? AND role=? ";
		$stmt = $conn->prepare($sql);
		
		
        $stmt->execute([$uname,$role]);

        if ($stmt->rowCount() >0) {
        	$user = $stmt->fetch();
        	
			$username = $user['user_name'];
        	$password = $user['password'];
			$password = password_hash($password , PASSWORD_DEFAULT);
        	
            if ($uname === $username ) {
            	 if (password_verify($pass, $password)) {
            		$_SESSION['role'] = $role;
            		if ($role == 'Admin') {
                        $id = $user['idUtilisateur'];
                        $_SESSION['idUtilisateur'] = $id;
                        header("Location: ../admin/index.php");
                        exit;
                    }else if ($role == 'Professor') {
                        $id = $user['idUtilisateur'];
                        $_SESSION['idUtilisateur'] = $id;
                        header("Location: ../Professor/index.php");
                        exit;
                    }else if ($role == 'Module Coordinator') {
                        $id = $user['idUtilisateur'];
                        $_SESSION['idUtilisateur'] = $id;
                        header("Location: ../Module Coordinator/index.php");
                        exit;
                    }else if($role == 'Program Coordinator'){
                    	$id = $user['idUtilisateur'];
                        $_SESSION['idUtilisateur'] = $id;
                        header("Location: ../Program Coordinator/index.php");
                        exit;
                    }else {
                    	$em  = "Incorrect  name or password .Please try again .";
				        header("Location: ../login.php?error=$em");
				        exit;
                    }
				    
            	}else {
		        	$em  = "Incorrect Username or Password";
				    header("Location: ../login.php?error=$em");
				    exit;
		        }
            }else {
	        	$em  = "Incorrect Username ";
			    header("Location: ../login.php?error=$em");
			    exit;
	        }
         }else {
         	$em  = "Incorrect Username or Password ";
		     header("Location: ../login.php?error=$em");
		    exit;
         }
	}


}else{
	header("Location: ../login.php");
	exit;
}