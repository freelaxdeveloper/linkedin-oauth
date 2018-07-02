<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/classes/LinkedIn.php';

$API_ID = ''; // your API_ID application
$API_SECRET = ''; // your API_SECRET application
$linkedIn = new LinkedIn($API_ID, $API_SECRET);

if ($linkedIn->isAuthenticated()) {
    //we know that the user is authenticated now. Start query the API
    $user=$linkedIn->get('v1/people/~:(firstName,lastName,email-address,id)');

    echo "Welcome <b>{$user['firstName']}</b><br><hr><br>";
    echo "<b>Name:</b> {$user['firstName']} {$user['lastName']}<br>";
    echo "<b>Email:</b> {$user['emailAddress']}<br>";
    echo "<b>ID:</b> {$user['id']}<br>";
    exit();
} elseif ($linkedIn->hasError()) {
    echo "User canceled the login.";
    exit();
}

//if not authenticated
$url = $linkedIn->getLoginUrl();
echo "<a href='$url'>Login with LinkedIn</a>";