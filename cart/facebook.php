<?php
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
$redirect_url='http://localhost/cart/facebook.php';
//3.Initialize the facebook application
FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();
//4.if fb session exists echo name
if(isset($sess)) {
	
	$request = new FacebookRequest($sess, 'GET', '/me');
  $response = $request->execute();
$graph = $response->getGraphObject(GraphUser::classname());
$name=$graph->getName();
echo "$name successfully logged in:";
  
  
  }
	else
	{
		//echo '<a href="' . $helper->getLoginUrl() . '">Login with Facebook</a>';
		echo '<a id="btn-fblogin" href=' . $helper->getLoginUrl() . ' class="btn btn-primary">Login with Facebook</a>';
		
	}


































?>
