<?php

class facebook_package {

    function __construct() {
    /**
     * Autoload Facebook SDK
     */
    $lib_dir = dirname(__FILE__);	
	require_once($lib_dir . '/src/Facebook/FacebookSession.php');
	require_once($lib_dir . '/src/Facebook/FacebookRedirectLoginHelper.php');
	require_once($lib_dir . '/src/Facebook/FacebookRequest.php');
	require_once($lib_dir . '/src/Facebook/FacebookResponse.php');
	require_once($lib_dir . '/src/Facebook/FacebookSDKException.php');
	require_once($lib_dir . '/src/Facebook/FacebookRequestException.php');
	require_once($lib_dir . '/src/Facebook/FacebookAuthorizationException.php');
	require_once($lib_dir . '/src/Facebook/GraphObject.php');
	require_once($lib_dir . '/src/Facebook/Entities/AccessToken.php');
	//require_once($lib_dir . '/src/Facebook/HttpClients/FacebookCurlHttpClient.php');
	require_once($lib_dir . '/src/Facebook/HttpClients/FacebookHttpable.php');
    }

}

?>