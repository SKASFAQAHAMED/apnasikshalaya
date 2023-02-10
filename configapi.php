<?php

	require_once "./API/vendor/autoload.php";
	
$google_client = new Google_Client();

$google_client->setClientId('174728225070-v2j1f90t8snlkggek8jn1evtu5h46987.apps.googleusercontent.com');

$google_client->setClientSecret('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');

$google_client->setRedirectUri('https://apnasikshalaya.com/gapi.php');

$google_client->addScope('email');
$google_client->addScope('profile');

session_start();

?>