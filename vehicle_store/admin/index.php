<?php
session_start();

if (!isset($_SESSION['admin_email'])) {
	header("Location:login.php");
}

include "database.php";
$select_orders = new Database();

$sql = "SELECT * FROM order_customer ORDER BY id desc";

$select_orders->sql_select($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
		integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="style.css">
	<title>Dashboard</title>
</head>

<body>
	<?php require "header.php"; ?>

	<div class="main">
		<div class="sidebar-section col-2">
			<?php require "sidebar.php" ?>
		</div>
		<div class="content">
			<div class="dash-title">
				<h1><i class="fa-solid fa-gauge"></i> Dashboard</h1>
			</div>

			<!-- Cards -->

			<div class="col-12">
				<div class="row">
					<div class="card-row">
						<div class="cards col-3">
							<div class="row">
								<div class="sales-icon sales col-4">
									<h2>
										<i class="fa-solid fa-cart-shopping"></i>
									</h2>
								</div>
								<div class="sales-desc sales col-8">
									<p>Sales</p>
									<h3>$30000</h3>
								</div>
							</div>
						</div>
						<div class="cards col-3">
							<div class="row">
								<div class="sales-icon customers col-4">
									<h2>
										<i class="fa-solid fa-users"></i>
									</h2>
								</div>
								<div class="sales-desc customers col-8">
									<p>Customers</p>
									<h3>300</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="card-row">
						<div class="cards col-3">
							<div class="row">
								<div class="sales-icon orders col-4">
									<h2>
										<i class="fa-solid fa-cart-flatbed-suitcase"></i>
									</h2>
								</div>
								<div class="sales-desc orders col-8">
									<p>Today Orders</p>
									<h3>30</h3>
								</div>
							</div>
						</div>
						<div class="cards col-3">
							<div class="row">
								<div class="sales-icon profit  col-4">
									<h2>
										<i class="fa-solid fa-money-bill-trend-up"></i>
									</h2>
								</div>
								<div class="sales-desc profit col-8">
									<p>Profit</p>
									<h3>$3000</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- Sales Table -->

			<div class="row">
				<div class="col-11">
					<form id="form1" action="delete_multiple.php" method="post">
						<p>Orders</p>
						<table id="table1">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Address</th>
									<th>Phone</th>
									<th>Type</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sr = 1;
								foreach ($select_orders->getResult() as $value) {
								?>
								<tr>
									<td><b><?php echo $sr ?></b></td>
									<td><?php echo $value['first_name'] ?></td>
									<td><?php echo $value['last_name'] ?></td>
									<td><?php echo $value['address'] ?></td>
									<td><?php echo $value['phone'] ?></td>
									<td><?php echo $value['type'] ?></td>
									<td><?php echo $value['date'] ?></td>
									<td>
										<a id="details" href="order_details.php?id=<?php echo $value['id'] ?>" title="View Order Details"><i
												class="fa-solid fa-eye"></i></a>
										<a id="deletesingle" href=""><i class="fa-solid fa-trash"></i></a>
									</td>
								</tr>
								<?php
									$sr++;
								} ?>
							</tbody>
						</table>
					</form>
				</div>


			</div>
		</div>

		<?php include "footer.php"; ?>
</body>

</html>