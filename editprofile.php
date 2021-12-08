<?php
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');
if (strlen($_SESSION['mmuid']==0)) {
	header('location:logout.php');
	} 
	else{
    if(isset($_POST['submit']))
	{
		$userid=$_SESSION['mmuid'];
		$fullname=$_POST['fullname'];
		$mobno=$_POST['contactnumber'];

		$query=mysqli_query($con, "update tb_users set FullName ='$fullname', MobileNumber='$mobno' where ID='$userid'");
		if ($query) {
			$msg="User profile has been updated.";
		}
		else
			{$msg="Something Went Wrong. Please try again.";}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MoneyManager - User Profile</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>

<body>
	<div class="row">
	<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="panel panel-default loginpanel">
			<div class="panel-heading loginpanel_heading h4" align="center">User Profile</div>
				<div class="panel-body">
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg;}  ?> </p>
						<div class="col-md-12">
							<?php
								$userid=$_SESSION['mmuid'];
								$ret=mysqli_query($con,"select * from tb_users where ID='$userid'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {

							?>
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Full Name</label>
									<input class="form-control" type="text" value="<?php  echo $row['FullName'];?>" name="fullname" required="true">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" value="<?php  echo $row['Email'];?>" required="true" readonly="true">
								</div>
								
								<div class="form-group">
									<label>Mobile Number</label>
									<input class="form-control" type="text" value="<?php  echo $row['MobileNumber'];?>" required="true" name="contactnumber" maxlength="10">
								</div>
								<div class="form-group">
									<label>Registration Date</label>
									<input class="form-control" name="regdate" type="text" value="<?php  echo $row['RegDate'];?>" readonly="true">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Update</button>
								</div>
								
								<div>
									<a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
								</div> </br>
						</div>
							<?php } ?>
							</form>
				</div>
		</div>
	</div><!-- /.panel-->
	</div><!-- /.col-->
	
</body>
</html>
<?php }  ?>