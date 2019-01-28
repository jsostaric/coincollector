<?php

session_start();

include_once "function.php";

$title = "CoinCollector";

if($_SERVER["HTTP_HOST"] == "localhost") {
	$route = "/CoinCollector/";
	$mysqlHost = "localhost";
	$mysqlDB ="coin";
	$mysqlUser ="jurica";
	$mysqlPass = "Jura10os";
} else if($_SERVER["HTTP_HOST"] == "jsostaric.byethost32.com"){
	$route = "/CoinCollector/";
	$mysqlHost = "vidjeti na serveru";
	$mysqlDB ="vidjeti na serveru";
	$mysqlUser =" b32_23293043";
	$mysqlPass = "Jura10os";
}else {
	$route = "/";
}


try{
	$conn = new PDO("mysql:host=" . $mysqlHost. ";dbname=" . $mysqlDB , $mysqlUser, $mysqlPass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$conn->exec("SET CHARACTER SET utf8");
	$conn->exec("SET NAMES utf8");
} catch(Exepction $e) {
	print "Error!:" . $e->getMessage() . "<br/>";
	die();
}