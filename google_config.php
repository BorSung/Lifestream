<?php

	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("411215849903-7gqpr6qol3v77v9smv0tbpjp4810r206.apps.googleusercontent.com");
	$gClient->setClientSecret("UxlX8_v1fCwMuVSM_z0kuuoe");
	$gClient->setApplicationName("LifeStream");
	$gClient->setRedirectUri("https://infs3202-2da4f03e.uqcloud.net/referback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
