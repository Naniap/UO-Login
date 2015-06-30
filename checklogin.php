<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/25/2015
 * Time: 11:58 AM
 */
include_once "SQL.php";

$errorlevel = error_reporting(E_ALL);
error_reporting($errorlevel & ~E_NOTICE);
if (isset($_POST["myusername"], $_POST["mypassword"])) {
	$myusername = $_POST['myusername'];
	$mypassword = $_POST['mypassword'];
	$sql = SQL::getConnection();
	$myusername = $sql->real_escape_string(stripslashes($myusername));
	$mypassword = $sql->real_escape_string(stripslashes($mypassword));
	$salt = $myusername . strlen($myusername) . $mypassword;
	$mypassword = hash('sha512', $salt);
	$result = $sql->query("SELECT * FROM accounts WHERE username = '$myusername' and password = '$mypassword'");
	$count = $result->num_rows;
	if ($count == 1) {
		session_start();
		$_SESSION["myusername"] = $myusername;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
} else {
	echo "Wrong Username or Password";
	echo "<br><a href='reset.php'>Reset your password.</a>";
}
?>