<a id="nav-toggle" class="menu-button"><i class="bi bi-list"></i></a>
<div id="navbar" class="navbar">
	<!-- <div class="img">
		<img src="images/logo4.png" alt="">
	</div> -->

	<ul class="cart">
		<?php
		if ($_SESSION['admin_email'] == true) { ?>
		<li class="dropdown">
			<span class="dropbtn"><i class="fa-solid fa-circle-user"></i><b><?php echo $_SESSION['name'] ?> </b></span>
			<div class="dropdown-content">
				<a href="logout.php">Logout</a>
			</div>
		</li>
		<?php
		} ?>
	</ul>

	<ul class="header-side">
		<li><a href="index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
		<li class="dropdown">
			<span class="dropbtn"><i class="fa-solid fa-briefcase"></i> Products &nbsp;&nbsp;<i
					class="fa-solid fa-angle-down"></i></span>
			<div class="dropdown-content">
				<a href="add_products.php" class="dropbtn"><i class="fa-solid fa-plus"></i> Add Products</a>
				<a href="products.php" class="dropbtn"><i class="fa-solid fa-briefcase"></i> Products</a>
			</div>
		</li>
		<li class="dropdown">
			<span class="dropbtn"><i class="fa-solid fa-layer-group"></i> Catagory &nbsp;&nbsp; <i
					class="fa-solid fa-angle-down"></i></span>
			<div class="dropdown-content">
				<a href="add_catagory.php" class="dropbtn"><i class="fa-solid fa-plus"></i> Add</a>
				<a href="catagory.php" class="dropbtn"><i class="fa-solid fa-layer-group"></i> Catagories</a>
			</div>
		</li>
		<li class="dropdown">
			<span class="dropbtn"><i class="fa-solid fa-bars-staggered"></i> Brand &nbsp;&nbsp;<i
					class="fa-solid fa-angle-down"></i></span>
			<div class="dropdown-content">
				<a href="add_brand.php" class="dropbtn"><i class="fa-solid fa-plus"></i> Add</a>
				<a href="brands.php" class="dropbtn"><i class="fa-solid fa-bars-staggered"></i> Brands List</a>
			</div>
		</li>
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