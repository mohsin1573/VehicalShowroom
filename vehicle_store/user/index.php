<?php
session_start();
include "database.php";


$select = new Database();
$select_catag = new Database();
$select_brand = new Database();

$select_catag->sql_select("SELECT * FROM catagories");
$select_brand->sql_select("SELECT * FROM brands");

$catag_id = "";
$brand_id = "";
$search = "";
$all = "";


if (isset($_GET['catagid'])) {
	$catag_id = $_GET['catagid'];
}
if (isset($_GET['brandid'])) {
	$brand_id = $_GET['brandid'];
}
if (isset($_GET['search'])) {
	$search = $_GET['search'];
}
if (isset($_GET['all_value'])) {
	$all = $_GET['all_value'];
}

$limit = 8;

if ($catag_id) {
	// $select->select("SELECT * FROM products WHERE catagory='$catag_id'");
	$select->select("products", "*", null, "catagory='$catag_id'", "id desc", $limit);
} elseif ($brand_id) {
	// $select->sql_select("SELECT * FROM products WHERE brand='$brand_id'");
	$select->select("products", "*", null, "brand='$brand_id'", "id desc", $limit);
} elseif ($search) {
	// $select->sql_select("SELECT * FROM products WHERE name LIKE '%$search%'");
	$select->select("products", "*", null, "name LIKE '%$search%'", "id desc", $limit);
} elseif ($all) {
	// $select->sql_select("SELECT * FROM products");
	$select->select("products", "*", null, null, "id desc", $limit);
} else {
	// $select->sql_select("SELECT * FROM products");
	$select->select("products", "*", null, null, "id desc", $limit);
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
	<style>
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
	</style>

	<title>Home</title>
</head>

<body>

	<!-- header Start -->
	<header>
		<?php require 'includes/header.php'; ?>
	</header>

	<!-- header end -->

	<div class="container__">
		<div class="title_talk">
			<div class="title_inner">
				<h1><span>Revolutionizing</span>
					Automobile Trading Worldwide</h1>
				<h5>We are creating value for our clients through the
					export of preeminent quality Japanese cars.</h5>
			</div>
		</div>
		<div class=" image">
			<div class="image_inner">
				<img src="images/car_people.svg" alt="">
			</div>
		</div>
	</div>


	<!-- product section start-->

	<section class="products-section">

		<h1 class="product-title">Products</h1>
		<?php if (isset($_SESSION['message'])) {
		?>
		<div class="alert">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			<?php echo $_SESSION['message'];
				// unset($_SESSION['message']);
				?>
		</div>
		<?php
		} ?>
		<div class="row product-catag">
			<div class="search-bar">
				<form action="index.php" method="get">
					<input type="text" name="search" placeholder="Search Products..">
					<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
				</form>
			</div>

			<div class="product-content col-12">
				<div class="products">
					<div class="row row-md">
						<a class="all" href="index.php?all_value='all'">Show All</a>
						<?php
						foreach ($select->getResult() as $value) {
						?>
						<form action="cart.php" method="POST">
							<div class="item col-3">
								<div class="item-image">
									<img src="../admin/uploaded_images/<?php echo $value['image'] ?>" alt="">
								</div>
								<div class="item-details">
									<h3><?php echo $value['name'] ?></h3>
									<p>$<?php echo $value['sale_price'] ?></p>
									<input class="qty" type="number" name="Qty" min="1" value="1">
									<button class="addtocart" name="add_to_cart" type="submit">Add To Cart</button>
									<input type="hidden" name="item_name" value="<?php echo $value["name"] ?>">
									<input type="hidden" name="price" value="<?php echo $value["sale_price"] ?>">
									<input type="hidden" name="pr_id" value="<?php echo $value["id"] ?>">
									<input type="hidden" name="catagory" value="<?php echo $value["catagory"] ?>">
									<input type="hidden" name="brand" value="<?php echo $value["brand"] ?>">
								</div>
							</div>
						</form>
						<?php
						} ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Pagination Start -->

	<?php

	if ($catag_id) {

		$select->pagination("products", null, "catagory='$catag_id'", null, $limit);
	} elseif ($brand_id) {

		$select->pagination("products", null, "brand='$brand_id'", null, $limit);
	} elseif ($search) {

		$select->pagination("products", null, "name LIKE '%$search%'", null, $limit);
	} elseif ($all) {

		$select->pagination("products", null, null, null, $limit);
	} else {

		$select->pagination("products", null, null, null, $limit);
	}
	?>

	<?php require "includes/footer.php"; ?>

</body>

</html>