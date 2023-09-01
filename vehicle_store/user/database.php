<?php

class Database
{

	private $db_host = "localhost";
	private $db_root = "root";
	private $db_password = "";
	private $db_name = "vehicle_store";
	private $error_login = '';
	private $conn = false;
	private $result = array();

	public function __construct()
	{
		if (!$this->conn) {
			$this->mysqli = new mysqli($this->db_host, $this->db_root, $this->db_password, $this->db_name);
			$this->conn = true;
			if ($this->mysqli->connect_error) {
				array_push($this->result, $this->mysqli->connect_error);
				return false;
			}
		} else {
			return true;
		}
	}

	public function insert($table_name, $param = array())
	{
		$table_columns = implode(', ', array_keys($param));
		$table_values = implode("', '", $param);
		$sql = "INSERT INTO $table_name ($table_columns) VALUES ('$table_values')";

		if ($this->mysqli->query($sql)) {
			array_push($this->result, "Data submitted successfully.");
			return true;
		} else {
			array_push($this->result, "Data did not submitted.");
			return false;
		}
	}

	public function update($table_name, $params = array(), $id)
	{
		$args = array();
		foreach ($params as $key => $value) {
			$args[] = "$key = '$value'";
		}

		$sql = "UPDATE $table_name SET " . implode(', ', $args) . " WHERE id='$id'";

		if ($this->mysqli->query($sql)) {
			array_push($this->result, "Record Updated successfully.");
			return true;
		} else {
			array_push($this->result, "Record was not Updated.");
			return false;
		}
	}


	public function delete($table_name, $id)
	{
		$sql = "DELETE FROM $table_name WHERE id='$id'";

		if ($this->mysqli->query($sql)) {
			array_push($this->result, "Record deleted successfully.");
			return true;
		} else {
			array_push($this->result, "Record was not deleted.");
			return false;
		}
	}

	public function select($table, $rows = "*", $join = null, $where = null, $order = null, $limit = null)
	{
		// Create query from the variables passed to the function
		$sql = "SELECT $rows FROM $table";
		if ($join != null) {
			$sql .= " JOIN $join";
		}
		if ($where != null) {
			$sql .= " WHERE $where";
		}
		if ($order != null) {
			$sql .= " ORDER BY $order";
		}
		if ($limit != null) {
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			$start = ($page - 1) * $limit;
			$sql .= " LIMIT $start,$limit";
		}

		$query = $this->mysqli->query($sql);

		if ($query) {
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true; // Query was successful
		} else {
			array_push($this->result, $this->mysqli->error);
			return false; // No rows were returned
		}
	}


	// FUNCTION to show Pagination
	public function pagination($table, $join = null, $where = null, $order = null, $limit = null)
	{
		// Check to see if table exists

		if ($limit != null) {
			// select count() query for pagination
			$sql = "SELECT COUNT(*) FROM $table";
			if ($join != null) {
				$sql .= " JOIN $join";
			}
			if ($where != null) {
				$sql .= " WHERE $where";
			}

			$query = $this->mysqli->query($sql);

			$total_record = $query->fetch_array();
			$total_record = $total_record[0];

			$total_page = ceil($total_record / $limit);

			$url = basename($_SERVER['PHP_SELF']);
			// Get the Page Number which is set in URL
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			// show pagination
			$output = "<div class='pagination'>";

			if ($page > 1) {
				$output .= "<a href='$url?page=" . ($page - 1) . "'>&laquo;</a>";
			}

			if ($total_record > $limit) {
				for ($i = 1; $i <= $total_page; $i++) {
					if ($i == $page) {
						$cls = "class='active'";
					} else {
						$cls = "";
					}
					$output .= "<a $cls href='$url?page=$i'>$i</a>";
				}
			}
			if ($total_page > $page) {
				$output .= "<a href='$url?page=" . ($page + 1) . "'>&raquo;</a>";
			}
			$output .= "</div>";

			echo $output;
		} else {
			return false; // If Limit is null
		}
	}


	// Fetch all record with no extra classes..

	public function sql_select($sql)
	{
		$query = $this->mysqli->query($sql);

		if ($query) {
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true;
		} else {
			array_push($this->result, "An error occured");
			return false;
		}
	}

	public function catag_select($sql)
	{
		$query = $this->mysqli->query($sql);

		if ($query) {
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true;
		} else {
			array_push($this->result, "An error occured");
			return false;
		}
	}

	public function brand_select($sql)
	{
		$query = $this->mysqli->query($sql);

		if ($query) {
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true;
		} else {
			array_push($this->result, "An error occured");
			return false;
		}
	}

