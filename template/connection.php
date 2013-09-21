<?php
require('./phpBB3/config.php');

try
{
	$conn=new PDO("mysql:host=$dbhost;dbname=web",$dbuser,$dbpasswd);
	$conn->query("set names 'utf8'");
}
catch(PDOException $e)
{
	die("Could not connect to the server");
}
?>
