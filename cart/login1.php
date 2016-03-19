<?php
error_reporting(E_ALL ^ E_DEPRECATED); 
$host="localhost";
$username="root";
$password="root";
$db="rapid"; /* Check write "Database name or login table name"*/
mysql_connect($host,$username,$password);
mysql_select_db($db);
if(isset($_POST['submit'])) {

$email=$_POST['email'];
$pass=$_POST['pass'];
/*Check the tablename in following table */
$sql="SELECT * from user where email='".$email."' AND password='".$pass."'";
/*I have changed variable name below */
$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
     {
	   echo "You have successful Log In";
	   exit();
	 }
  else {
    echo "Invalid Login Information, Please Return to The previous Page ";  
    exit();
   
  
  }
	 
	 
	 
}


/*inclusion of Library files*/
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
 /*Use Namespace*/
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookCurl;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
/*Process*/
//1.start the session
session_start();
//2.use app_id,app_secret,redirect_url
$app_id='1585138251759612';
$app_secret='5de6fdb3d6b94cfd1481e7080552c42c';
$redirect_url='http://localhost/cart/login1.php';
//3.Initialize the facebook application
FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();
//4.if fb session exists echo name
	
?>






<!DOCTYPE html>
<head>
<title>LoginPage</title>
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">  <!--Image Gallery-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> <!--Panel for catagory-->  
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> <!--Login-->
  <!--bootstrap for image gallery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <!--bootstrap for image gallery-->
  <!--bootstrap for panel-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!--bootstrap for panel-->
  <style>
.panel{
    	margin: 20px;
    }

  body
{
margin: 0 auto;
width:90%;
clear:both;
text-align:left;
height:100px;
background-color:#FFFFCC;
}
.navbar-inverse {
background-color: #B2D3D2;
}
 .dropdown-menu > li > a:hover,
   .dropdown-menu > li > a:focus {
    color: #c73f12;
   text-decoration: none;
  background-color: #B2D3D2;  
   }
  .image-gallery{
    	margin-top: 50px;
    }
  #sidebar {

float:right;
width:480px;
height:330px;
background:#c9c;
text-align:center;
  }

  #wrap {
width:1080px;
margin:50px;


}  

 
 #mainImage {
float:left;
width:600px;
background:#9c9;

  }
  h1{
  color:#00ff00;
  }
  
  
  </style>









</head>    
<body>	
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" method="post" action="login.php">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="username or email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="pass" placeholder="password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                     <!-- <a id="btn-login"  href="#" class="btn btn-success" input type="submit" name="submit" >Login  </a>-->
                                      <input id="btn-login"  href="#" class="btn btn-success" type="submit" name="submit" value="Login" /a>


<?php

if(isset($sess)) {
	
	$request = new FacebookRequest($sess, 'GET', '/me');
  $response = $request->execute();
$graph = $response->getGraphObject(GraphUser::classname());
$name=$graph->getName();
echo "$name successfully logged in:";
  
  
  }
	else
	{
		echo '<a id="btn-fblogin" href=' . $helper->getLoginUrl() . ' class="btn btn-primary">Login with Facebook</a>';
		
	}
?>

				      <!--<a id="btn-fblogin" href="' . $helper->getLoginUrl() . '" class="btn btn-primary">Login with Facebook</a> -->

					  
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="register1.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="icode" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                        <span style="margin-left:8px;">or</span>  
                                    </div>
                                </div>
                                
                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                                    
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
                                    </div>                                           
                                        
                                </div> 
   
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
    </div>

	</body>    
</html>