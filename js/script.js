// reload the page 
const reloadPage = () =>{
    location.reload();
}

const goback = () =>{
    history.back()
}

const goTo = (url) => {
    location.href = url;
}

//delete an html eliment by id
const deleteElement = (elemId) =>{
    document.getElementById(elemId).remove();
}

// email validation 
function ValidateEmail(mailAddress) {

    if (mailAddress == '') {
        alert("Email address can not be blank!");
        return false;
    } else {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (mailAddress.match(validRegex)) {
            return true;
        } else {
            alert("Invalid email address!");
            return false;
        }
    }

}


function validateUrl(urlString) {
    if (urlString == "") {
        alert("Domain Provider Url can not be blank!");
        return false;
    } else {
        let url;
        try {
            url = new URL(urlString);
        } catch (_) {
            alert("Invalid Url Provided")
            return false;
        }
        // return url.protocol === "http:" || url.protocol === "https:";
        return true;
    }
}


function checkUrl(urlString) {
    
    let url;
    try {
        url = new URL(urlString);
    } catch (_) {
        alert("Invalid Url Provided")
        return false;
    }
    // return url.protocol === "http:" || url.protocol === "https:";
    return true;
}



// Text Copy to Clipboard 
const copyText = (fieldId) => {
    var text = document.getElementById(fieldId);
    text.select();
    document.execCommand('copy');
    // alert('Copied');
}


// function afterLoginCard() {
//     window.location.href = "about.php";
// //   location.replace("http://localhost/fastlinky/customer-packages.php")
// }


const getStateList = (t) => {
    let countryId = t.value;

    // alert(`countryId ${countryId}`);
    $.ajax({
        type: "POST",
        url: 'ajax/location.ajax.php',
        data: { countryId: countryId },
        success:function(response){
            // alert(response.trim());
            document.getElementById('stateId').innerHTML = response.trim();
        },
        error:function(error) {
            alert(`Error => ${error}`);
        }
    });
}



const getCitiesList = (t) => {
    let stateId = t.value;
    $.ajax({
        url: "ajax/location.ajax.php",
        type: "POST",
        data: {
            stateId: stateId
        },
        success: function(response) {
            // console.log(response);
            document.getElementById('city').innerHTML = response;
        }
    });
}