$(document).ready(function(){
     $('body').on('click','.wishBtn',function(){
        let currentClass, blogId;
        blogId = $(this).attr('id').trim();
        if($(this).hasClass('removeWishlist')){
            currentClass = $(this).hasClass('removeWishlist');
            $(this).toggleClass("caddWishlist removeWishlist").addClass("btnch").removeClass("btn-danger").html("Add To Favourite");
            
        }
        else{
            currentClass= $(this).hasClass('caddWishlist');
            $(this).toggleClass("removeWishlist caddWishlist").addClass("btn-danger").removeClass("btn-success").html("Remove From Favourite");
        }

        let url = `wishlistCore.php?id=${blogId}&type=${currentClass}`;
        
        $.ajax({
            url,
            success: function(res){
                console.log(res);
            }
        })
});
    $('body').on('click','.buyNowFormList',function(){
        let blogId = $(this).attr('id').trim();
        // alert(blogId);

        let url = `wishlistCore.php?id=${blogId}&buy`;
        $.ajax({
            url,
            success:function(res){
                let insertId = parseInt(res.trim());
                // console.log(insertId);
                if(insertId){
                   window.location.href=`webSiteDetailsSingle.php?id=${blogId}`;
                }
                 // console.log(res);
            }
        })
    });
   
    $('body').on('click','.viewDomainDetails',function(){
      let blogId =  $(this).attr('id').trim();
      alert(blogId);
      let url = `wishlistCore.php?id=${blogId}`;


      $.ajax({
          url,
           success: function(res){
            let insertId = parseInt(res.trim());
           }
      })
    });

});//end
       


