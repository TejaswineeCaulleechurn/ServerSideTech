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
    $date_of_expense=$_POST['date_of_expense'];
    $item_name=$_POST['item_name'];
    $item_cost=$_POST['item_cost'];
	/* inserting a line in tb_expenses for the values inputted on the form */
    $query=mysqli_query($con, "INSERT INTO tb_expenses(UserId,ExpenseDate,ExpenseItem,ExpenseCost) value('$userid','$date_of_expense','$item_name','$item_cost')");
	if($query){
		/* success message */
		echo "<script>alert('Expense has been added');</script>";
		/* redirects to page viewexpense.php */
		echo "<script>window.location.href='viewexpense.php'</script>";
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
	<title>MoneyManager - Add Expense</title>
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
		<!-- bootstrap class to generate the panel for expense -->
		<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="panel panel-default loginpanel">
			<!-- panel heading to indicate the purpose of the page -->
				<div class="panel-heading loginpanel_heading h4" align="center">New Expense</div>
				<!-- panel body to contain the contents of the page -->
					<div class="panel-body">
					<!-- this tag will display any error message or success message for variable $msg -->
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){ echo $msg;}  ?> </p>
						<fieldset>
						<!-- build add-expense form for app user -->
							<form role="form" method="POST" action="">
								<div class="form-group">
									<!-- User to input Date of Expense -->
									<label  class= "h5" >Date of Expense</label>
									<input class="form-control" placeholder="Please select date of expense" type="date" name="date_of_expense" value="" required="true">
								</div>
								<div class="form-group">
									<!-- User to input Item -->
									<label class= "h5" >Item</label>
									<input class="form-control" placeholder="Please enter expense details" type="text" name="item_name" value="" required="true">
								</div>
								
								<div class="form-group">
									<!-- User to input Cost of Item -->
									<label  class= "h5" >Cost of Item</label>
									<input class="form-control" placeholder="Please enter expense cost" type="text" name="item_cost" value="" required="true">
								</div>
								</br>							
								<div>
									<!-- confirm button to add expense -->
									<button type="submit" class="btn btn-primary" name="submit">Add Expense</button>
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