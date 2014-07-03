<?php
include "Video.php";
include "Customer.php";
include "Database.php";
include "Display.php";

$db = new Database();
$html = new Display();

$html->header();
$html->choices();

if($_GET['action']){

    switch($_GET['action']){
        case "addVideo";
            $html->addVideoForm();
            break;
        case "searchVideo";
            $html->searchVideoForm();
            break;
        case "addCustomer";
            $type = "addCustomer";
            $html->addCustomerForm($type);
            break;
        case "searchCustomer";
            $type = "searchCustomer";
            $html->searchCustomerForm($type);
            break;
    }
}

$html->footer();
