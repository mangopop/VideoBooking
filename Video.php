<?php


class Video
{

    private $_db;

    public function __construct(Database $db)
    {
        $this->_db = $db;
    }

    function create($title, $rating)
    {
        if($title != "" && strlen($rating) >0 & strlen($rating) < 3){
        //do we need to do try/catch or is this handled with DB?
        //insert into video Title, rating
        $stmt = $this->_db->connect()->prepare("INSERT into video (title,rating) VALUES (:title, :rating)");
        $stmt->execute(array(':title' => $title, ':rating' => $rating));
            echo "<p>Video added.</p>";
        }else{
            echo "<p>constraints not met</p>";
        }
    }

    //TODO look to upgrade this to look for different search fields
    function read($title)
    {
//        switch ($title) {
//            case "title";
                try {
                    //$stmt = $this->_db->connect()->prepare("SELECT * FROM video WHERE :col = :field)");
                    //WHERE title LIKE concat('%', :title, '%')
                    $stmt = $this->_db->connect()->prepare("SELECT title, rating FROM video WHERE title = :title");
                    $stmt->execute(array(':title' => $title));

                    //nice, can choose assoc here
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    if (count($result)) {
                        foreach ($result as $row) {
                            //print_r($row);
                            foreach ($row as $value) {
                                echo "<p>".$value."</p>";
                            }

                        }
                    } else {
                        echo "No rows returned.";
                    }
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
//                break;
//            case "rating";
//                //select * from video where rating = VAR
//                break;
//            default:
//                echo "There is no field found";
//           break;

        }

    function showCustomerVids($id){
        $stmt = $this->_db->connect()->prepare("SELECT * from customer_rental WHERE id = :id");
        $stmt->execute(array('id' => $id));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result)) {
            foreach ($result as $row) {
                foreach ($row as $value) {
                    echo "<p>".$value."</p>";
                }
            }
        } else {
            echo "No rows returned.";
        }
    }

    function update()
    {
        //update video where id = ???

    }

    function delete()
    {
        //delete * from video where id = ???
    }

}