<html>
<head>
<title>"Search Order"</title>
</head>
<body>
<form name="search order" action=" " method="POST">
<label for="order">Enter Your OrderID:</label>
<input  id ="order1" type="text" name="order"/>
<input type="submit" name="Submit" value="Search" />
</form>

<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$hostname = "localhost";
$username = "root";
$password = "root";
//$dbname="rapid";
//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password); 
 mysql_select_db('rapid',$dbhandle);
echo "SERVER METHOD: " . $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD'] == "POST"){
// Get post data`
$orderid=isset($_POST['order'])?mysql_real_escape_string($_POST['order']):"";

/*Check the tablename in following table */
$sql="SELECT *from order_details where order_id='".$orderid."'";


$retval = mysql_query($sql);
	if($retval )
	{
		while($row = mysql_fetch_array($retval))
		{
		  $data[] = array('product ID::'=>$row['product_id'], 'Product Name'=>$row['product_name'],'Product Quantity'=>$row['quantity'],'Product Price'=>$row['price']); 	
			
		}
	  
	 // die(json_encode($data));
        } 
	
	else {
	   $data[] = array('Product ID:'=>'wrong product id','Product Name'=>'wrong product name','Product Quantity'=>'wrong product quantity','Product Price'=>'wrong price');	
	}
} 
else {
$data[] = array('product id' =>'cannot proceed', 'product name' =>'cannot proceed');
}
mysql_close($dbhandle);
/* JSON Response */
//header('Content-type:application/json');
echo json_encode($data);
  /*if(mysql_num_rows($result)>0)
     {
	 
	 while($row = mysql_fetch_array($result)){
        $product_id= $row['product_id'];
	$product_name=$row['product_name'];
	$quantity=$row['quantity'];
	$price=$row['price'];
        //print $product_id;
	//print ($product_id);
	echo "<p>Your OrderID is::".$orderid."</p>";
	echo "<p>Your Order Details are</p>";
	echo "<p>Product ID::".$product_id."</p>";
	echo "<p>Product Name::".$product_name."</p>";
	echo "<p>Quantity::".$quantity."</p>";
	echo "<p>Price::".$price."</p>";
	
	
	//$output ='<div> '.$product_id.'</div>';
	//echo $output;
	
	 }
     }
  else {
    echo "Please Return to The previous Page ";  
    exit();
   
  
  }
	 
	 
	 
}*/

?>
</body>

</html>
