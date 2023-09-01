<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENote</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/logo.png">
</head>
<body class="body-login">
<br /> <br />
    	<div class="d-flex justify-content-center align-items-center flex-column">
    	<form class="login" 
    	      method="post"
    	      action="req/login.php">

    		<div class="text-center">
    			<img src="img/logo.png"
    			     width="100">
    		</div>
    		<h3>LOGIN</h3>
    		<?php if (isset($_GET['error'])) { ?>
    		<div class="alert alert-danger" role="alert">
			  <?=$_GET['error']?>
			</div>
			<?php } ?>
		  <div class="mb-3">
		    <label class="form-label">User Name</label>
		    <input type="text" 
		           class="form-control"
		           name="user_name">
		  </div>
		  
		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="pass">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Login As</label>
		    <select class="form-control"
		            name="role">
		    	<option value="1">Admin</option>
		    	<option value="2">Professor</option>
		    	<option value="3">Module Coordinator</option>
		    	<option value="4">Program Coordinator</option>
		    </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Login</button>
		  <a href="index.php" class="text-decoration-none">Home</a>
		</form>
        
        <br /><br />
        <div class="text-center text-light">
        	Copyright &copy; 2023 Enote. All rights reserved.
        </div>

    	
    </div>

	
        	


        
</div>
	

		
		




<script src ="js/all.min.js"> </script>
<script src ="js/bootstrap.bundle.min.js"> </script>
<script src ="js/bootstrap.bundle.min.js.map"> </script>
</body>
</html>