var currentPath = window.location.href;
// Go back by one directory
let sellerPath = currentPath.substring(0, currentPath.lastIndexOf('/'));
//Go to root path from seller path
let rootPath = sellerPath.substring(0, sellerPath.lastIndexOf('/')+1);


// Switch to seller
$(document).ready(function() {
    $('#toSeller').click(function() {
        urlCustomerSwap = `${rootPath}seller/`;
        $.ajax({
            url: "customerSwap.php",
            type: "GET",
            data: {
                seller: "seller"
            },
            success: function(response) {
                if (response != true) {
                    alert(response);
                }
                window.location.href = urlCustomerSwap;
            }
        });
    })
});


// Switch to client
$(document).ready(function() {

    $('#toClient').click(function() {
        urlCustomerSwap = `${rootPath}user/app.client.php`;
        $.ajax({
            url: 'customerSwap.php',
            type: "GET",
            data: {
                client: "client"
            },
            success: function(response) {
                if (response != true) {
                    alert(response);
                }
                window.location.href = urlCustomerSwap;
            }
        });
    });

});