<?php 
session_start();
if (isset($_SESSION['idUtilisateur']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['id_professor'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../Db_connection.php";
       include "data/professor.php";
       
       
       $id_professor = $_GET['id_professor'];
       $professor = getProfessorrById($id_professor, $conn);

       if ($professor == 0) {
        
         header("Location: professor.php");
         exit;
       }


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

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/professor-edit.php">
        <h3>Edit Professor</h3><hr>
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
    <input type="text" class="form-control" value="<?=$professor['idUtilisateur']?>" name="idUtilisateur" readonly>
</div>


    <div class="mb-3">
        <label class="form-label">First name</label>
        <input type="text" class="form-control" value="<?=$professor['first_name']?>" name="fname">
    </div>

    <div class="mb-3">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control" value="<?=$professor['last_name']?>" name="lname">
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="<?=$professor['user_name']?>" name="username">
    </div>


    <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" value="<?=$professor['Address']?>" name="address">
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" value="<?=$professor['phone_number']?>" name="phone_number">
    </div>

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" value="<?=$professor['email']?>" name="email">
    </div>

    <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <input type="radio"
                 value="Male"
                 <?php if($professor['gender'] == 'Male') echo 'checked';  ?> 
                 name="gender"> Male
                 &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio"
                 value="Female"
                 <?php if($professor['gender'] == 'Female') echo 'checked';  ?> 
                 name="gender"> Female
        </div>

    <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control" value="<?=$professor['date_birth']?>" name="date_of_birth">
    </div>

    


      <button type="submit" 
              class="btn btn-primary">
              Update</button>
     </form>

     <form method="post"
              class="shadow p-3 my-5 form-w" 
              action="req/professor-change.php"
              id="change_password">
        <h3>Change Password</h3><hr>
          <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
             <?=$_GET['perror']?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
             <?=$_GET['psuccess']?>
            </div>
          <?php } ?>

       <div class="mb-3">
            <div class="mb-3">
            <label class="form-label">Admin password</label>
                <input type="password" 
                       class="form-control"
                       name="admin_pass"> 
          </div>

            <label class="form-label">New password </label>
            <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="new_pass"
                       id="passInput">
                <button class="btn btn-secondary"
                        id="gBtn">
                        Random</button>
            </div>
            
          </div>
          <input type="text"
                value="<?=$professor['idUtilisateur']?>"
                name="id_professor"
                hidden>

          <div class="mb-3">
            <label class="form-label">Confirm new password  </label>
                <input type="text" 
                       class="form-control"
                       name="c_new_pass"
                       id="passInput2"> 
          </div>
          <button type="submit" 
              class="btn btn-primary">
              Change</button>
        </form>
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
           var passInput2 = document.getElementById('passInput2');
           passInput.value = result;
           passInput2.value = result;
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
    
    header("Location: professor.php");
    
    exit;
  } 
}else {
  
	header("Location: professor .php");
  
	exit;
} 

?>