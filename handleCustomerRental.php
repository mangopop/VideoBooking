<?php

include "Video.php";
include "Database.php";

//handle AJAX request to show rentals for customer

$db = new Database();
$video = new Video($db);

echo $video->showCustomerVids(1);