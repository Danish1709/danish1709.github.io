 $(document).ready(function(){
    var $temp = $('.pr13').html();
    alert($temp);

	 
	 
// getCakeSizePrice() finds the price based on the size of the cake.
// Here, we need to take user's the selection from radio button selection
function getCakeSizePrice()
{  
   var text = document.getElementById("callbackPrice13").value;
     return text;
//This function finds the filling price based on the 
//drop down selection
function getFillingPrice()
{
    var text1 = document.getElementById("callbackPrice12").value;
     return text1;
}

//candlesPrice() finds the candles price based on a check box selection



        
function calculateTotal()
{
    //Here we get the total price by calling our function
    //Each function returns a number so by calling them we add the values they return together
    var cakePrice = getCakeSizePrice() + getFillingPrice();
    
    //display the result
    var divobj = document.getElementById('totalPrice');
    divobj.style.display='block';
    divobj.innerHTML = "Total Price For the Cake $"+cakePrice;

}

function hideTotal()
{
    var divobj = document.getElementById('totalPrice');
    divobj.style.display='none';
}