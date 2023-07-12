function PersonalList(blogId, t) {

    var url = "wishlistDataAdd.php?BlogId=" + escape(blogId);
    // alert(url);
    request.open('GET', url, true);

    //set up a function to the server when its done
    request.onreadystatechange = getDescResPersonal;

    request.send(null);
    let action = document.getElementById(`action-${blogId}`);
    // t.classList.remove('far');
    // t.classList.add('fas');

    action.innerHTML = `<a href="javascript:void()" class="fas fa-heart text-danger" style="color:red" title="Remove this Blog Wishlist"
    onclick="RemovePersonalList(${blogId})"></a>`;

}


function getDescResPersonal() {
    // alert(t.classList.remove(''));
    if (request.readyState == 4) {

        if (request.status == 200) {
            var xmlResponse = request.responseText;

            // let result = xmlResponse.includes("Success");
            // if (result) {
            //     // let row = document.getElementById(BlogId).classList;
            //     // alert(row);
            // } else {
            //     alert("Error");
            // }
            document.getElementById('AddRemoveMessage').style.display = "block";

            document.getElementById("AddRemoveMessage").innerHTML = xmlResponse;
            return true;


        } else if (request.status == 404) {
            alert("Request page doesn't exist");
        } else if (request.status == 403) {
            alert("Request page doesn't exist");
        } else {
            alert("Error: Status Code is " + request.statusText);
        }
    }
} //eof




function RemovePersonalList(blogId, t) {

    //alert(meetID);
    //document.getElementById('popup-div').style.display = "block";
    var url = "wishlistDataRemove.php?BlogId=" + escape(blogId);
    request.open('GET', url, true);

    //set up a function to the server when its done
    request.onreadystatechange = getDescResDelete;

    //send the request
    request.send(null);
    // t.classList.remove('fas');
    // t.classList.add('far');
    let action = document.getElementById(`action-${blogId}`);
    // t.classList.remove('far');
    // t.classList.add('fas');

    action.innerHTML = `<a href="javascript:void()" id="<?php echo $row['blog_id']; ?>" class="far fa-heart text-danger" title="Add this Blog to Wishlist" onclick="PersonalList(${blogId})"></a>`;
}


function getDescResDelete() {
    //alert("HERE");
    if (request.readyState == 4) {

        if (request.status == 200) {
            var xmlResponse = request.responseText;
            // alert(request.responseText);
            // var txt = "The Blog has been Removed from My List.";
            //alert(xmlResponse);
            // value passed to the reco-table
            document.getElementById('AddRemoveMessage').style.display = "block";

            document.getElementById("AddRemoveMessage").innerHTML = request.responseText;
        } else if (request.status == 404) {
            alert("Request page doesn't exist");
        } else if (request.status == 403) {
            alert("Request page doesn't exist");
        } else {
            alert("Error: Status Code is " + request.statusText);
        }
    }
} //eof