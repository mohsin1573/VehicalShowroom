<?php

include "database.php";
$user_login = new Database();
$user_login->user_login();




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
	<title>Sign In</title>
</head>

<body>
	<div class="form_register col-12">
		<form id="form_register" action="" method="post">

			<h1>User Sign In</h1>
			<?php if (isset($_GET['error'])) {
			?>
			<small style="color: red;"><b><?php echo "Email or Password is incorrect!"; ?></b></small>
			<?php } ?>
			<input type="hidden" name="status" value="0">
			<label for="">Email</label>
			<input type="email" name="email" placeholder="Email" required>
			<label for="">Password</label>
			<input type="password" name="password" placeholder="Password" required>

			<button class="do_checkout" name="signin" type="submit">Login</button>
		</form>
	</div>
	<a href="register.php" class="do_reg" type="submit">Don't have account?</a>
</body>

</html>