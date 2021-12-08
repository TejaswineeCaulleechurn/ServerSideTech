<?php
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');

/* block to check if email and password exist in table in db */
if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=($_POST['password']);
    $query=mysqli_query($con,"select ID from tb_users where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
		/* assign a session id and load the dashboard */
		$_SESSION['mmuid']=$ret['ID'];
		header('location: dashboard.php');
    }
    else{
		/* error message in case of incorrect login */
		$msg="Incorrect login or password. Please try again!";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	 <!-- loading libraries to generate page -->
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>
<!-- title header, same on each page and contains the name of the application -->
	<div class="title-header" >
			<h2 align="center">MoneyManager</h2>
			<hr />
		<!-- bootstrap class to generate the panel for login -->
		<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="panel panel-default loginpanel">
			<!-- panel heading to indicate the purpose of the page -->
				<div class="panel-heading loginpanel_heading h4" align="center">Welcome to MoneyManager!</div>
				<!-- panel body to contain the contents of the page -->
				<div class="panel-body">
					<!-- this tag will display any error message or success message for variable $msg -->
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){ echo $msg;}  ?> </p>
					<!-- build LOGIN form for app user -->
					<form role="form" action="" method="POST" id="loginpage" name="loginpage">
						<fieldset>
							<div class="form-group">
							<!-- User to input email address -->
								<label class= "h5" for="email">Email: </label>
								<input  class="form-control" placeholder="Please enter your email address" name="email" type="email" autofocus="" required="true">
							</div> 							
							<div class="form-group">
							<!-- User to input password -->
								<label  class= "h5" for="password" font-color="aquamarine">Password: </label>
								<input class="form-control" placeholder="Please enter your password" name="password" type="password" value="" required="true">
							</div> </br>
							<!-- Link to click if user forgot password - loads a passwordreset page to reset the password -->
							<a style= "width: 200px; text-align: left;" href="passwordreset.php">Forgot Password?</a>
							<div></br>
							<!-- submit button which checks email and pwd in db -->
							  <button type="submit" value="login" name="login" class="btn btn-primary">Login</button>
							</div>
						</fieldset>
						</br>
					</form>
				<p>New user?</p>
				<!-- link to click to register as a new user - loads a registration page -->
				<a href="registration.php" class="btn btn-primary">Register</a>
				</div>
			</div>
		</div> 
	</div> 	
</body>
</html>
