<?php
error_reporting(E_ALL ^ E_DEPRECATED); 
$host="localhost";
$username="root";
$password="root";
$db="rapid"; /* Check write "Database name or login table name"*/
mysql_connect($host,$username,$password);
mysql_select_db($db);
if(isset($_POST['submit'])) {

$cardname=$_POST['cardname'];
//$pass=$_POST['pass'];
/*Check the tablename in following table */
$sql="SELECT * from payment where cardholder_name='".$cardname."'";
/*I have changed variable name below */
$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
     {
	   echo "Payment Successful";
	   exit();
	 }
  else {
    echo "This User does not exist";  
    exit();
   
  
  }
	 
	 
	 
}


?>



<!DOCTYPE html>
		<head>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<style>
	body {
    margin-left: auto;
    margin-right: auto;
	width:50%;
	}
	h1{
	text-align:center;
	}
	</style>
<script>
function myFunction() {
    alert("Your Payment is Submitted :-)");
}
	</script>			
		<title></title>
</head>
	<body>
<div class="container" style="background-color:#FFFFCC;width:750px; height:500px;" >
    <div class="col-sm-6>
         <form id="payment" class="form-horizontal" method="post" action="payment.php">
            <h1>Payment</h1>
            <div class="control-group">
                <label label-default="" class="control-label">Card Holder's Name</label>
                <div class="controls">
                    <input type="text" name="cardname" class="form-control" pattern="\w+ \w+.*" title="First and last name" required="">
                </div>
            </div>
            <div class="control-group">
                <label label-default="" class="control-label">Card Number</label>
                <div class="controls">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required="">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required="">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" title="Third four digits" required="">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" title="Fourth four digits" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label label-default="" class="control-label">Card Expiry Date</label>
                <div class="controls">
                    <div class="row">
                        <div class="col-md-9">
                            <select class="form-control" name="cc_exp_mo">
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="cc_exp_yr">
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
								<option>2023</option>
								<option>2024</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label label-default="" class="control-label">Card CVV</label>
                <div class="controls">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="">
                        </div>
                        <div class="col-md-8"></div>
                    </div>
                </div>
            </div>
            <div class="control-group">
              <label label-default="" class="control-label"></label>
              <div class="controls">
                <button type="submit" class="btn btn-primary" name="submit" onclick="myFunction()">Submit</button> 
              <a href="view_cart_1.php">
			  <button type="button" class="btn btn-default">Cancel</button>
              
			  </div>
            </div>
        </form>
    </div>
</div>
<hr>

</body>
</html>