$(document).ready(function(){
    $(".alert-danger").hide();
    $(".alert-success").hide();
    //$("#MobileError").hide();
    console.log("jquery connected");
     
  $("#contact_submit").click(function(){
      $(".alert-success-msg").empty();
      $(".alert-danger-msg").empty();
    var formData = new FormData($("#contact_form_data")[0]);
     $("#pre-loader").append('<img src="images/loader/ring-alt.gif" height="32" width="32" class="invisible-preloader"> '); 
    $.ajax({
        //url: window.location.pathname,
        url: 'processrq/contact.php',
        type: 'POST',
        data: formData,
        async: false,
        dataType: "json",
        success: function (result) {
            //alert(data);
            //console.log("success"+data.code+data.response_message+data.name);
           $(".invisible-preloader").css({"display":"none"});  
          if(result.code == 1)
          {
              
             $(".alert-danger").show();
             $(".alert-success").hide();
             $(".alert-danger-msg").append(result.response_message);
              
          }
          else
          {
              $(".alert-danger").hide();
              $(".alert-success").show();
              $(".alert-success-msg").append(result.response_message);
              
          }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });

   // return false;
});  
    
    
  
   
});