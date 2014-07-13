<?php
//we can use this files to handle AJAX requests we don't need to use handle as it cannot cope.

include "Display.php";
include "Video.php";
include "Database.php";

$html = new Display();
$db = new Database();
$video = new Video($db,$html);

$id = $_GET['id'];

$videoResult = $video->getById($id);

$title = $videoResult[0]['title'];
$rating = $videoResult[0]['rating'];
$stock = $videoResult[0]['stock'];

$html->header();
$html->choices();

$html->editVideoForm($id,$title,$rating,$stock);

$html->footer();

