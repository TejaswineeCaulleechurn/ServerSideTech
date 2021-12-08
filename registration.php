<?php 
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
	 /* reading input values in the form */
    $name=$_POST['name'];
    $number=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=($_POST['password']);
	
	/* checks if the email address is already registered */
    $emailcheck=mysqli_query($con, "select Email from tb_users where Email='$email' ");
    $result=mysqli_fetch_array($emailcheck);
    if($result>0){
		/* error message if email address is already in use */
		$msg="Account exists already! Please try again!";
		}
    else{
	/* insert a line in users table - create a user in db */
    $adduser=mysqli_query($con, "insert into tb_users (FullName, MobileNumber, Email,  Password) value('$name', '$number', '$email', '$password' )");
    if ($adduser) {
		/* success message */
		$msg="You have successfully been registered into MoneyManager! Please go back to the Login page to enter.";
		}
	else
		{
		/* default error message */
		$msg="Something went wrong. Please try again";
		}
		}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<!-- loading libraries to generate page -->
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MoneyManager - Registration</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<!-- function to check if the passswords entered match. If not, it displays an error messsage and prompts user to re-enter password -->
	<script>
		function verifypassword()
		{
		if(document.registration.password.value!=document.registration.confirmpassword.value)
		{
		alert('Passwords do not match! Please re-enter your password.');
		document.registration.confirmpassword.focus();
		return false;
		}
		return true;
		} 

	</script>
</head>

<body>
<!-- title header, same on each page and contains the name of the application -->
	<div class="title-header">
			<h2 align="center">MoneyManager</h2>
	<hr />
	<!-- bootstrap class to generate the panel for login -->
		<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="panel panel-default loginpanel">
			<!-- panel heading to indicate the purpose of the page -->
				<div class="panel-heading loginpanel_heading h4" align="center">New User Registration</div>
				<!-- panel body to contain the contents of the page -->
					<div class="panel-body">
					<!-- build password reset form for app user - calls function verifypassword on submit to check inputs -->
						<form role="form" action="" method="post" id="" name="registration" onsubmit="return verifypassword();">
							<!-- this tag will display any error message or success message for variable $msg -->
							<p style="font-size:16px; color:indianred" align="center"> <?php if($msg){echo $msg;}  ?> </p>
							<fieldset>
								<!-- User to input surname -->
								<div class="form-group">
									<label class= "h5" for="surname">Surname: </label>
									<input class="form-control" placeholder="Please enter your Surname" name="surname" type="text" required="true">
								</div>
								<!-- User to input name -->
								<div class="form-group">
									<label class= "h5" for="name">Name: </label>
									<input class="form-control" placeholder="Please enter your Name" name="name" type="text" required="true">
								</div>
								<!-- User to input email address -->
								<div class="form-group">
									<label class= "h5" for="email">Email: </label>
									<input class="form-control" placeholder="Please enter your email address" name="email" type="email" required="true">
								</div>
								<!-- User to input mobile number -->
								<div class="form-group">
									<label class= "h5" for="mobilenumber">Mobile Number: </label>
									<input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Please enter your Mobile Number" maxlength="8" pattern="[0-9]{8}" required="true" >
								</div>
								<!-- User to input password -->
								<div class="form-group">
									<label class= "h5" for="password">Password: </label>
									<input class="form-control" placeholder="Please enter a Password for your account" name="password" type="password" value="" required="true">
								</div>
								<!-- User to re-enter password for verification -->
								<div class="form-group">
									<label class= "h5" for="confirmpassword">Re-enter Password: </label>
									<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Please re-enter the password" required="true">
								</div>
								<!-- confirm button to reset password - calls verifypassword(), creates a new user in db on submit -->
								<div>
									<button type="submit" value="submit" name="submit" class="btn btn-primary">Register</button>
								</div> </br>
								<!-- link to redirect to login page -->
								<a href="index.php" class="btn btn-primary">Back to Login page</a>
							 </fieldset>
						</form>
					</div>
			</div>
		</div> 
	</div> 	
</body>
</html>
