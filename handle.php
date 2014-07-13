<?php

include "Display.php";
include "Video.php";
include "Customer.php";
include "Database.php";

//is there a better way so we don't have to keep including and creating objects?
$db = new Database();
$html = new Display();
$video = new Video($db, $html);
$customer = new Customer($db, $html);


//ajax won't refresh page if already on it and wan't to go back so this will stop working

//pretty sure this isn't going to work the bigger it gets, why not just create some new files?

//create /update
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['type'] == "editVideo"){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $rating = $_POST['rating'];
        $stock = $_POST['stock'];
        $video->update($id, $title, $rating, $stock);
    }
    elseif($_POST['type'] == "deleteVideo"){
        $video_id = $_POST['video_id'];
        $cust_id = $_POST['cust_id'];
        $video->delete($video_id, $cust_id);
    }
    elseif($_POST['type'] == "video"){
        $title = $_POST['title'];
        $rating = $_POST['rating'];
        $video->create($title, $rating);
    }elseif($_POST['type'] == "customer"){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $customer->create($firstname, $lastname, $tel, $email, $address);
    }

}

//read
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if($_GET['type'] == "video"){
        $title = $_GET['title'];
        //$rating = $_POST['rating'];
        $video->read($title);
    }elseif($_GET['type'] == "customer"){
        $anyField = $_GET['anyField'];
        $customer->read($anyField);
    }

}


/* AJAX plan
once the button is clicked send serialised query to the HandleURI.php
wil have to know what form it came from



/* RESTful plan
1. determine the URI
2. determine the method
3. retrieve the data sent via AJAX (not much point doing this if I'm going to a URI?)
4. act on the data according to the URI and the method
*/


//we are able to send receive data as a standard query string or JSON

//echo $_SERVER['REQUEST_METHOD'];
//echo "<br/>";
//echo $_SERVER['REQUEST_URI'];

//for example - to POST/create a video (should be unique)
//curl -v -X PUT http://site/video/ -d '{"title":"Taxi" }

//for example - to PUT/UPDATE a video
//curl -v -X PUT http://site/video/rambo -d '{"title":"Taxi" }

//to request all videos
//curl -v http://site/video/

//to request all videos we can use queries
//curl -v http://site/video?title=rambo

//to delete
//curl -v -X DELETE /clients/elf