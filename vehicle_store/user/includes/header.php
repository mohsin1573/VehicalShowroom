<?php
$select_catag = new Database();
$select_brand = new Database();

$select_catag->sql_select("SELECT * FROM catagories");
$select_brand->sql_select("SELECT * FROM brands");

?>
<a id="nav-toggle" class="menu-button"><i class="bi bi-list"></i></a>
<div class="logo">
	<img src="images/logo1.png" alt="">
	<div class="contact-info">
		<p><i style="color:#567d8c;" class="fa-solid fa-clock"></i> 24/7 Sales and Support</p>
		<p><i style="color:blue;" class="fa-solid fa-phone"></i> +92 42 4570198</p>
		<p><i style="color:green;" class="fa-brands fa-whatsapp-square"></i> +92 312 9199593 </p>
	</div>
</div>
<div id="navbar">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li class="dropdown">
			<span class="dropbtn">Catagory <i class="fa-solid fa-angle-down"></i></span>
			<div class="dropdown-content">
				<?php
				foreach ($select_catag->getResult() as $catag) {
				?>
				<a href="index.php?catagid=<?php echo $catag['name'] ?>" class="dropbtn"><?php echo $catag['name'] ?></a>
				<?php } ?>
			</div>
		</li>
		<li class="dropdown">
			<span class="dropbtn">Brands <i class="fa-solid fa-angle-down"></i></span>
			<div class="dropdown-content">
				<?php
				foreach ($select_brand->getResult() as $brand) {
				?>
				<a href="index.php?brandid=<?php echo $brand['name'] ?>" class="dropbtn"><?php echo $brand['name'] ?></a>
				<?php } ?>
			</div>
		</li>
		<li><a href="">About Us</a></li>
		<li><a href="">Contact Us</a></li>
		<ul class="cart">
			<?php if (isset($_SESSION['cart'])) {
			?>
			<li><a href="user/../cart.php"><i class="fa-solid fa-cart-shopping"></i><span class="sup"><sup><b>
								<?php if (isset($_SESSION['cart'])) {
									?> ( <?php echo count($_SESSION['cart']) ?> )
								<?php } else {
									?>
								( 0 )
								<?php
									}

									?>
							</b></sup></span></a></li>
			<?php } else {
			?>
			<li><a style="cursor:not-allowed; color:gainsboro;" href="#" disabled><i
						class="fa-solid fa-cart-shopping"></i><span class="sup"><sup><b>( 0
								)</b></sup></span></a></li>
			<?php
			} ?>
			<?php

			if (isset($_SESSION['user_email'])) { ?>
			<li class="dropdown">
				<span class="dropbtn"><b><?php echo $_SESSION['user_email'] ?> </b><i class="fa-solid fa-angle-down"></i></span>
				<div class="dropdown-content">
					<a href="logout.php">Logout</a>
				</div>
			</li>
			<?php
			} else {
				// $_SESSION['email'] = '';
			?>
			<li><a class="login" href="login.php">Log In</a></li>
			<li><a class="login" href="register.php">Register</a></li>
			<?php } ?>
		</ul>
	</ul>
</div>


<script>
var toggler = document.getElementById("nav-toggle");
var navbar = document.getElementById("navbar");
toggler.addEventListener('click', () => {
	if (navbar.style.display === 'none') {
		navbar.style.display = 'block';
	} else {
		navbar.style.display = 'none';
	}
});
</script>

<script>
window.onscroll = function() {
	myFunction()
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
	if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	} else {
		navbar.classList.remove("sticky");
	}
}
</script>