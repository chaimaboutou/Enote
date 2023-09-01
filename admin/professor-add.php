<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../Db_connection.php";
    $id_professor ='';
    $fname ='';
    $lname = '';
    $uname =''; 
    $pn='' ;
    $email ='' ;
    $address ='' ;
    

       if (isset($_GET['id_professor'])) $id_professor = $_GET['id_professor'];
       if (isset($_GET['fname'])) $fname = $_GET['fname'];
       if (isset($_GET['lname'])) $lname = $_GET['lname'];
       if (isset($_GET['uname'])) $uname = $_GET['uname'];
       if (isset($_GET['pn'])) $pn = $_GET['pn'];
       if (isset($_GET['email'])) $email = $_GET['email'];
       if (isset($_GET['address'])) $address = $_GET['address'];
       
       
       
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENote</title>
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
    <script src ="../js/jquery-3.6.0.min.js"> </script>
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
     <div class="container mt-5">
        <a href="professor.php"
           class="btn btn-dark">Go Back</a>

           <form method="post" class="shadow p-3 mt-5 ms-5 form-w" action="req/professor-add.php">
    <h3>Add New Professor</h3>
    <hr>
    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?=$_GET['error']?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?=$_GET['success']?>
        </div>
    <?php } ?>

    <div class="mb-3">
        <label class="form-label">ID</label>
        <input type="text" class="form-control" value="<?=$id_professor?>" name="idUtilisateur" placeholder="p-number">
    </div>

    <div class="mb-3">
        <label class="form-label">First name</label>
        <input type="text" class="form-control" value="<?=$fname?>" name="fname">
    </div>

    <div class="mb-3">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control" value="<?=$lname?>" name="lname">
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="<?=$uname?>" name="username">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="pass" id="passInput">
            <button class="btn btn-secondary" id="gBtn">Random</button>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" value="<?=$address?>" name="address">
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" value="<?=$pn?>" name="phone_number">
    </div>

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" value="<?=$email?>" name="email">
    </div>

    <div class="mb-3">
        <label class="form-label">Gender</label><br>
        <input type="radio" value="Male" checked name="gender"> Male &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="Female" name="gender"> Female
    </div>

    <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control" value="" name="date_of_birth">
    </div>

    <button type="submit" class="btn btn-primary">Add Professor</button>
</form>

        
        

     
     </div>
     </div>
     
     <script src ="../js/all.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js"> </script>
<script src ="../js/bootstrap.bundle.min.js.map"> </script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * 
         charactersLength));

           }
           var passInput = document.getElementById('passInput');
           passInput.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(4);
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>