	public function search_select($sql)
	{
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true;
		} else {
			array_push($this->result, "An error occured");
			return false;
		}
	}


	public function getResult()
	{
		$message = $this->result;
		$this->result = array();
		return $message;
	}


	public function user_login()
	{
		$error_login = "";
		$status = '';
		$email = '';
		$password = '';
		if (isset($_POST["signin"])) {
			$status = $_POST["status"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$sql = "SELECT * FROM `users` WHERE email='$email' AND password='$password' AND status='$status'";
			$query = $this->mysqli->query($sql);
			$rowcount = mysqli_num_rows($query);
			$row = mysqli_fetch_array($query);


			if ($rowcount == 1) {
				session_start();
				$_SESSION["name"] = $row["name"];
				$_SESSION["id"] = $row["id"];
				$_SESSION["user_email"] = $email;
				header("location: index.php");
			} else {
				$error_login = "The Email or Password is incorrect";
				header("Location:login.php?error");
			}
		}
	}

	public function logout()
	{
		session_start();
		session_destroy();
		header("location:index.php");
	}





	public function cart()
	{
		$message = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (isset($_POST['add_to_cart'])) {

				$quantity = $_POST['Qty'];

				if (isset($_SESSION['cart'])) {
					$myitems = array_column($_SESSION['cart'], 'item_name');
					if (in_array($_POST['item_name'], $myitems)) {
						$_SESSION['message'] = "This item Already Added!";
						header("Location:index.php");
					} else {
						$count = count($_SESSION['cart']);
						$_SESSION['cart'][$count] = array(
							'item_name' => $_POST['item_name'], 'price' => $_POST['price'], 'Quantity' => $quantity,
							'pr_id' => $_POST['pr_id'], 'catagory' => $_POST['catagory'], 'brand' => $_POST['brand'],
						);
						$_SESSION['message'] = "Added Successfully!";
						header("Location:index.php");
					}
				} else {
					$_SESSION['cart'][0] = array(
						'item_name' => $_POST['item_name'], 'price' => $_POST['price'], 'Quantity' => $_POST['Qty'],
						'pr_id' => $_POST['pr_id'], 'catagory' => $_POST['catagory'], 'brand' => $_POST['brand']
					);
					$_SESSION['message'] = "Added Successfully!";
					header("Location:index.php");
				}
			}



			// Remove

			if (isset($_POST['remove_item'])) {
				foreach ($_SESSION['cart'] as $key => $value) {
					$prod_name = $_POST['item_name'];
					if ($value['item_name'] == $prod_name) {
						$product_ID = $_POST["id"];
						unset($_SESSION['cart'][$key]);
						$_SESSION['cart'] = array_values($_SESSION['cart']);
					}
				}
			}

			// Update quantity in cart

			if (isset($_POST['Qty_update'])) {
				foreach ($_SESSION['cart'] as $key => $value) {
					if ($value['item_name'] == $_POST['item_name']) {
						$_SESSION['cart'][$key]['Quantity'] = $_POST['Qty_edit'];
					}
				}
			}
		}
	}

	// Place order/ do chechout


	public function PlaceOrder()
	{
		$item_name = "";
		$catagory = "";
		$brand = "";
		$quantity = "";
		$price = "";
		if (isset($_POST["placeOrder"])) {
			if (count($_SESSION['cart']) > 0) {
				$sql = "INSERT INTO `order_customer`(`first_name`,`last_name`,`email`, `phone`, `address`,`date`,`type`)
VALUES ('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[phone]','$_POST[address]',NOW(),'$_POST[reg_or_not]')";
				$query = $this->mysqli->query($sql);
				if ($query) {
					$sale_id = $this->mysqli->insert_id;

					$sql1 = "INSERT INTO `orders`(`sale_id`, `name`, `quantity`, `catagory`, `brand`, `price`) VALUE (?,?,?,?,?,?)";
					$stmt = $this->mysqli->prepare($sql1);
					if ($stmt) {
						$stmt->bind_param(
							'isssss',
							$sale_id,
							$item_name,
							$quantity,
							$catagory,
							$brand,
							$price,
						);
						foreach ($_SESSION['cart'] as $key => $data) {
							$item_name = $data['item_name'];
							$catagory = $data['catagory'];
							$brand = $data['brand'];
							$quantity = $data['Quantity'];
							$price = $data['price'];
							$stmt->execute();
						}
						unset($_SESSION['cart']);
						$_SESSION['message'] = "Order Placed Successfully!";
						header("Location:index.php");
						header("Location:index.php");
					} else {

						header("Location:index.php");
					}
				}
			} else {

				header("Location:index.php");
			}
		} else {

			header("Location:index.php");
		}
	}


	public function __destruct()
	{
		if ($this->conn) {
			if ($this->mysqli->close()) {
				$this->conn = false;
				return true;
			}
		} else {
			return false;
		}
	}
}