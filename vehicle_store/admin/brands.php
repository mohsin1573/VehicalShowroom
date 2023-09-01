<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
	header("Location:login.php");
}
include "database.php";

$select = new Database();

$select->sql_select("SELECT * FROM brands");

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
	<title>Catagories</title>
</head>

<body>
	<?php require "header.php"; ?>

	<div class="main">
		<div class="sidebar-section col-2">
			<?php require "sidebar.php" ?>
		</div>
		<div class="content">
			<div class="dash-title">
				<h1><i class="fa-solid fa-bars-staggered"></i> Brands</h1>
			</div>

			<!-- Products Table -->

			<div class="row">
				<div class="col-11">
					<form id="form1" action="delete_multiple.php" method="post">
						<a href="add_brand.php" class="add"><i class="fa-solid fa-plus"></i> Add</a>
						<p>Brands</p>
						<table id="table1">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($select->getResult() as $value) {
								?>
								<tr>
									<td><b><?php echo $i ?></b></td>
									<td><?php echo $value['name'] ?></td>
									<td>
										<a id="deletesingle" href="delete_catagory.php?id=<?php echo $value['id'] ?>"><i
												class="fa-solid fa-trash"></i></a>
									</td>
								</tr>
								<?php
									$i++;
								} ?>
							</tbody>
						</table>
					</form>
				</div>



			</div>
		</div>


</body>

</html>