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
</head>
<body>
<h3 style="text-align:center">View Cart Before Buying</h3>
<?php
phpinfo();
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
	$order_id= mt_rand();
	echo '<p  style="text-align:center"> Order ID:'.$order_id.'</p>';
	
	$total 			= 0;
	$list_tax 		= '';
	$cart_box 		= '<ul class="view-cart">';
	
	
	
//Adding to database 
error_reporting(E_ALL ^ E_DEPRECATED);
$hostname = "localhost";
$username = "root";
$password = "root";
 
// Connection constants
//define('MEMCACHED_HOST', '127.0.0.1');
//define('MEMCACHED_PORT', '11211');

//$memcache = new Memcache;
//$cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);



//connection to the database
foreach($_SESSION["products"] as $product){
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";
$pr_code=$product['code'];
$pr_qty=$product['qty'];
$pr_price=$product['price'];
$pr_name=$product['name'];      

$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");
     
$sql = "INSERT INTO order_details".
      "(order_id,product_id,quantity,price,product_name) ".
       "VALUES ('$order_id','$pr_code','$pr_qty','$pr_price','$pr_name')";
mysql_select_db('rapid');
$retval = mysql_query( $sql, $dbhandle);

if ($retval === true)
{
    // We build a unique key that we can build again later
    // We will use the word 'product' plus our product's id (eg. "product_12")
    $key = $orderid;
 
    // We store an associative array containing our product data
    //$product = array('id' => $id, 'name' => $name, 'description' => $description, 'price' => $price);
	$data[] = array('product ID::'=>$pr_code, 'Product Name'=>$pr_name,'Product Quantity'=>$pr_qty); 	
		
 
    // And we ask Memcached to store that data
    $memcache->set($key, $data);
}


else if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
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
<div style="text-align:center;">
<a href="shopping_cart.php">Update Order</a>
</div>
</body>
</html>