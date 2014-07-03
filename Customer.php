<?php



class Customer{

    private $_db;
    private $_display;

    //should I pass in the display class so it can be used here?
    public function __construct(Database $db, Display $display){
        $this->_db = $db;
        $this->_display = $display;
    }


    function create($firstname, $lastname, $email, $tel, $address){
        //check that record doesn't already exist
        $dupstmt = $this->_db->connect()->prepare("SELECT * FROM customer WHERE tel = :tel AND email = :email");
        $dupstmt->execute(array(':tel' => $tel, ':email' => $email));
        $dupresult = $dupstmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($dupresult) > 0) {
            echo "<P>There is a duplicate entry</P>";
        } else {
            //insert record
            $stmt = $this->_db->connect()->prepare(
            "INSERT into customer (firstname,lastname,email,tel,address)
            VALUES (:firstname, :lastname, :email, :tel, :address)");
            $stmt->execute(array(':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':tel' => $tel, ':address' => $address));
            echo "<P>Customer added.</P>";
        }
    }

    function read($arg){
        $stmt = $this->_db->connect()->prepare("SELECT id, firstname, lastname, tel, email, address FROM customer WHERE firstname LIKE concat('%', :arg, '%')");
        $stmt->execute(array(':arg' => $arg));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
            echo "</br>";
            echo "<table width='100%' class='pure-table pure-table-horizontal'>";
            echo "<thead>";
            echo "<th>Name</th><th>Email</th><th>Tel</th><th>Address</th><th></th></tr>";
            echo "</thead>";

            foreach ($result as $row) {
                echo $this->_display->customerTable($row['firstname'],$row['lastname'], $row['tel'],$row['email'],$row['address'],$row['id']  );
            }
            echo "</table>";
            echo "</br>";
        } else {
            echo "<p>No rows returned.</p>";
        }

    }

    function update(){
        //update Customer where id = ???

    }
    function delete(){
        //delete * from Customer where id = ???
    }

} 