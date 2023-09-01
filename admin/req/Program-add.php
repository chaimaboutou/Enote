<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (
    isset($_POST['pname'])&&
    isset($_POST['Program_Coordinator'])
    ) {
    
    include '../../Db_connection.php';
    include "../data/Program.php";

    
    $name = $_POST['pname'];
    $PCoord = $_POST['Program_Coordinator'];

    // $data = 'id_fil=' . urlencode( $idFil) .
    // '$pro_name=' . urlencode($pname) ;

    if (empty($name)) {
		$em  = "Program name is required";
		header("Location: ../Program-add.php?error=$em");
		exit;

    }else if (empty($PCoord)) {
		$em  = "Program Coordinator name is required";
		header("Location: ../Program-add.php?error=$em");
		exit;
	}else {
        // check if the class already exists
        $sql_check = "SELECT * FROM program 
                      WHERE  nom=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$name]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "The program already exists";
           header("Location: ../Program-add.php?error=$em");
           exit;
        }else {
          $sql  = "INSERT INTO
                 program(nom,idCoordFil)
                 VALUES(?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$name, $PCoord]);
          $sm = "New program created successfully";
          header("Location: ../Program-add.php?success=$sm");
          exit;
        } 
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Program-add.php?error=$em");
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