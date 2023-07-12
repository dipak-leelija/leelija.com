$(document).ready(function(){
    $('#contentCreationPlacement').click(function(){
        $('.contentPlacement').css('display', 'none');
           $('.contentCreationPlacement').css('display', 'block');
    });
    $('#contentPlaceMent').click(function(){
        $('.contentPlacement').css('display', 'block');
        $('.contentCreationPlacement').css('display', 'none');
    });   
})