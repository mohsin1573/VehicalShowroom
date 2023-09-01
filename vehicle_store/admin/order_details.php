<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
	header("Location:login.php");
}
include "database.php";

$select_orders = new Database();
$select_cust = new Database();

if (isset($_GET['id'])) {
	$cust_id = $_GET['id'];
}

$sql = "SELECT * FROM orders WHERE sale_id='$cust_id'";
$select_orders->sql_select($sql);

$sql = "SELECT * FROM order_customer WHERE id='$cust_id'";
$select_cust->sql_select($sql);

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
	<style>
	@media print {
		body * {
			visibility: hidden;
		}

		#printdiv,
		#printdiv * {
			visibility: visible;
		}

		#printdiv {
			position: absolute;
			left: 0;
			top: 0;
		}

		#table1 {
			/* width: 100%; */
			background-color: #ffffff;
			text-align: center;
			margin: auto;
		}

		#table1 thead {
			background-color: rgb(45, 104, 143);
			color: black;
		}

		td {
			border-bottom: 2px solid #e3e1e1;
			padding: 15px;
		}

		#table1 tr {
			border: 2px solid black;
			border-radius: 5px;
			/* padding: 20px; */
		}

		#table1 thead th {
			padding: 15px;
		}

		#table1 #deletesingle {
			padding: 10px;
			text-decoration: none;
			display: inline;
			border-radius: 5px;
			color: rgb(197, 76, 55);
		}

		#table1 #details {
			padding: 10px;
			text-decoration: none;
			display: inline;
			border-radius: 5px;
			color: rgb(96, 160, 233);
		}

		.sale {
			display: flex;
			justify-content: center;
		}

		.sale .col-8 {
			border: none;
			border-radius: 5px;
			margin-top: 20px;
			box-shadow: none;
		}

		.sale .cust_detail {
			padding: 10px;
			max-width: 400px;
		}

		.sale .cust_detail p {
			display: inline;
		}

		.dynmc {
			text-align: right;
			padding-left: 20px;
			text-align: right;
		}

		.sale .sale_details_h1 {
			text-align: center;
			font-size: 50px;
			font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
			color: rgb(30, 68, 99);
		}

		.sale .cust_details_h1 {
			color: #3f6f8f;
		}
	}
	</style>

	<title>Order Details</title>
</head>

<body>
	<button class="print-button" onclick="window.print()"><i class="fa-solid fa-print"></i> <b>Print</b></button>
	<div class="row sale">
		<div id="printdiv" class="col-8">
			<h1 class="sale_details_h1">Sale Invoice</h1>
			<div class="customer">
				<h2 class="cust_details_h1">Customer Details</h2>
				<?php
				foreach ($select_cust->getResult() as $values) {
				?>
				<div class="cust_detail">
					<p><b>Name</b></p>
					<p class="dynmc"><?php echo $values['first_name'] . " " . $values['last_name'] ?></p>
				</div>
				<div class="cust_detail">
					<p><b>Address</b></p>
					<p class="dynmc"><?php echo $values['address'] ?></p>
				</div>
				<div class="cust_detail">
					<p><b>Phone</b></p>
					<p class="dynmc"><?php echo $values['phone'] ?></p>
				</div>
				<div class="cust_detail">
					<p><b>Type</b></p>
					<p class="dynmc"><?php echo $values['type'] ?></p>
				</div>
				<div class="cust_detail">
					<p><b>Date</b></p>
					<p class="dynmc"><?php echo $values['date'] ?></p>
				</div>
			</div>
			<?php } ?>
			<hr>
			<div class="item_details">
				<p>Items Details</p>
				<table id="table1">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Catagory</th>
							<th>Brand</th>
							<th>Quantity</th>
							<th>Price (per item)</th>
							<th>Total Price</th>
						</tr>
					</thead>
					<tbody>
						<?php
					$grand_total = 0;
					$sr = 1;
					foreach ($select_orders->getResult() as $value) {
					?>
						<tr>
							<td><b><?php echo $sr ?></b></td>
							<td><?php echo $value['name'] ?></td>
							<td><?php echo $value['catagory'] ?></td>
							<td><?php echo $value['brand'] ?></td>
							<td><?php echo $value['quantity'] ?></td>
							<td>$<?php echo $value['price'] ?></td>
							<td>$<?php echo $total = (int)($value['quantity']) * (int)($value['price']) ?></td>
						</tr>
						<?php
						$sr++;
						$grand_total = $grand_total + $total;
					}
					?>
						<tr>
							<th colspan="5">
								<h3>Grand Total</h3>
							</th>
							<th colspan="2">
								<h3 class="text-start">$<?php echo $grand_total ?></h3>
							</th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
	function printDiv() {
		var divContents = document.getElementById("printdiv").innerHTML;
		var a = window.open('', '', 'height=2000, width=2000');
		a.document.write('<html>');
		// a.document.write('<body > <h1>Div contents are <br>');
		a.document.write(divContents);
		a.document.write('</body></html>');
		a.document.close();
		a.print();
	}
	</script>
</body>

</html>