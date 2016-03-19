<?php
session_start(); //start session
include("config.inc.php"); //include config file
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ajax Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function(){	
	//Add Item to Cart
	$(".item-box button").click(function(e){ //user click "add to cart" button
		e.preventDefault(); 
		var button_content = $(this); //this triggered button
		var iqty = $(this).parent().children("select.p-qty").val(); //get quantity 
		var icode = $(this).parent().children("input.p-code").val(); //get product code
		button_content.html('Adding...'); //Loading button text 
		//button_content.attr('disabled','disabled'); //disable button before Ajax request
		$.ajax({ //make ajax request to cart_process.php
			url: "cart_process.php",
			type: "POST",
			dataType:"json", //expect json value from server
			data: { quantity: iqty, product_code: icode}
		}).done(function(data){ //on Ajax success
		 	$("#cart-info").html(data.items); //total items in cart-info element
			button_content.html('Add to Cart'); //reset button text to original text
			alert("Item added to Cart!"); //alert user
			if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
				$(".cart-box").trigger( "click" ); //trigger click to update the cart box.
			}
		})
	});
	
	//Show Items in Cart
	$( ".cart-box").click(function(e) { //when user clicks on cart box
		e.preventDefault(); 
		$(".shopping-cart-box").fadeIn(); //display cart box
		$("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
		$("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
	});
	
	//Close Cart
	$( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
		e.preventDefault(); 
		$(".shopping-cart-box").fadeOut(); //close cart-box
	});
	
	//Remove items from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault(); 
		var pcode = $(this).attr("data-code"); //get product code
		$(this).parent().fadeOut(); //remove item element from box
		$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
			$("#cart-info").html(data.items); //update Item count in cart-info
			$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
		});
	});

});
</script>
</head>
<body>
<div align="center">
<h3>Ajax Shopping Cart Example</h3>
</div>

<a href="#" class="cart-box" id="cart-info" title="View Cart">
<?php 
if(isset($_SESSION["products"])){
	echo count($_SESSION["products"]); 
}else{
	echo 0; 
}
?>
</a>

<div class="shopping-cart-box">
<a href="#" class="close-shopping-cart-box" >Close</a>
<h3>Your Shopping Cart</h3>
    <div id="shopping-cart-results">
    </div>
</div>

<?php
//List products from database
$results = $mysqli_conn->query("SELECT product_name, product_desc, product_code, product_image, product_price FROM products_list");
//Display fetched records as you please
echo '<ul class="products-wrp">';
while($row = $results->fetch_assoc()) {
    echo '<li>';
	echo '<h4>'.$row["product_name"].'</h4>';
    echo '<div><img src="images/'.$row["product_image"].'"></div>';
	echo '<div>Price : '. $currency. ' '.$row["product_price"].'<div>';
	
	echo '<div class="item-box">';
		echo 'Qty :';
		echo '<select class="p-qty">';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option>';
		echo '<option value="3">3</option>';
		echo '<option value="4">4</option>';
		echo '<option value="5">5</option>';
		echo '</select>';
		echo '<input class="p-code" type="hidden" value="'.$row["product_code"].'">';
		echo '<button type="submit">Add to Cart</button>';
	echo '</div>';
	
    echo '</li>';
}  
echo '</ul>';

?>
</body>
</html>