$(document).ready(function(){
    //var display_error = "display-hide";
  //$(".display_errorr").prepend("display-hide");
    
    $(".alert-danger").hide();
    $(".alert-success").hide();
    //$("#MobileError").hide();
    console.log("jquery connected");
     
  $("#career_submit").click(function(){
      $(".alert-success-msg").empty();
      $(".alert-danger-msg").empty();
    var formData = new FormData($("#career_form_data")[0]);
     $("#pre-loader").append('<img src="images/loader/ring-alt.gif" height="32" width="32" class="invisible-preloader"> '); 
    $.ajax({
        //url: window.location.pathname,
        url: 'processrq/careers.php',
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
    
    
    
    
    /*$("#career_submit").click(function(){
        
        $(".alert-success-msg").empty();
        $(".alert-danger-msg").empty();
        //$(".alert").empty();
        //var success = $(".alert-success").text();
       
    $.ajax({      
      data: $("#career_form_data").serialize(),
     url:"processrq/careers.php",
      method:"post",
      dataType: "json",
      success:function(result)
      {
         */
          
          
          
          
          /*console.log(result.message);
          console.log(result.name);
          
          var error   = $(".alert-danger").text();
          if(result.code == 1)
          {
                $(".alert-danger").show();
                $(".alert-success").hide();
                $(".alert-danger").append(result.response_message);
                $("#MobileErrorMsg").empty();
                $("#MobileError").show();
                $("#MobileErrorMsg").append(result.mobile_err);
              
          }
          else
          {
                console.log(success.length);
                $(".alert-danger").hide();
                $(".alert-success").show();
                $(".alert-success").append(result.response_message);
                $("#name").val(result.name);
                $("#email").val(result.email);
                $("#mobile").val(result.mobile);
                $("#message").val(result.message);
          }*/
          
          
      /*},
      error:function()
      {
          console.log("error");
      }
    });  
 
        
    });*/
    
        /*$('#mobile').keyup(function(){
            var mobile = /^\(?([7-9]{1})\)?([0-9]{9})$/;
            var x =$(this).val();
            
            
            if(x.match(mobile))
            {
    		    $(this).css({
                        "border": "",
                        "background": ""
                        });
                $("#MobileError").hide();
                if(x.length==10)
                {
				
                    
               
                }
                
            }
            else
            {
                
                  //alert("Error");
                
                if(x.match(/^[a-zA-Z]+$/))
                {
                    $(this).css({
                            "border": "1px solid red",
                            });
                        $("#MobileErrorMsg").empty();
                        $("#MobileError").show();
                        $("#MobileErrorMsg").append("Must consist of numbers only");
                
                }
                else if(x.match(mobile))
                {
                    if(x.length<10)
                    {
                        $(this).css({
                            "border": "1px solid red",
                        });
                        $("#MobileErrorMsg").empty();
                        $("#MobileError").show();
                        $("#MobileErrorMsg").append("Mobile Must consist 10 Numbers");
                    }
                }
                else
                {
                    if(x.length==0)
            {
				$(this).css({
                        "border": "",
                        "background": ""});
                       $("#MobileError").hide();
            }   //alert("Error");
                else
                    {
                    $(this).css({
                            "border": "1px solid red",
                        });
                        $("#MobileErrorMsg").empty();
                        $("#MobileError").show();
                        $("#MobileErrorMsg").append("Invalid Mobile Number");
                    }
                }
            }
            
            
            
            
        });
    */
   
});