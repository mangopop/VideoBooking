<?php

include "Video.php";
include "Database.php";
include "Display.php";

//handle AJAX request to show rentals for customer

$db = new Database();
$html = new Display();
$video = new Video($db, $html);

$cust_id = $_GET['id'];

$video->showCustomerVids($cust_id);