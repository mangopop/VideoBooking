$(function() {

    //if we are doing all this funky AJAX could we store the information
    // in a object each time it is returned?

    $('#videoForm').on('submit',function( event ) {
        event.preventDefault();
        console.log($(this).serialize());
        $query = $(this).serialize() + "&type=video";
        $.ajax({
            type:'POST',
            url:'handle.php',
            data: $query
        })
            .done(function(data) {
                alert( "Ajax was called " + data );
                //create pop up window $("#popupMessageSent").css("visibility", "visible");
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });

    });

    $('#editVideoForm').on('submit',function( event ) {
        event.preventDefault();
        //console.log($(this).serialize());
        $query = $(this).serialize();
        $.ajax({
            type:'POST',
            url:'updateVideo.php',
            data: $query
        })
            .done(function(data) {
                console.log(data);
                $('#results').html(data);
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {

            });

    });


    $('#searchVideo').on('submit',function( event ) {
        event.preventDefault();
        console.log($(this).serialize());
        $query = $(this).serialize() + "&type=video";
        $.ajax({
            url:'handle.php',
            data: $query
        })
            .done(function(data) {
                //alert( "success" + data );
                $('#results').html(data);
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });
    });

    $('#addCustomerForm').on('submit',function( event ) {
        event.preventDefault();
        console.log($(this).serialize());
        $query = $(this).serialize() + "&type=customer";
        $.ajax({
            type:'POST',
            url:'handle.php',
            data: $query
        })
            .done(function(data) {
                $('#results').html(data);
                //create pop up window $("#popupMessageSent").css("visibility", "visible");
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });
    });

    $('#searchCustomerForm').on('submit',function( event ) {
        event.preventDefault();
        $name = $(this).serializeArray()[0].value;
        $query = $(this).serialize() + "&type=customer";
        $.ajax({
            url:'handle.php',
            data: $query
        })
            .done(function(data) {
                //how can I access this data in ajax function?
                $('#results').html(data);
                //call this to get JS to hook in
                ajaxRental();
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });
    });


function ajaxRental(){
    $('#rentalForm').on('submit',function( event ) {
        event.preventDefault();
        console.log($(this).serialize());
        $query = $(this).serialize() + "&type=rental";
        $.ajax({
            context:this,
            url:'handleCustomerRental.php',
            data: $query
        })
            .done(function(data) {
                //$(this).closest("tr").after("<tr><td>Video</td><td>Rating</td><td>Other</td></tr>");
                //videos need to be in their own table with a data / returned button
                $('#results').html(data);
                videoRental();
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });
    });
}

function videoRental(){
    $('#videoTableForm').on('submit',function( event ) {
        event.preventDefault();
        console.log($(this).serialize());
        $query = $(this).serialize() + "&type=deleteVideo";
        $.ajax({
            type:'POST',
            url:'handle.php',
            data: $query
        })
            .done(function(data) {
                console.log(data);
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {

            });

    });
}

});