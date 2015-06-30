<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/25/2015
 * Time: 11:58 AM
 */
$errorlevel = error_reporting();
error_reporting($errorlevel & ~E_NOTICE);
include_once "config.php";
$link = mysqli_connect("$host", "$username", "$password", "$db_name") or die("cannot connect");

$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($link, $myusername);
$mypassword = mysqli_real_escape_string($link, $mypassword);
$salt = $myusername . strlen($myusername) . $mypassword;
$mypassword = hash('sha512', $salt);
$sql = "SELECT * FROM $tbl_name WHERE username = '$myusername' and password = '$mypassword'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
	session_start();
	$_SESSION["myusername"] = $myusername;
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
	echo "Wrong Username or Password";
	echo "<br><a href='reset.php'>Reset your password.</a>";
}
?>