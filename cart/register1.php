<html>
<head>
<title>Registration Form</title>
<link rel="stylesheet" href="CSS/form.css" type=text/css >
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
body, form, ul, li, p, h2, h3, h4, h5

    {
    margin: 0;
    padding: 0;
	
	
    }
 
body
    {
   
    color: #666;
	font-size:14px;
	}
h1,#introduction
{
margin: 20px auto;
width: 500px;	
	
}
#register h2

    {
    font-size: 14px;
    margin: 0 0 12px;
    }
 #register

    {
    margin: 20px auto;
    width: 500px;
    }
#register fieldset
    {
   margin: 0 0 20px;
    padding: 20px;
    border-radius: 5px;
    }
#register ol,ul
    {
    list-style-type: none;
    padding: 0;
    margin: 0;
    }

#register li
    {

    margin: 0 0 12px;
    position: relative;
    }
#register label
    {
font-size:12px; width: 100px;
    display: inline-block;
    vertical-align: top;
    }
	
#register input.required
    {
    background-color:white;
    background-position: 260px -30px;
    }
	
#register fieldset input

    {
    
    display: inline-block;
    width: 250px;
    border: 1px solid #763e9c;
    padding: 3px 26px 3px 3px;
    border-radius: 5px;

    }
	
 

#register fieldset textarea

    {

    display: inline-block;
    width: 250px;
    border: 1px solid #763e9c;

    padding: 3px 26px 3px 3px;

   border-radius: 5px;

    resize:none;
    }





#register fieldset input[type="radio"]
    {

    width:20px;
  }
 

#register .element_validation
    {
    background: #F08080;
    color: #fff;
    display: none;
    font-size: 12px;
    padding: 3px;
    position: absolute;
    right: -160px;
    text-align: center;
    top: 0;
    width: 150px;
    outline: 0;
    box-shadow: 0px 0px 4px #ffffff;
        border-radius: 5px;
    }

#register fieldset input:required:valid
    {
    background-color: #fff;
    background-position: 260px -61px;
   }
#register input.error
    {
    background-color: #F08080;
    background-position: 260px 3px;
    outline: none;
    }
 
#register input.required
   {
    background-color: #fff;
    background-position: 260px -30px;
    }
 
#register input.valid
    {
    background-color: #fff;
    background-position: 260px -61px;
    }


input[type="submit"]
    {
    background:#763e9c;
    border:none;
    width:150px;
    margin:auto;
    float:right;
    padding:5px;
    border-radius:5px;
    color:#fff;
   font-weight:bold;
    cursor:pointer;
    margin-bottom:2%;

    }
input[type="reset"]
    {
    background:#763e9c;
    border:none;
    width:150px;
    margin:auto;
    float:left;
    padding:5px;
    border-radius:5px;
    color:#fff;
   font-weight:bold;
    cursor:pointer;
    margin-bottom:2%;

    }
#div1{
  position: absolute;
    top: 50%;
    left: 50%;
    width: 800px;
    height: 860px;
    margin-left: -370px;
    margin-top: -150px;	
    background-color:#FFFFCC	
}

</style>
</head>

<body>

<div id="div1">
<h2 id="introduction"> Hello Everyone!!!!</h2>
<h1>REGISTRATION FORM<h1>
<form id="register" action="" method="post">
   <h2>* mandatory fields</h2>
   <fieldset style="background-color:#CCCCFF">
    <ol>
    <li>
     <label for="firstname">First Name *</label>
     <input type="text" id="firstname" name="firstname" pattern="[a-zA-Z/s]+" placeholder="First name(only letters)" required />
    </li>
    <li>
    <label for="lastname">Last Name *</label>
    <input type="text" id="lastname" name="lastname" pattern="[a-zA-Z/s]+"   placeholder="Last Name(only letters)" required />
    </li>
   </ol>
   </fieldset>
   
   
   <fieldset style="background-color:#CCCCFF">
 <ol>
  <li>
   <label for="email">Email *</label>
   <input type="email" id="email" name="email" placeholder="e.g. abc@some.com" title="Please enter a valid email" required />
   <p class="element_validation">
    <span class="invalid">Invalid email. e.g. abc@some.com</span>
    <span class="valid">Valid Email ID</span>
   </p>
  </li>
  
  
  <li>
  <label for="password">Password *</label>
     <input id="password" name="password" type="password" title="Minimum 8 characters, one number, one uppercase and one lowercase letter" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" required />
     <p class="element_validation">
      <span class="invalid">Invalid Password</span>
      <span class="valid">Valid Password</span>
     </p>
   </li>
  </ol>
