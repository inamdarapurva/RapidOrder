<?php
session_start(); //start session
include("config.inc.php");

setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Review Created Order Before Buying</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body style="background-image:url('images/view1.png'); background-repeat: no-repeat;background-color:#FFFFCC ">

<?php
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
	$order_id= mt_rand();
	echo '<p  style="text-align:center; font-size:20px;"> Order ID:'.$order_id.'</p>';
	
	$total 			= 0;
	$list_tax 		= '';
	$cart_box 		= '<ul class="view-cart">';
	
	
	
//Adding to database 
error_reporting(E_ALL ^ E_DEPRECATED);
$hostname = "localhost";
$username = "root";
$password = "root";
 
  	

//connection to the database
foreach($_SESSION["products"] as $product){
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$pr_code=$product['code'];
$pr_qty=$product['qty'];
$pr_price=$product['price'];
$pr_name=$product['name'];           
$sql = "INSERT INTO order_details".
      "(order_id,product_id,quantity,price,product_name) ".
       "VALUES ('$order_id','$pr_code','$pr_qty','$pr_price','$pr_name')";
mysql_select_db('rapid');
$retval = mysql_query( $sql, $dbhandle);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
//echo "Entered data successfully\n";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

mysql_close($dbhandle);
}
	
//end of database insert		 
	
	
	foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
		$item_price 	= sprintf("%01.2f",($product["price"] * $product["qty"]));  // price x qty = total item price
		
		$cart_box 		.=  '<li>' . $product["code"]. ' &ndash; ' . $product["name"]. ' (Qty : ' . $product["qty"]. ') <span>' . $currency. $item_price .'</span></li>';
		
		$subtotal 		= ($product["price"] * $product["qty"]); //Multiply item quantity * price
		$total 			= ($total + $subtotal); //Add up to total price
		
		
        	
	}
	
	$grand_total = $total + $shipping_cost; //grand total
	
	foreach($taxes as $key => $value){ //list and calculate all taxes in array
			$tax_amount 	= round($total * ($value / 100));
			$tax_item[$key] = $tax_amount;
			$grand_total 	= $grand_total + $tax_amount; 
	}
	
	foreach($tax_item as $key => $value){ //taxes List
		$list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
	}
	
	$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
	
	//Print Shipping, VAT and Total
	$cart_box .= '<li class="view-cart-total">'.$shipping_cost . $list_tax .'<hr>Payable Amount : '.$currency. sprintf("%01.2f", $grand_total).'</li>';
	$cart_box .= "</ul>";
	
	echo $cart_box;
}else{
	echo "Your Cart is empty";
}
?>
</br>
</br>
</br>
</br>
<div style="text-align:center;" class="container">           
  <a href="shopping_cart.php">
  <button type="button" class="btn btn-info btn-lg">Update Order</button>      
  </a>
  <a href="login.php">
  <button type="button" class="btn btn-info btn-lg">Log In</button>
  </a>
  <a href="payment.php">
  <button type="button" class="btn btn-info btn-lg">Proceed as Guest</button>      
  </a>
  
 </div>

</body>
</html>