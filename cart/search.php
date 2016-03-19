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
$host="localhost";
$username="root";
$password="root";
$db="rapid"; /* Check write "Database name or login table name"*/
mysql_connect($host,$username,$password)
or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";
 $output="";       
mysql_select_db($db);
if(isset($_POST['Submit'])) {

//$orderid="";
$orderid=$_POST['order'];
//echo $orderid;
/*Check the tablename in following table */
$sql="SELECT *from order_details where order_id='".$orderid."'";

$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
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
	 
	 
	 
}
?>
</body>

</html>
