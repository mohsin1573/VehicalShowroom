<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
	header("Location:login.php");
}
include "database.php";

$insert = new Database();

if (isset($_POST['submit'])) {
	$name = $_POST['name'];

	$insert->insert('catagories', ['name' => $name]);

	header("Location:catagory.php");
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
	<title>Add Catagory</title>
</head>

<body>
	<?php require "header.php"; ?>

	<div class="main">
		<div class="sidebar-section col-2">
			<?php require "sidebar.php" ?>
		</div>
		<div class="content">
			<div class="dash-title">
				<h1><i class="fa-solid fa-layer-group"></i> Add Catagory</h1>
			</div>


			<!-- Form -->
			<div class="form_add col-12">
				<form id="form_add" action="" method="post">
					<h1>Add Catagory</h1>
					<label for="">Name</label>
					<input type="text" name="name" placeholder="Enter Name" required>
					<button class="do_checkout" name="submit" type="submit">Add</button>
				</form>
			</div>


		</div>
	</div>


</body>

</html>