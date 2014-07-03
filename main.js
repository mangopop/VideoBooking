$(function() {
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
        console.log($(this).serialize());
        $query = $(this).serialize() + "&type=customer";
        $.ajax({
            url:'handle.php',
            data: $query
        })
            .done(function(data) {
                //alert( "success" + data );
                $('#results').html(data);
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
            url:'handleCustomerRental.php',
            data: $query
        })
            .done(function(data) {
                //alert( "success" + data );
                console.log("done");
                $('#results').html(data);
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });
    });
}

});