</fieldset>

<fieldset style="background-color:#CCCCFF">

  <ol>                  
    
	<li>
     <label for="mobile">Phone *</label>
     <input type="tel" id="mobile" name="mobile" pattern="\d{10}" placeholder="9999999999" required />
    </li>
    <li>
     <label for="address1">Address1 *</label>
     <textarea id="address1" name="address1" type="text" required></textarea>
    </li>
    <li>
     <label for="address2">Address2 *</label>
     <textarea id="address2" name="address2" type="text"></textarea>
    </li>
    <li>
     <label for="city">City*</label>
     <input type="text" id="city" name="city" placeholder="Enter your city" required/>
    </li>
    <li>
     <label for="state">State*</label>
     <input type="text" id="state" name="state"  placeholder="Enter your State" required/>
    </li>
     <label for="country">Country*</label>
     <input type="text" id="country" name="country" placeholder="Enter your Country" required/>
    </li>
     <label for="zipcode">Zipcode*</label>
     <input type="text" id="zipcode" name="zipcode" placeholder="Enter your State" required/>
    </li>

   </ol>
  </fieldset>
 
 <input id="1" type="submit" value="Sign up" name="signup"style="background:#763e9c; color:#fff;"/>
<input id="2"type="reset" value="Reset" style="background:#763e9c; color:#fff;"/>

 </form>
 </div>
</body>
</html>
<?php error_reporting(E_ALL ^ E_DEPRECATED);
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
$firstName=isset($_POST['firstname'])?mysql_real_escape_string($_POST['firstname']):"";
$lastName=isset($_POST['lastname'])?mysql_real_escape_string($_POST['lastname']):"";
$email=isset($_POST['email'])?mysql_real_escape_string($_POST['email']):"";
$password=isset($_POST['password'])?mysql_real_escape_string($_POST['password']):"";
$mobile=isset($_POST['mobile'])?mysql_real_escape_string($_POST['mobile']):"";
$address1=isset($_POST['address1'])?mysql_real_escape_string($_POST['address1']):"";
$address2=isset($_POST['address2'])?mysql_real_escape_string($_POST['address2']):"";
$city=isset( $_POST['city'])?mysql_real_escape_string( $_POST['city']):"";
$state=isset( $_POST['state'])?mysql_real_escape_string( $_POST['state']):"";
$country=isset( $_POST['country'])?mysql_real_escape_string( $_POST['country']):"";
$zipcode=isset( $_POST['zipcode'])?mysql_real_escape_string( $_POST['zipcode']):"";
//execute the SQL query and return records
$sql = "INSERT INTO user".
       "(firstname,lastname,email,password,phone,add1,add2,city,state,country,zipcode) ".
       "VALUES ('$firstName','$lastName','$email','$password','$mobile','$address1','$address2','$city','$state','$country','$zipcode')";
       
$retval = mysql_query($sql);
	if($retval )
	{
	  $data[] = array('firstName'=>$firstName, 'lastName'=>$lastName);
	 // die(json_encode($data));
        } 
	
	else {
	   $data[] = array('firstName'=>'wrong firname','lastName'=>'wrong lastname');	
	}
} 
else {
$data[] = array('firstName' =>'cannot proceed', 'lastName' =>'cannot proceed');
}
mysql_close($dbhandle);
/* JSON Response */
//header('Content-type:application/json');
echo json_encode($data);
?>