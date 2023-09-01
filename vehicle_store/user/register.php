<?php

include "database.php";
$insert = new Database();

$error = "";

if (isset($_POST['submit'])) {
	$status = $_POST['status'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$insert->insert('users', ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => $phone, 'password' => $password, 'status' => $status]);

	header("Location:login.php");
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
	<title>Register</title>
</head>

<body>
	<div class="form_register col-12">
		<form id="form_register" action="register.php" method="post">

			<h1>Sign Up</h1>
			<input type="hidden" name="status" value="0">
			<label for="">First Name</label>
			<input type="text" name="fname" placeholder="Your First Name" required>
			<label for="">Last Name</label>
			<input type="text" name="lname" placeholder="Your Last Name">
			<label for="">Email</label>
			<input type="email" name="email" placeholder="Email" required>
			<label for="">Phone</label>
			<input type="text" name="phone" placeholder="Your Name" required>
			<label for="">Password</label>
			<input type="password" name="password" placeholder="Password" required>
			<button class="do_checkout" name="submit" type="submit">Register</button>
		</form>
	</div>
	<a href="login.php" class="do_reg" type="submit">Already registered ?</a>
</body>

</html>