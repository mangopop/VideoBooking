<?php


class Video
{

    private $_db;

    public function __construct(Database $db, Display $html)
    {
        $this->_db = $db;
        $this->_html = $html;
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

    function getById($id){
        try {
            $stmt = $this->_db->connect()->prepare("SELECT id, title, rating, stock FROM video WHERE id = :id");
            $stmt->execute(array(':id' => $id));

            //nice, can choose assoc here
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result)) {
                return $result;
            } else {
                echo "No rows returned.";
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
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
                    $stmt = $this->_db->connect()->prepare("SELECT id, title, rating, stock FROM video WHERE title = :title");
                    $stmt->execute(array(':title' => $title));

                    //nice, can choose assoc here
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    //don't want to output here, could I load them into an array and output elsewhere? Would have to be multidimensional
                    if (count($result)) {
                        echo "<table width='100%' class='pure-table pure-table-horizontal'>
                             <thead>
                            <tr><th>Title</th><th>rating</th><th>stock</th><th>edit</th></tr>
                            </thead>
                            <tr>";
                        foreach ($result as $row) {
                            echo "<td>".$row['title']."</td><td>".$row['rating']."</td><td>".$row['stock']."</td>";
                            echo "<td><a href='editVideo.php?id=$row[id]'>Edit<a/></td>";
                        }
                        echo "</tr></table>";
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

    //show all videos that the customer has rented
    function showCustomerVids($cust_id){
        $stmt = $this->_db->connect()->prepare("SELECT id, title FROM video
                                                JOIN customer_rental
                                                ON video.id = customer_rental.video_id
                                                WHERE customer_rental.cust_id = :id");
        $stmt->execute(array('id' => $cust_id));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
            echo "<table class='table' width='100%'>
                <thead>
                <tr><th>Title</th><th>Out date</th><th>In date</th><th>remove</th></tr>
                </thead>";

            foreach ($result as $row) {
                $this->_html->videoTable($row, $cust_id);
            }
            echo "</table>";
            $this->_html->addRentalButton($cust_id);
        } else {
            echo "No rows returned.";
        }
    }



    function update($id,$title,$rating,$stock)
    {

        try {
            $stmt = $this->_db->connect()->prepare("UPDATE video SET title = :title, rating= :rating, stock = :stock WHERE id = :id");
            $stmt->execute(array('id' => $id, 'title' => $title, 'rating' => $rating, 'stock' => $stock));
            echo "success";
        } catch (Exception $e) {
            echo "failed ". $e;
        }

    }

    //delete users video from customer rental table
    function delete($video_id, $cust_id)
    {
        try{
            $stmt = $this->_db->connect()->prepare("DELETE FROM customer_rental WHERE video_id = :video_id AND cust_id = :cust_id");
            $stmt->execute(array('video_id' => $video_id, 'cust_id' => $cust_id));
            echo "success";
        } catch (Exception $e){
            echo "failed ". $e;
        }
    }

}