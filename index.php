<?php 
include "Db_connection.php";
include "data/setting.php";
$setting = getSetting($conn);

if ($setting != 0) {

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
<body class="body-home">
<br /> <br /> 
<div class="container"> 
	<nav class="navbar navbar-expand-lg bg-light" id="homeNav">
		  <div class="container-fluid">
		    <a class="navbar-brand mx-3" href="#">
		    	<img src="img/logo.png" width="60">
		    </a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2  mx-4 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="#Home">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#about">About</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#contact">Contact</a>
		        </li>
		      </ul>
		      <ul class="navbar-nav me-right mx-5 mb-2 mb-lg-0">
		      	<li class="nav-item">
		          <a class="nav-link" href="login.php">Login</a>
		        </li>
		      </ul>
		  </div>
			</div>
	</nav>
	<section class="welcome-text d-flex justify-content-center align-items-center flex-column" id="Home">
        	<img src="img/logo.png" >
        	<h4> Welcome to Enote ! </h4>
			<h3>by <?=$setting['schoolName']?></h3>
			<div class ="paragraphe">
			<p>A modern solution to streamline the management and tracking of your courses.</p>
    <p>Our application is designed for educators, whether you're a professor, adjunct instructor, module coordinator, or program director.</p>
    <p>Log in to start recording your class sessions, view your session history, and collaborate effectively with your colleagues.</p>
	</div>        
</section>
<section id="about" class="d-flex justify-content-center align-items-center flex-column">
        	<div class="card mb-3 card-1">
			  <div class="row g-0">
			    <div class="col-md-4">
			      <img src="img/logo.png" class="img-fluid rounded-start" >
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title">About Us</h5>
					
    <p>Welcome to the Educational Course Tracking App! We're dedicated to providing educators with a powerful tool to manage and track their courses seamlessly.</p>
    <p>Our platform was developed with the needs of professors, adjunct instructors, module coordinators, and program directors in mind. We understand the challenges of course management and aim to simplify your workflow.</p>
    
    <ul>
        <li>Effortlessly record and track class sessions</li>
        <li>View comprehensive session history</li>
        <li>Collaborate with fellow educators for efficient course management</li>
        <li>Streamline communication with module coordinators and program directors</li>
    </ul>
    <p>We're excited to have you on board and look forward to enhancing your educational experience with our app!</p>
			        
			        <p class="card-text"><small class="text-muted">ENote by <?=$setting['schoolName']?></small></p>
			      </div>
			    </div>
			  </div>
			</div>
			

        </section>

		<section id="contact"
                 class="d-flex justify-content-center align-items-center flex-column">
        	<form method="post"
    	          action="req/contact.php">
        		<h3>Contact Us</h3>
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
			    <label for="exampleInputEmail1" class="form-label">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
			    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Full Name</label>
			    <input type="text" name="full_name" class="form-control">
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Message</label>
			    <textarea class="form-control"name="message" rows="4"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Send</button>
			</form>
        </section>
		<div class="text-center text-light">
		Copyright &copy; <?=$setting['currentCYear']?> <?=$setting['schoolName']?>. All rights reserved.
        </div>

        
	</div>
	

		
		




<script src ="js/all.min.js"> </script>
<script src ="js/bootstrap.bundle.min.js"> </script>
<script src ="js/bootstrap.bundle.min.js.map"> </script>
</body>
</html>
<?php }else {
	header("Location: login.php");
	exit;
}  ?>