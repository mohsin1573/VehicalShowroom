<?php

class Database
{

	private $db_host = "localhost";
	private $db_root = "root";
	private $db_password = "";
	private $db_name = "vehicle_store";

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


	public function select($table, $rows = "*", $where = null, $order = null)
	{
		$sql = "SELECT $rows FROM $table";

		if ($where != null) {
			$sql .= "WHERE $where";
		}
		if ($order != null) {
			$sql .= " ORDER BY $order";
		}

		$query = $this->mysqli->query($sql);

		if ($query) {
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true;
		} else {
			array_push($this->result, "An error occured");
			return false;
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


	public function getResult()
	{
		$message = $this->result;
		$this->result = array();
		return $message;
	}



	public function admin_login()
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
				$_SESSION["name"] = $row['first_name'] . " " . $row['last_name'];
				$_SESSION["id"] = $row["id"];
				$_SESSION["admin_email"] = $row["email"];
				header("location: index.php");
			} else {
				header("Location:login.php?error");
			}
		}
	}

	public function logout()
	{
		session_start();
		session_destroy();
		header("location:login.php");
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