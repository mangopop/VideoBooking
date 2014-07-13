<?php

include "Display.php";
include "Video.php";
include "Database.php";

$html = new Display();
$db = new Database();
$video = new Video($db,$html);

$id = $_POST['id'];
$title = $_POST['title'];
$rating = $_POST['rating'];
$stock = $_POST['stock'];

$video->update($id,$title,$rating,$stock);