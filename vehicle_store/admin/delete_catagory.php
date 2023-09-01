<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
	header("Location:login.php");
}
include "database.php";
$delete = new Database();

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$delete->delete('catagories', $id);

header("Location:catagory.php");