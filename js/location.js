// JavaScript Document


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


// ================================================================================

function getTownSearch()
{
	
	if(request.readyState == 4)
	{
		
		if(request.status == 200)
		{
			var xmlResponse = request.responseText;
			
			document.getElementById("txtTownId").innerHTML = xmlResponse;
		}
		else if(request.status == 404)
		{
			alert("Request page doesn't exist");
		}
		else if(request.status == 403)
		{
			alert("Request page doesn't exist");
		}
		else
		{
			alert("Error: Status Code is " + request.statusText);
		}
	}
}