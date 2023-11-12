<?php

/***
 * set base url
 */

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . '://' . $host . '/';
define("BASE_URL", $base_url);

/*
*** set the default controller
*/
define('DEFAULT_CONTROLLER', 'home');

date_default_timezone_set('Asia/Manila');