<?php
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');

/* block to update password in table in db */
if(isset($_POST['submit']))
  {
    $email=($_POST['email']);
    $password=($_POST['newpassword']);

    $query=mysqli_query($con,"update tb_users set Password='$password'  where  Email='$email'  ");
	if($query)
	{
	   $msg = "Password successfully changed";
		echo "<script>alert('Password successfully changed');</script>";
		session_destroy();
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

	<script>
	<!-- function to check if the passswords entered match. If not, it displays an error messsage and prompts user to re-enter password -->
		function verifypassword()
		{
		if(document.resetpassword.newpassword.value!=document.resetpassword.confirmpassword.value)
		{
		alert('Passwords do not match! Please re-enter your password.');
		document.resetpassword.confirmpassword.focus();
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
				<div class="panel-heading loginpanel_heading h4" align="center">Reset Password</div>
					<!-- panel body to contain the contents of the page -->
					<div class="panel-body">
					<!-- this tag will display any error message or success message for variable $msg -->
					<p style="font-size:16px; color:aquamarine" align="center"> <?php if($msg){ echo $msg;}  ?> </p>
					<!-- build password reset form for app user - calls function verifypassword on submit to check inputs -->
					<form role="form" action="" method="POST" name="resetpassword" onsubmit="return verifypassword()">
						<fieldset>
							<!-- User to input email address -->
							<div class="form-group">
								<label class= "h5" for="email">Email: </label>
								<input class="form-control" placeholder="Please enter your email address" name="email" type="email" value="">
							</div>
							<!-- User to input password -->
							<div class="form-group">
								<label class= "h5" for="newpassword">New Password: </label>
								<input class="form-control" placeholder="Please enter your password" name="newpassword" type="password" value="">
							</div>
							<!-- User to re-enter password -->
							<div class="form-group">
								<label class= "h5" for="confirmpassword">Confirm new password: </label>
								<input class="form-control" placeholder="Please confirm your password" name="confirmpassword" type="password" value="">
							</div> </br>
							<!-- confirm button to reset password - updates password in db on submit -->
							<div>
								<button type="submit" value="" name="submit" class="btn btn-primary">Reset</button>
							</div> </br>
							<!-- link to redirect to login page -->
							<div>
								<a href="index.php" class="btn btn-primary">Back to Login page</a> 
							</div>
						
						</fieldset>
					</form>
					</div>
			</div>
		</div>
	</div>	
</body>
</html>
