/**	
*
*	This form will generate leads. This is an ajax driven form.
*
*/
function contactForm()
{	
    //alert("hi..");
	var txtName 				= document.getElementById("txtName").value;
	var txtEmail 				= document.getElementById("txtEmail").value;
	var txtPhone 				= document.getElementById("txtPhone").value;
	var txtMessage 				= document.getElementById("txtMessage").value;
	//alert(txtName);
	var url= "contact-inc.php?txtName=" + escape(txtName) + "&txtEmail=" + escape(txtEmail) + "&txtPhone=" + escape(txtPhone) + "&txtMessage=" + escape(txtMessage);
	
	/*request.open('GET',url,true);*/
	request.open('POST',url,true);
	
	//set up a function to the server when its done
	request.onreadystatechange = getContactResponse;
	
	//writing response while verifying
	document.getElementById('contactPageMsg').innerHTML=
	"<span class='orangeLetter'>" +
	"" + 
	"<span class='padB5'>Loading ... </span></span>";
	
	//send the request
	request.send(null);
}



function getContactResponse()
{
	
	if(request.readyState == 4)
	{
		if(request.status == 200)
		{
			
			//set the form field's values null
			document.getElementById("txtName").value 	= '';
			document.getElementById("txtEmail").value 	= '';
			document.getElementById("txtPhone").value 	= '';
			document.getElementById("txtMessage").value = '';
			//print the response
			var xmlResponse = request.responseText;
			document.getElementById("contactPageMsg").innerHTML = xmlResponse;
			
			
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
