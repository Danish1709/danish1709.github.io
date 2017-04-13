/*$(document).ready(function(){*/
    
    //var code = $("#country_code").val();
    /*function get_code(this)
    {*/
     // var code    =   document.getElementByID("country_code");
       // console.log(code);  
    //}
$(document).ready(function(){
    

    $('#country_code').on('change', function() {
        
        //console.log(this.value);
        $("#contact").val(this.value);
        
    })
    /*function get_country_code(this)
    {
        $("#contact").val(this);
    }*/
})