$(document).ready(function(){

    // $( "#userRegisterBtn" ).click(function(event) {

    //     event.preventDefault();

    //     $(this).attr('disabled', false);
       
            
        
    //   });

 


$('#firstName').keyup(function(){

if($(this).val()==0){

$('#fNameErr').css("display", " block ");
}

else {
$('#fNameErr').css("display", " none ");
}

});


// $('#firstName').keydown(function(){

//   let fnameval=  $(this).val();

//     if(fnameval.length>3){
    
//     $('#fNameErr').css("display", " block ");
//     }
    
//     else {
//     $('#fNameErr').css("display", " none ");
//     }
    
//     });
    






$('#lastName').keyup(function(){

if($(this).val()== 0){

$('#lNameErr').css("display", " block ");
}

else{
$('#lNameErr').css("display", " none ");
}

});


$('#txtemail').keyup(function(){

if($(this).val()== 0){

$('#emailErr').css("display", " block ");
}

else{
$('#emailErr').css("display", " none ");
}

});



$('#txtemail').keyup(function(){

if($(this).val()== 0){

$('#emailErr').css("display", " block ");
}

else{
$('#emailErr').css("display", " none ");
}

});



$('#txtPassword').keyup(function(){

     

    if($(this).val()==0) {
    
    $('#passErr').css("display", " block ");
    }
    
    else{
    $('#passErr').css("display", " none ");
    }
    
    });



$('#txtPasswordConfirm').keyup(function(){

if($(this).val()==0) {

$('#cpassErr').css("display", " block ");
}

else{
$('#cpassErr').css("display", " none ");
}

});



$('#txtPassword, #txtPasswordConfirm').on('keyup', function () {
    if ($('#txtPassword').val() == $('#txtPasswordConfirm').val()) {
      $('#Confirmmessage').html('password is matched now').css('color', 'green');
    } else 
      $('#Confirmmessage').html('password is not matching').css('color', '#8d1111');
  });
  






$('input').keyup(function(){    


 $(this).css("border", " 2px solid green");

if($(this).val()== 0){

$(this).css("border", " 2px solid #AD261F");
}


});



// select


$('select').change(function(){


    $(this).css("border", " 2px solid green");
    
    if($(this).val()== 0){
    
    $(this).css("border", " 2px solid red");
    }
    
    
});


$('#selectCountry').change(function(){

if($(this).val()==0) {

$('#selectCountryErr').css("display", " block ");
}

else{
$('#selectCountryErr').css("display", " none ");
}

});



$('#txtProfession').change(function(){

if($(this).val()==0) {

$('#selectProfessionErr').css("display", " block ");
}

else{
$('#selectProfessionErr').css("display", " none ");
}

});




// $("#regUserForm").validate({

// rules: {
//     firstname: "required"
// },
// messages:{

// }


// })




});





