<?php

class Database {

    public $username = 'root';
    public $password = 'root';

    public function __construct(){

    }

    public function connect(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=videoBooking', $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

} 