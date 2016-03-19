<?php
session_start(); //start session
include_once("config.inc.php"); //include config file
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
############# add products to session #########################
if(isset($_POST["quantity"]) && isset($_POST["product_id"]))
{
	$product_code   = filter_var($_POST["product_id"], FILTER_SANITIZE_STRING); //product code
	$product_qty    = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT); //product quantity
	$product 		= array();
	$found 			= false;
	//fetch item from Database using product code
	$statement = $mysqli_conn->prepare("SELECT product_name, price FROM product WHERE product_id=? LIMIT 1");
	$statement->bind_param('s', $product_code);
	$statement->execute();
	$statement->bind_result($product_name, $product_price);
	
	while($statement->fetch()){

		$new_product = array( array('name'=> $product_name, 'price'=> $product_price, 'code'=>$product_code, 'qty'=>$product_qty)); //prepare new product
		if(isset($_SESSION["products"]))
        {
            foreach ($_SESSION["products"] as $cart_itm)  //loop though items
            {
				if($cart_itm["code"] == $product_code){ //if item found in the list, update with new Quantity
					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 'price'=> $cart_itm["price"]);
                    $found = true;
		    
                }else{
                   	//else continue with other items
				    $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=> $cart_itm["price"]);
                }
            }
            if(!$found){ //we did not find item, merge new product to list
                $_SESSION["products"] = array_merge($product, $new_product);
	         }else{
				$_SESSION["products"] = $product; //create new product list
            }
            
        }else{ //if there's no session variable, create new
            $_SESSION["products"] = $new_product;
			die(json_encode(array('items'=>1)));
        }
	}
	$total_items = count($_SESSION["products"]); //count items in variable
	die(json_encode(array('items'=>$total_items))); //exit script outputing json data
}

################## list products in cart ###################
if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1)
{
	if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
		$cart_box = '<ul class="cart-products-loaded">';
		$total = 0;
		foreach($_SESSION["products"] as $product){ //loop though items and prepare html content
			$cart_box .=  '<li>' . $product["name"]. ' (Qty : ' . $product["qty"]. ') &mdash; ' . $currency. sprintf("%01.2f", ($product["price"] * $product["qty"])). ' <a href="#" class="remove-item" data-code="'.$product["code"].'">&times;</a></li>';
			$subtotal = ($product["price"] * $product["qty"]);
			$total = ($total + $subtotal);
			
		}
		$cart_box .= "</ul>";
		$cart_box .= '<div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="view_cart_1.php" title="Review Cart and Check-Out">Check-out</a></u></div>';
		die($cart_box); //exit and output content
	}else{
		die("Your Cart is empty"); //we have empty cart
	}
}

################# remove item from shopping cart ################
if(isset($_GET["remove_code"]) && isset($_SESSION["products"]))
{
    $product_code   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove
    $product = array();
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
    {
		if($cart_itm["code"]!= $product_code){ //item does,t exist in the list
            $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
        }
		$_SESSION["products"] = $product;
    }

 	$total_items = count($_SESSION["products"]);
	die(json_encode(array('items'=>$total_items)));
}