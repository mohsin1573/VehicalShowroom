<?php
session_start();
include "database.php";

$cart = new Database();
$cart->Cart();

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

	<!-- <style>
	.alert {
		padding: 20px;
		background-color: #63ab77;
		border-radius: 5px;
		color: white;
		width: fit-content;
		position: fixed;
		top: 100px;
		right: 40%;
	}

	.closebtn {
		margin-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}

	.closebtn:hover {
		color: black;
	}
	</style> -->


	<title>Cart</title>
</head>

<body>

	<header>
		<?php require 'includes/header.php'; ?>
	</header>
	<div class="cart_div">
		<div class="title">
			<h1>Shopping Cart</h1>
		</div>
		<div class="row">
			<div class="col-8">
				<div id="form1">
					<form action="" method="POST">
						<table id="table1">
							<thead>
								<tr>
									<th>#</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Price (per product)</th>
									<th>Total Price</th>
									<th>Remove</th>
								</tr>
							</thead>
							<tbody>

								<?php
								if (isset($_SESSION['cart'])) {

									foreach ($_SESSION['cart'] as $key => $value) {
										$sr = $key + 1;
								?>
								<tr>
									<td><b><?php echo $sr ?></b></td>
									<td><?php echo $value['item_name'] ?></td>
									<td>

										<input class="quant" name="Qty_edit" type="number" min="1" value="<?php echo $value['Quantity'] ?>"
											onchange="subTotal()">
										<input type='hidden' name='item_name' value="<?php echo $value['item_name'] ?>">
									</td>
									<td>$<?php echo $value['price'] ?><input type="hidden" name="" class="iprice"
											value="<?php echo $value['price'] ?>"></td>
									<td class="itotal"></td>
									<td>
										<form action='' method='POST'>
											<button class="remove" name='remove_item' type="submit"><i class="fa-solid fa-xmark"></i></button>
											<input type='hidden' name='item_name' value="<?php echo $value['item_name'] ?>">
											<input type='hidden' name='id' value="<?php echo $value['pr_id'] ?>">
										</form>
									</td>
									<?php
									}
								}
									?>
								</tr>
							</tbody>
						</table>

						<input type="submit" name="Qty_update" style="cursor:pointer;" class="checkout"
							value="Update Cart"><span></input>
					</form>
				</div>
			</div>


			<div class="cart-total col-2">
				<h1>Cart Total</h1>
				<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
				<p><b>Delivery Charges:</b><span class="values">$1000</span></p>
				<p><b>GST:</b><span class="values">$2000</span></p>
				<h3 style="display: inline;">Grand Total</h3>
				<h3 style="display: inline; float:right;" id="gtotal"></h3>
				<?php } else {
					echo "<h5>Hey! There is nothing in the Cart..</h5>";
				} ?>

			</div>
		</div>

		<?php if (count($_SESSION["cart"]) > 0) { ?>
		<button style="cursor:pointer;" class="checkout_"><a style="cursor:pointer;" href="checkout_page.php">Proceed To
				CheckOut</a></button>
		<?php } else {
		?>
		<button style="cursor:not-allowed; opacity:0.5" class="checkout_" title="Please add items to the Cart to proceed.."
			disabled><a style="cursor:not-allowed;" href="checkout_page.php" title="Please add items to the Cart to proceed.."
				disabled>Proceed
				To CheckOut</a></button>
		<?php	} ?>

	</div>


	<?php require "includes/footer.php"; ?>


	<script>
	var gt = 0;
	var iprice = document.getElementsByClassName('iprice');
	var iquantity = document.getElementsByClassName('quant');
	var itotal = document.getElementsByClassName('itotal');
	var gtotal = document.getElementById('gtotal');
	var tax = 3000;

	function subTotal() {
		gt = 0;
		for (index = 0; index < iprice.length; index++) {
			itotal[index].innerText = "$" + (iprice[index].value) * (iquantity[index].value);
			gt = gt + (iprice[index].value) * (iquantity[index].value) + tax;
		}
		gtotal.innerText = "$" + gt;
	}

	subTotal();
	</script>

</body>

</html>