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
	/* sending the values below on submit */
  	$userid=$_SESSION['mmuid'];
	$fdate=$_POST['monthdate'];
	$tdate=$_POST['crrntdte'];

	}


?>
<!DOCTYPE html>
<html>
<head>
	<!-- loading libraries to generate page -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MoneyManager - Dashboard</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/easypiechart.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/easypiechart-data.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/chart.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/chart-data.js"></script>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</head>
<body>
	<!-- title header, same on each page and contains the name of the application -->
	<div class="title-header">
		<h2 align="center">MoneyManager</h2>
	</div>
	<hr />	
	<!-- bootstrap class to generate the panel for login -->
	<fieldset class="col-15 col-offset-2 col-sm-10 col-sm-offset-2 col-md-12 col-md-offset-3"> 
		<div>
			<!-- link to edit user profile and to logout from app -->
			<a style="color: white; font-size: 20px;"; href="editprofile.php" class="btn " >Edit user profile</a> 
			<a style="color: white; font-size: 20px;"; href="logout.php" class="btn "  >Logout</a>
		</div> 
	</div>
	<!-- adding the next chart on a new row -->
	<div class="row">
		<!-- bootstrap class for chart panel -->
		<div class="col-xs-6 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body easypiechart-panel">
				<?php
				/* Today's Expense - retrieves expense for the day from the database */
				$userid=$_SESSION['mmuid'];
				$tdate=date('Y-m-d');
				$query1=mysqli_query($con,"SELECT SUM(ExpenseCost) as todaysexpense from tb_expenses where ExpenseDate = '$tdate' and UserId = '$userid'");
				$result1=mysqli_fetch_array($query1);
				$sum_today_expense=$result1['todaysexpense'];
				
				/* Today's Income - retrieves income for the day from the database */
				$todaysincome=mysqli_query($con,"select sum(IncomeAmount)  as todaysincome from tb_income where (IncomeDate)='$tdate' && (UserId='$userid'); ");
				$ret=mysqli_fetch_array($todaysincome);
				$sum_today_income=$ret['todaysincome'];
				?> 

				<h4>Today</h4>
				<!-- build pie chart for today's expense with link to detailed list at dailyexpense.php -->
				<a href="dailyexpense.php" class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_today_expense ?>" >
					<!-- displays income and expense for the day on the lower left of the piechart in the format INCOME/EXPENSE -->
					<span class="percent"><?php if($sum_today_expense==""){ echo "0"; } else { echo $sum_today_expense; } ?>/<?php if($sum_today_income==""){ echo "0"; } else { echo $sum_today_income; } ?></span>
				</a>
			</div>
		</div>
	</div>
	
	<!-- bootstrap class to build panel for Add Expense -->
	<div class="col-xs-6 col-md-3">
		<div class="panel panel-default" style= "text-align: center" >
			<!-- Clickable button and label with link to newexpense.php to add a new expense -->
			<a href="newexpense.php" style= "font-weight: 300; font-size: 90px; font color: dimgray; text-align: center" >+</a></br>
			<a href="newexpense.php" style= "font-weight: 300; font-size: 26px; font color: dimgray; text-align: center" >Add new expense</a> </br> </br>
		</div>
	</div>	
	</div>
	
	<!-- adding the next chart on a new row -->
	<div class="row">
		<!-- bootstrap class for chart panel -->
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<?php
					/* Weekly Expense - retrieves expense for the week from the database */
					$userid=$_SESSION['mmuid'];
					$pastdate=  date("Y-m-d", strtotime("-1 week")); 
					$crrntdte=date("Y-m-d");
					$query2=mysqli_query($con,"select sum(ExpenseCost)  as weeklyexpense from tb_expenses where ((ExpenseDate) between '$pastdate' and '$crrntdte') && (UserId='$userid');");
					$result2=mysqli_fetch_array($query2);
					$sum_weekly_expense=$result2['weeklyexpense'];
					
					/* Weekly Income - retrieves income for the week from the database */
					$weeklyincome=mysqli_query($con,"select sum(IncomeAmount)  as weeklyincome from tb_income where ((IncomeDate) between '$pastdate' and '$crrntdte') && (UserId='$userid'); ");
					$retweekly=mysqli_fetch_array($weeklyincome);
					$sum_weekly_income=$retweekly['weeklyincome'];
				?>
				<div class="panel-body easypiechart-panel">
					<h4>This Week</h4>
					<!-- build pie chart for weekly expense with link to detailed list at weeklyexpense.php -->
					<a href="weeklyexpense.php" class="easypiechart" id="easypiechart-teal" data-percent="
						<?php echo $sum_weekly_expense;?>">
						<span class="percent">
						<!-- displays income and expense for the week on the lower left of the piechart in the format INCOME/EXPENSE -->
							<span class="percent"><?php if($sum_weekly_expense==""){ echo "0"; } else { echo $sum_weekly_expense; } ?>/<?php if($sum_weekly_income==""){ echo "0"; } else { echo $sum_weekly_income; } ?></span>
						</span>
					</a>
				</div>
			</div>
		</div>
	<!-- bootstrap class to build panel for Add Income -->
	<div class="col-xs-6 col-md-3">
		<div class="panel panel-default" style= "text-align: center" >
		<!-- Clickable button and label with link to newincome.php to add a new income -->
			<a href="newincome.php" style= "font-weight: 300; font-size: 90px; font color: dimgray; text-align: center" >+</a></br>
			<a href="newincome.php" style= "font-weight: 300; font-size: 26px; font color: dimgray; text-align: center" >Add Income</a> </br> </br>
		</div>
	</div>
	</div>
	
	<!-- adding the next chart on a new row -->
	<div class="row">
		<!-- bootstrap class for chart panel -->
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<?php
					/* Monthly Expense - retrieves expense for the month from the database */
					$userid=$_SESSION['mmuid'];
					$monthdate=  date("Y-m-d", strtotime("-1 month")); 
					$crrntdte=date("Y-m-d");
					$query3=mysqli_query($con,"select sum(ExpenseCost)  as monthlyexpense from tb_expenses where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
					$result3=mysqli_fetch_array($query3);
					$sum_monthly_expense=$result3['monthlyexpense'];
					
					/* Monthly Income - retrieves income for the month from the database */
					$monthlyincome=mysqli_query($con,"select sum(IncomeAmount)  as monthlyincome from tb_income where ((IncomeDate) between '$pastdate' and '$crrntdte') && (UserId='$userid'); ");
					$retmonthly=mysqli_fetch_array($monthlyincome);
					$sum_monthly_income=$retmonthly['monthlyincome'];
				?>
				<div class="panel-body easypiechart-panel">
					<h4>This Month</h4>
					<!-- build pie chart for monthly expense with link to detailed list at monthlyexpense.php -->
					<a href="monthlyexpense.php" class="easypiechart" id="easypiechart-red" data-percent="
						<?php echo $sum_monthly_expense;?>" >
						<span class="percent">
						<!-- displays income and expense for the month on the lower left of the piechart in the format INCOME/EXPENSE -->
							<span class="percent"><?php if($sum_monthly_expense==""){ echo "0"; } else { echo $sum_monthly_expense; } ?>/<?php if($sum_monthly_income==""){ echo "0"; } else { echo $sum_monthly_income; } ?></span>
						</span>
					</a>
				</div>
			</div>
		</div>
		<!-- bootstrap class for chart panel -->
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<?php
					/* Total Expense - retrieves expense for the user from the database */
					$userid=$_SESSION['mmuid'];
					$query5=mysqli_query($con,"select sum(IncomeAmount)  as totalincome from tb_income where UserId='$userid';");
					$result5=mysqli_fetch_array($query5);
					$sum_total_income=$result5['totalincome'];
				?>
				<div class="panel-body easypiechart-panel">
					<h4>Total Income</h4>
					<!-- build pie chart for total expense with link to detailed list at expensesdatepick.php where the user can pick the dates from and to, for which he wants to see the expense list -->
					<a href="expensesdatepick.php" class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_income;?>" >
						<!-- displays total expense for the user  -->
						<span class="percent"><?php if($sum_total_income==""){ echo "0"; } else { echo $sum_total_income; } ?>
						</span>
					</a>
				</div>
				<?php
					/* Total Income - retrieves income for the user from the database */
					$userid=$_SESSION['mmuid'];
					$query6=mysqli_query($con,"select sum(ExpenseCost)  as totalexpense from tb_expenses where UserId='$userid';");
					$result6=mysqli_fetch_array($query6);
					$sum_total_expense=$result6['totalexpense'];
				?>
				<div class="panel-body easypiechart-panel">
					<h4>Total Expenses</h4>
					<!-- build pie chart for total income with link to detailed list at expensesdatepick.php where the user can pick the dates from and to, for which he wants to see the income list -->
					<a href="expensesdatepick.php" class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_expense;?>" >
						<!-- displays total income for the user  -->
						<span class="percent"><?php if($sum_total_expense==""){ echo "0"; } else { echo $sum_total_expense; } ?>
						</span>
					</a>
				</div>

			</div>
		</div>
	</div>
	</fieldset>	

	<?php ?>

		
</body>
</html>
<?php } ?>