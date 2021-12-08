<?php
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');
if (strlen($_SESSION['mmuid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
  	/* retrieve the ID mmuid */
	$userid=$_SESSION['mmuid'];
	/* sending the values below on submit */
    $date_of_income=$_POST['date_of_income'];
    $income_details=$_POST['income_details'];
    $income_amount=$_POST['income_amount'];
	/* inserting a line in tb_income for the values inputted on the form */
    $query=mysqli_query($con, "INSERT INTO tb_income(UserId,  IncomeDate,IncomeDetails,IncomeAmount) value('$userid', '$date_of_income','$income_details','$income_amount')");
	if($query){
		/* success message */
		echo "<script>alert('Income has been added');</script>";
		/* redirects to page viewincome.php */
		echo "<script>window.location.href='viewincome.php'</script>";
		} 
		else {
			/* error message */
			echo "<script>alert('Something went wrong. Please try again');</script>";
			}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- loading libraries to generate page -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MoneyManager - Add Income</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<!-- title header, same on each page and contains the name of the application -->
	<div class="title-header">
		<h2 align="center">MoneyManager</h2>
	<hr />
		<!-- bootstrap class to generate the panel for income -->	
		<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="panel panel-default loginpanel">
			<!-- panel heading to indicate the purpose of the page -->
				<div class="panel-heading loginpanel_heading h4" align="center">New Income</div>
				<!-- panel body to contain the contents of the page -->
					<div class="panel-body">
					<!-- this tag will display any error message or success message for variable $msg -->
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){ echo $msg;}  ?> </p>
						<fieldset>
						<!-- build add-income form for app user -->
							<form role="form" method="POST" action="">
								<div class="form-group">
									<!-- User to input Date of Income -->
									<label  class= "h5" >Date of Income</label>
									<input class="form-control" placeholder="Please select date of income" type="date" name="date_of_income" value="" required="true">
								</div>
								<div class="form-group">
									<!-- User to input Income Details -->
									<label class= "h5" >Income Details</label>
									<input class="form-control" placeholder="Please enter income details" type="text" name="income_details" value="" required="true">
								</div>
								
								<div class="form-group">
									<!-- User to input Income Value -->
									<label  class= "h5" >Income Value</label>
									<input class="form-control" placeholder="Please enter income amount" type="text" name="income_amount" value="" required="true">
								</div>
								</br>							
								<div>
									<!-- confirm button to add Income -->
									<button type="submit" class="btn btn-primary" name="submit">Add Income</button>
								</div> </br>
							</form>					
						</fieldset>	
				</div>
		</div>
	</div>
	</div>
	
</body>
</html>
<?php }  ?>