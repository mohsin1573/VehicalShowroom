<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
	header("Location:login.php");
}
include "database.php";
$insert = new Database();

$select_catag = new Database();
$select_brand = new Database();

$select_catag->sql_select("SELECT * FROM catagories");
$select_brand->sql_select("SELECT * FROM brands");

$error = "";

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$catagory = $_POST['catagory'];
	$brands = $_POST['brand'];
	$quantity = $_POST['quantity'];
	$cost_price = $_POST['cost_price'];
	$sale_price = $_POST['sale_price'];

	$image = $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];

	if ($image) {
		$path = "uploaded_images/" . $image;
		move_uploaded_file($image_tmp, $path);
	} else {
		$error = "Please select an image.";
	}

	$insert->insert('products', ['name' => $name, 'catagory' => $catagory, 'brand' => $brands, 'quantity' => $quantity, 'cost_price' => $cost_price, 'sale_price' => $sale_price, 'image' => $image]);

	header("Location:products.php");
}



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
	<title>Add Products</title>
</head>

<body>
	<?php require "header.php"; ?>

	<div class="main">
		<div class="sidebar-section col-2">
			<?php require "sidebar.php" ?>
		</div>
		<div class="content">
			<div class="dash-title">
				<h1><i class="fa-solid fa-briefcase"></i> Add Products</h1>
			</div>

			<!-- Form -->

			<div class="form_add col-12">
				<form id="form_add" action="" method="post" enctype="multipart/form-data">
					<h1>Add Product</h1>
					<label for="">Name</label>
					<input type="text" name="name" placeholder="Enter Name">
					<label for="">Catagory</label>
					<select name="catagory" id="catagory">
						<option style="padding: 30px;" class="option">Select Catagory</option>

						<?php
						foreach ($select_catag->getResult() as $catag) {
						?>
						<option class="option" value="<?php echo $catag['name'] ?>"><?php echo $catag['name'] ?></option>
						<?php } ?>

					</select>
					<label for="">Brand</label>
					<select name="brand" id="brand">
						<option class="option">Select Brand</option>

						<?php
						foreach ($select_brand->getResult() as $brand) {
						?>
						<option class="option" value="<?php echo $brand['name'] ?>"><?php echo $brand['name'] ?></option>
						<?php } ?>
					</select>
					<label for="">Quantity</label>
					<input type="number" name="quantity" min="1" value="1">
					<label for="">Cost Price</label>
					<input type="number" min="1" name="cost_price" placeholder="Cost Price">
					<label for="">Sale Price</label>
					<input type="number" min="1" name="sale_price" placeholder="Sale Price">
					<small><?php echo $error; ?></small>
					<label for="">Upload Image</label>
					<label for="file-upload" class="custom-file-upload">
						<i class="fa fa-cloud-upload"></i> Upload Image
					</label>
					<input id="file-upload" name="image" type="file" required />
					<button class="do_checkout" name="submit" type="submit">Add</button>
				</form>
			</div>


		</div>
	</div>


</body>

</html>