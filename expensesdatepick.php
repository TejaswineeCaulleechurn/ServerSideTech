<?php
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');
if (strlen($_SESSION['mmuid']==0)) {
  header('location:logout.php');
  } else{
	
	/* store to and from dates to send to totalexpenses.php to display list */
	if(isset($_POST['submit']))
	{
		$fromdate=($_POST['fromdate']);
		$todate  =($_POST['todate']);
	}
  

  ?>
<!DOCTYPE html>
<html>
<head>
	<!-- loading libraries to generate page -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MoneyManager - Expense Report</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>
		<div class="row">
			<!-- bootstrap class to generate the panel for expense list -->
			<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">		
				<!-- panel heading to indicate the purpose of the page -->			
				<div class="panel panel-default loginpanel">
					<div class="panel-heading loginpanel_heading h4">Datewise Income/Expense Report</div>
						<!-- panel body to contain the contents of the page -->
						<div class="panel-body">
						<!-- this tag will display any error message or success message for variable $msg -->
							<p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg; }  ?> </p>
							<!-- bootstrap class to generate the panel for expense list -->
							<div class="col-md-12">
							<!-- build datepicker form for app user - redirects to totalexpense.php using the input values -->
								<form role="form" method="post" action="totalexpense.php" name="bwdatesreport">
									<div class="form-group">
										<!-- User to input fromdate -->
										<label>From Date</label>
										<input class="form-control" type="date"  id="fromdate" name="fromdate" required="true">
									</div>
									<div class="form-group">
										<!-- User to input todate -->
										<label>To Date</label>
										<input class="form-control" type="date"  id="todate" name="todate" required="true">
									</div>
									<div class="form-group has-success">
										<!-- confirm button to submit form to totalexpense.php -->
										<button type="submit" class="btn btn-primary" name="submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
				</div> 
			</div> 
		</div> 
</body>
</html>
<?php } ?>