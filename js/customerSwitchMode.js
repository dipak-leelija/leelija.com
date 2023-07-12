// Switch to seller 
$(document).ready(function() {

    $('#toSeller').click(function() {
        urlCustomerSwap = "dashboard.php";
        $.ajax({
            url: 'customerSwap.php',
            type: "GET",
            data: {
                seller: "seller"
            },
            success: function(data) {
                window.location.href = urlCustomerSwap;
            }
        });

    })

});


// Switch to client
$(document).ready(function() {

    $('#toClient').click(function() {
        urlCustomerSwap = "app.client.php";
        $.ajax({
            url: 'customerSwap.php',
            type: "GET",
            data: {
                client: "client"
            },
            success: function(data) {
                window.location.href = urlCustomerSwap;
            }
        });
    });

});