
/**
*	Java Script function to work with categories and sub categories and title for creating a SEO friendly URL.
*
*	@author     	SafikulIslam
*	@date   	 	25 August 2019
*	@version 		2.0
*	@copyright 		LeeLija
*	@website			leelija.com
*/



function makeServContentSEOURL()
{
	var txtParentId = document.getElementById("ServiceCat").value;
	var txtTitle = document.getElementById("txtTitle").value; 

	var url= "services_content_url.php?txtTitle=" + escape(txtTitle)  + "&txtParentId=" + escape(txtParentId);
	
	request.open('GET',url,true);

	//set up a function to the server when its done
	request.onreadystatechange = showContentSEOURL;

	//send the request
	request.send(null);
}


function showContentSEOURL()
{

	if(request.readyState == 4)
	{

		if(request.status == 200)
		{
			var xmlResponse = request.responseText;

			document.getElementById("txtSEOURL").value = xmlResponse;
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
}//eof

