<?php
session_start();
error_reporting(0);
/* establish database connection */
include('includes/dbconnection.php');
if (strlen($_SESSION['mmuid']==0)) {
  header('location:logout.php');
  } else{
		/* retrieve to and from date */
	    $fromdate=$_POST['fromdate'];
		$todate=($_POST['todate']);

  

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
			<div class="panel panel-default loginpanel">
			<!-- panel heading to indicate the purpose of the page -->
				<div class="panel-heading loginpanel_heading h4" align="center">Income and Expense Report</div>
				<!-- panel body to contain the contents of the page -->
					<div class="panel-body">
					<!-- bootstrap class to generate the expense list -->
						<div class="col-md-12">
					.		<?php
							/* retrieve the ID mmuid */
							$userid=$_SESSION['mmuid'];
							/* retrieve month date */
							$monthdate=  date("Y-m-d", strtotime("-1 month")); 
							/* retrieve today's date */
							$currentdate=date("Y-m-d");
							?>
							<!-- list header -->
							<h5 align="center" style="color:blue">Income and Expense Report from <?php echo $fromdate?> to <?php echo $todate?></h5>
							<hr />
								<!-- begin table --> <!-- class to build responsive table -->
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <!-- header of table -->
								<thead>
                                    <tr>
                                    <tr>
										<th>ID</th>
										<th>Month-Year</th>
										<th>Expense Details</th>
										<th>Expense Amount</th>
										<th>Expense Date</th>
									</tr>
									</tr>
								<!-- end of header of table -->
								</thead>
								<!-- php code to retrieve column details from tb_expenses for the userid -->
								<?php
								/* retrieve the ID mmuid */
								$userid=$_SESSION['mmuid'];
								/* retrieve the content from tb_expenses for the userid, ordering the expense list in asc order */
								$ret=mysqli_query($con,"SELECT month(ExpenseDate) as expmonth,year(ExpenseDate) as expyear, ExpenseCost, ExpenseDate, ExpenseItem FROM tb_expenses  where (ExpenseDate BETWEEN '$fromdate' and '$todate') && (UserId='$userid') order by ExpenseDate");
								/* variable count for each line retrieved - ID of each line */
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) 
								{
								?>
								<!-- body of table -->
								<tbody>
              					<tr>
									<!-- displays the row number of the expense -->
									<td><?php echo $cnt;?></td>
									<!-- displays Month - Year -->
									<td><?php  echo $row['expmonth']."-".$row['expyear'];?></td>
									<!-- displays ExpenseItem -->
									<td><?php  echo $ttlsl=$row['ExpenseItem'];?></td>
									<!-- displays ExpenseCost -->
									<td><?php  echo $ttlsl=$row['ExpenseCost'];?></td>
									<!-- displays ExpenseDate -->
									<td><?php  echo $ttlsl=$row['ExpenseDate'];?></td>      
								</tr>
								<?php
								/* updates the count variable */
								$cnt=$cnt+1;
									}
								?>
								<!-- end of body of table -->
								</tbody>
								<!-- end table -->
								</table>
								
								<!-- begin table --> <!-- class to build responsive table -->
								<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <!-- header of table -->
								<thead>
                                    <tr>
                                    <tr>
										<th>S.NO</th>
										<th>Month-Year</th>
										<th>Income Details</th>
										<th>Income Amount</th>
										<th>Income Date</th>
									</tr>
									</tr>
								<!-- end of header of table -->
								</thead>
								<!-- php code to retrieve column details from tb_income for the userid -->
								<?php
								/* retrieve the ID mmuid */
								$userid=$_SESSION['mmuid'];
								/* retrieve the content from tb_income for the userid, ordering the income list in asc order */
								$monthlyincome=mysqli_query($con,"SELECT month(IncomeDate) as incmonth,year(IncomeDate) as incyear, IncomeAmount, IncomeDate, IncomeDetails FROM tb_income  where (IncomeDate BETWEEN '$fromdate' and '$todate') && (UserId='$userid') order by IncomeDate");
								/* variable count for each line retrieved - ID of each line */
								$cnt=1;
								while ($row1=mysqli_fetch_array($monthlyincome)) 
								{
								?>
								<!-- body of table -->
								<tbody>
              					<tr>
									<!-- displays the row number of the income -->
									<td><?php echo $cnt;?></td>
									<!-- displays Month - Year -->
									<td><?php  echo $row1['incmonth']."-".$row1['incyear'];?></td>
									<!-- displays IncomeDetails -->
									<td><?php  echo $ttlsl=$row1['IncomeDetails'];?></td>
									<!-- displays IncomeAmount -->
									<td><?php  echo $ttlsl=$row1['IncomeAmount'];?></td>
									<!-- displays IncomeDate -->
									<td><?php  echo $ttlsl=$row1['IncomeDate'];?></td>
   
								</tr>
								<?php
								/* updates the count variable */ 
								$cnt=$cnt+1;
									}
								?>
								<!-- end of body of table -->
								</tbody>
								<!-- end table -->
								</table>
								
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
<?php } ?>