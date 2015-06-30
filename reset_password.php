<?php
include_once "SQL.php";
if (!isset($_GET['username'], $_GET['token'])) {
	header('Location: index.php');
	exit;
}
$myUsername = $_GET['username'];
$mailToken = $_GET['token'];
$action = "reset_password.php?token=$mailToken&username=$myUsername";
if (isset($_POST['newPassword'], $_POST['confirmPassword'])) {
	if ($_POST['newPassword'] !== $_POST['confirmPassword']){
		header("Location: $action");
		exit;
	}
	$sql = SQL::getConnection();
	$saltedPassword = $myUsername . strlen($myUsername) . $_POST['newPassword'];
	$hashedPassword = hash("sha512", $saltedPassword);
	$sql->query("UPDATE accounts SET password = '$hashedPassword', token = NULL WHERE token = '$mailToken' AND username = '$myUsername'");
	if ($sql->affected_rows == 1) {
		echo 'Password successfully reset!';
	} else {
		echo 'Invalid token.';
	}
}
?>
<style type="text/css">
	.shit {
		width: 300px;
		text-align: center;
		background-color: #CCC;
		border-collapse: collapse;
		padding: 0;
		margin: 0;
		border: none;
	}
	.shit td {
		padding: 6px;
	}
</style>

<form method="post" action="<?php echo $action; ?>">
	<table class="shit">
		<tr>
			<td colspan="2"><strong>Reset Password Form</strong></td>
		</tr>
		<tr>
			<td>New Password:</td>
			<td><input name="newPassword" type="text"></td>
		</tr>
		<tr>
			<td>Confirm Password:</td>
			<td><input name="confirmPassword" type="text"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="Submit" value="Reset"></td>
		</tr>
	</table>
</form>