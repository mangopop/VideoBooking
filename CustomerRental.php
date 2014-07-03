<?php

class CustomerRental {

    private $_db;

    public function __construct(Database $db)
    {
        $this->_db = $db;
    }

    function showCustomerVids($id){
        $stmt = $this->_db->connect()->prepare("SELECT * from customer_rental WHERE id = :id");
        $stmt->execute(array(':id' => $id));
    }

} 