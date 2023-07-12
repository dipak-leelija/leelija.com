$(document).ready(function(){
    $("#packagePayPal").click(function(e){
        e.preventDefault();

    var package_id = $("#package_id").html();
    var niche = $("#niche-choosed").html();
    var customerId  = $(".package-order").attr("id");
    var name  = $("#package-name").val();
    var email = $("#package-email").val();
    var addrs = $("#package-add").val();
    var zipCo = $("#package-pin").val();
    var cntry = $("#packageCountry").val();
    var notes = $("#package-Note").val();
    var paymentType= "paypal";
    // var customer = $("#welcome-client").html();
    // var customerId  = $(".package-order").attr("id");

    //var formData = 'name='+name+'&email='+email+'&addrs='+addrs+'&zipCo='+zipCo+'&cntry='+cntry+'&notes='+notes+'&niche='+niche+'&packId='+package_id+'&customer='+customer+'&custId='+customerId+'&payType='+typeOfPayment;

    var formData = `package_id=${package_id}&niche=${niche}&customerId=${customerId}&name=${name}&email=${email}&addrs=${addrs}&zipCo=${zipCo}&cntry=${cntry}&notes=${notes}&paymentType=${paymentType}`;

    // console.log(`insert-package-order.php?${formData}`);
    
    $.ajax({
        url:'insert-package-order.php?'+formData,
        success: function(msg){
            
            document.location.href = 'guest-posting-order.php';
            // console.log(msg);
            // alert(msg);
        }
        });
    });
    $("#btn-cc-dc").click(function(e){
              e.preventDefault();

              document.location.href = 'guest-posting-order-cc-dc.php';
    })
        
        
});

