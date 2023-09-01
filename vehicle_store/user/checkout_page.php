<?php
session_start();
include "database.php";

$select_user = new Database();




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
	<title></title>
</head>

<body>

	<header>
		<?php require 'includes/header.php'; ?>
	</header>
	<div class="cart_div">
		<div class="title">
			<h1>CheckOut Section</h1>
		</div>
		<div class="row">
			<div class="form_checkout col-8">
				<?php
				if (isset($_SESSION['user_email'])) {
					$sql = "SELECT * FROM users WHERE email='{$_SESSION['user_email']}'";
					$select_user->sql_select($sql);
					foreach ($select_user->getResult() as $customer) { ?>
				<form id="form_checkout" action="placeorder.php" method="POST">
					<h1 style="margin-bottom: 50px;text-align:center;">Customer Detail</h1>
					<input type="hidden" value="Registered" name="reg_or_not">
					<label for="">First Name</label>
					<input type="text" placeholder="First Name" name="fname" value="<?php echo $customer['first_name'] ?>"
						required>
					<label for="">Second Name</label>
					<input type="text" placeholder="Second Name" name="lname" value="<?php echo $customer['last_name'] ?>"><label
						for="">Email Address</label>
					<input type="email" placeholder="Email Address" name="email" value="<?php echo $customer['email'] ?>"
						required>
					<label for="">Phone</label>
					<input type="text" name="phone" value="<?php echo $customer['phone'] ?>" placeholder="Phone Number" required>
					<label for="">Address</label>
					<input type="text" name="address" placeholder="Your Address" required>
					<button class="do_checkout_" name="placeOrder" type="submit">Place Order</button>
				</form>
				<?php }
				} else {
					?>
				<form id="form_checkout" action="placeorder.php" method="POST">
					<h1 style="margin-bottom: 50px;text-align:center;">Customer Detail</h1>
					<input type="hidden" value="Guest" name="reg_or_not">
					<label for="">First Name</label>
					<input type="text" placeholder="First Name" name="fname" required>
					<label for="">Second Name</label>
					<input type="text" placeholder="Second Name" name="lname">
					<label for="">Email Address</label>
					<input type="email" placeholder="Email Address" name="email" required>
					<label for="">Phone</label>
					<input type="text" name="phone" placeholder="Phone Number" required>
					<label for="">Address</label>
					<input type="text" name="address" placeholder="Your Address" required>
					<button class="do_checkout_" name="placeOrder" type="submit">Place Order</button>
				</form>
				<?php
				} ?>
			</div>
			<div class="cart-total col-3">
				<h1>Cart Items</h1>
				<p><span class="cart_items"><b>Items</b></span> <span class="values cart_qty"><b>Quantity</b></span></p>
				<?php
				$grand_total = 0;
				if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

					foreach ($_SESSION['cart'] as $key => $value) {
						$total = $value['Quantity'] * $value['price'];
				?>
				<p><b><?php echo $value['item_name'] ?></b><span class="values"><?php echo $value['Quantity'] ?></span></p>
				<?php
						$grand_total = $grand_total + $total;
					}
					?>
				<h3>Total Charges: <span class="values">$<?php echo $grand_total + 1000 + 2000; ?></span></h3>
				<?php
				}
				?>

			</div>
		</div>
	</div>


	<?php require 'includes/footer.php'; ?>

</body>

</html>