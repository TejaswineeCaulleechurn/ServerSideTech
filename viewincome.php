  <?php  
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');
if (strlen($_SESSION['mmuid']==0)) {
  header('location:logout.php');
  } else{

/* block to delete row from table tb_expenses */
if(isset($_GET['delid']))
	{
	/* retrieve the ID of the row that needs to be deleted */
	$rowid=intval($_GET['delid']);
	/* delete the row with ID = delid in tb_expenses */
	$query=mysqli_query($con,"delete from tb_income where ID='$rowid'");
	if($query){
		/* success message */
		echo "<script>alert('Record successfully deleted');</script>";
		/* redirects to page viewexpense.php */
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
	<title>MoneyManager - View Income</title>
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
		<!-- bootstrap class to generate the panel for expense list -->
		<div class="col-10 col-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="panel panel-default loginpanel">
			<!-- panel heading to indicate the purpose of the page -->
				<div class="panel-heading loginpanel_heading h4" align="center">View Income</div>
				<!-- panel body to contain the contents of the page -->
					<div class="panel-body">
					<!-- class to build responsive table -->
							<div class="table-responsive">
							<!-- begin table -->
								<table class="table table-bordered ">
								<!-- header of table -->
									<thead>
										<tr>
										  <th>ID</th>
										  <th>Income Details</th>
										  <th>Income Amount</th>
										  <th>Income Date</th>
										  <th>Delete item?</th>
										</tr>
									<!-- end of header of table -->
									</thead>
									<!-- php code to retrieve column details from tb_income for the userid -->
									<?php
										/* retrieve the ID mmuid */
										$userid=$_SESSION['mmuid'];
										/* retrieve the content from tb_income for the userid, ordering the income list in descending order */
										$ret=mysqli_query($con,"select * from tb_income where UserId='$userid'Order by IncomeDate DESC");
										/* variable count for each line retrieved - ID of each line */
										$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {

									?>
									<!-- body of table -->
									<tbody>
										<tr>
											<!-- displays the row number of the income -->
										  <td><?php echo $cnt;?></td>
										  <!-- displays IncomeDetails -->
										  <td><?php  echo $row['IncomeDetails'];?></td>
										  <!-- displays IncomeAmount -->
										  <td><?php  echo $row['IncomeAmount'];?></td>
										  <!-- displays IncomeDate -->
										  <td><?php  echo $row['IncomeDate'];?></td>
										  <!-- clickable link Delete which calls the php function at the start of the code and reloads the page viewincome.php -->
										  <td><a href="viewincome.php?delid=<?php echo $row['ID'];?>">Delete</a>
										</tr>
										<?php 
											/* updates the count variable */
											$cnt=$cnt+1;
										}?>
									<!-- end of body of table -->
									</tbody>
								</table> 
								</br>
								<div>
									<!-- button to add Income -->
									<a href="newincome.php" class="btn btn-primary">Add another Income</a>
								</div> </br>
								<div>
									<!-- button to redirect to dashboard -->
									<a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
								</div> </br>
							</div>
					</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php }  ?>