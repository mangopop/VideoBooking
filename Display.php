<?php

class Display {

    function header(){
        echo '<html><head>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
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
        <form class="pure-form pure-form-stacked" id="videoForm">
            <label for="title">Title</label>
            <input id="title" name="title" required type="text"/>
            <label for="rating">Rating</label>
            <input id="rating" name="rating"/>
            <input id="videoSubmit" type="submit" value="Submit" class="pure-button pure-button-primary"/>
        </form>
        ';
    }
    function searchVideoForm(){
        echo '
        <h2>Search Video</h2>
        <form class="pure-form pure-form-stacked" id="searchVideo">
            <input id="title" name="title" required type="text"/>
            <input id="videoSubmit" type="submit" value="Submit" class="pure-button pure-button-primary"/>
        </form>
        ';
    }
    function addCustomerForm($type){
        echo '
        <h2>add Customer</h2>
        <form class="pure-form pure-form-stacked" id="addCustomerForm">
            <label for="firstname">Firstname</label>
            <input id="firstname" required name="firstname" type="text"/>

            <label for="lastname">Last name</label>
            <input id="lastname" required name="lastname" type="text"/>

            <label for="email">Email</label>
            <input id="email" name="email" type="email"/>

            <label for="tel">Telephone</label>
            <input id="tel" name="tel" type="number"/>

            <label for="address">Address</label>
            <input id="address" required name="address" type="text"/>

            <input id='.$type.' type="submit" value="Submit" class="pure-button pure-button-primary"/>
        </form>
        ';
    }
    function searchCustomerForm($type){
        echo '
        <h2>Search Customer</h2>
        <form class="pure-form pure-form-stacked" id="searchCustomerForm">
            <label for="anyField">Search for any field</label>
            <input id="anyField" name="anyField" type="text"/>
            <input id='.$type.' type="submit" value="Submit" class="pure-button pure-button-primary"/>
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
            echo "<tr><td>".$firstname." ".$lastname."</td>";
            echo "<td>".$email."</td>";
            echo "<td>".$tel."</td>";
            echo "<td>".$address."</td>";
            echo "<td>
                <form id='rentalForm'>
                    <input hidden name=".$id."/>
                    <input type='submit' value='rentals' class='pure-button pure-button-primary'/>
                </form>
                </td>";
            echo "</tr>";
    }

}