<?php

class Display {

    function header(){
        echo '<html><head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="main.css">
        <script src="jquery.js"></script>
        <script src="main.js"></script>
        </head>';
        echo '<body><h1>Video booking form</h1>';

    }
    function footer(){
        echo '<div id="results"></div>';
        echo '</body></html>';
    }

    function addVideoForm(){
        echo '
        <h2>add Video</h2>
        <form role="form" id="videoForm">
        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" class="form-control" name="title" required type="text"/>
         </div>
         <div class="form-group">
            <label for="rating">Rating</label>
            <input id="rating" class="form-control" name="rating"/>
         </div>
            <input id="videoSubmit" type="submit" value="Submit" class="btn btn-primary"/>
        </form>
        ';

    }

    //here's a good example of not have to reload the page? Perhaps AJAX should be used sparingly!!
    function editVideoForm($id,$title,$rating,$stock){
        echo '
        <h2>edit Video</h2>
        <form class="pure-form pure-form-stacked" id="editVideoForm" method="POST">
            <input hidden name="id" value="'.$id.'" type="text"/>
            <label for="title">Title</label>
            <input id="title" name="title" value="'.$title.'" required type="text"/>
            <label for="rating">Rating</label>
            <input id="rating" value="'.$rating.'" name="rating"/>
            <label for="stock">stock</label>
            <input id="stock" value="'.$stock.'" name="stock"/>
            <input id="editVideo" type="submit" value="Save" class="btn btn-primary"/>
        </form>
        ';
    }

    function searchVideoForm(){
        echo '
        <h2>Search Video</h2>
        <form class="pure-form pure-form-stacked" id="searchVideo">
            <input id="title" name="title" required type="text"/>
            <input id="videoSubmit" type="submit" value="Submit" class="btn btn-primary"/>
        </form>
        ';
    }
    function addCustomerForm($type){
        echo '
        <h2>add Customer</h2>
        <form role="form" id="addCustomerForm">
        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input id="firstname" class="form-control" required name="firstname" type="text"/>
        </div>
        <div class="form-group">
            <label for="lastname">Last name</label>
            <input id="lastname" class="form-control" required name="lastname" type="text"/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" name="email" type="email"/>
        </div>
        <div class="form-group">
            <label for="tel">Telephone</label>
            <input id="tel" class="form-control" name="tel" type="number"/>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input id="address" class="form-control" required name="address" type="text"/>
        </div>

            <input id='.$type.' type="submit" value="Submit" class="btn btn-primary"/>
        </form>
        ';
    }

    //TODO remove anyField
    function searchCustomerForm($type){
        echo '
        <h2>Search Customer</h2>
        <form class="pure-form pure-form-stacked" id="searchCustomerForm">
            <label for="anyField">Search for any field</label>
            <input id="anyField" name="anyField" type="text"/>
            <input id='.$type.' type="submit" value="Submit" class="btn btn-primary"/>
        </form>
        ';
    }

    function choices(){
        echo "
        <div>
            <P><a href='index.php?action=addVideo'>add video</a></P>
            <P><a href='index.php?action=searchVideo'>search video</a></P>
            <P><a href='index.php?action=addCustomer'>add customer</a></P>
            <P><a href='index.php?action=searchCustomer'>search customer</a></P>
        </div>
        ";
    }

    //MVC so much better! must use in the future!
    function customerTable($firstname,$lastname,$tel,$email,$address,$id){
            echo "<tr><td>".$firstname." ".$lastname."</td>
            <td>".$email."</td>
            <td>".$tel."</td>
            <td>".$address."</td>
            <td>
                <form id='rentalForm'>
                    <input hidden name='id' value=".$id."/>
                    <input type='submit' value='rentals' class='btn btn-primary'/>
                </form>
            </td>
            </tr>";
    }

    function rentalBox(){
        echo "<div id='rentalBox'></div>";
    }

    function addRentalButton($id){
        echo"<form id='custVidsForm'>
                <input hidden name='id' value=".$id."/>
                <input id='addNewRental' type='button' value='Add new rental' class='btn btn-primary' />
              </form>";
    }


    function videoTable($row,$cust_id){
            echo "<tr><td>".$row['title']."</td><td>in date here</td><td>out date here</td>
                <td>
                    <form id='videoTableForm'>
                       <input hidden name='video_id' value=".$row['id']."/>
                       <input hidden name='cust_id' value=".$cust_id."/>
                       <input type='submit' value='remove' class='btn btn-primary'/>
                    </form>
                </td>
                </tr>

              ";
    }
}