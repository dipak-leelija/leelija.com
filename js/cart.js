function AddToCart(id, t) {

    let itemId = escape(id);
    $.ajax({
        url: "cart-update.php",
        method: "POST",
        data: {
            action: 'addWishList',
            itemId: itemId,
        },
        success: function(response) {
            alert(response);
            if (response.includes('LOGIN-ERR')){
                alert('Please Login First!');
            }
            if(response.includes('ADDED')){
                // alert('Added to cart!');
                icon = t.childNodes[0].classList;
                icon.remove('far');
                icon.add('fas');
            }
        }
    });
}



// cancel to cart
function CrossToCart(removep) {
    //alert(categories_id);

    var url = "cart_update2.php?removep=" + escape(removep);
    request.open('GET', url, true);

    //set up a function to the server when its done
    request.onreadystatechange = CrossCart;

    //writing response while verifying
    /*	document.getElementById('add_to_cart').innerHTML=
    	"<span class='orangeLetter padT10'>" +
    	"" + 
    	"<span class='padB5'> Loading ... </span></span>";		*/

    //send the request
    request.send(null);
}

function CrossCart() {
    //alert("hi..");
    if (request.readyState == 4) {

        if (request.status == 200) {
            var xmlResponse = request.responseText;
            alert(xmlResponse);
            document.getElementById("shopping-cart").innerHTML = xmlResponse;
        } else if (request.status == 404) {
            alert("Request page doesn't exist");
        } else if (request.status == 403) {
            alert("Request page doesn't exist");
        } else {
            alert("Error: Status Code is " + request.statusText);
        }
    }
} //eof


/* cart popup hide*/
function div_hide() {
    document.getElementById('AddCartPopup').style.display = "none";
}