<?php
session_start();
include "database.php";

$order = new Database();

$order->PlaceOrder();