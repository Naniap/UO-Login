<?php
include_once "SQL.php";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: noreply@uoreplay.com' . "\r\n";

if (isset($_POST['myusername'], $_POST['email'])) {
	$sql = SQL::getConnection();
	$myusername = $_POST['myusername'];
	$email = $_POST['email'];
	$token = hash("sha512", $email . time());
	$result = $sql->query("UPDATE accounts SET token = '$token' WHERE username = '$myusername' AND email = '$email'");
	mail($email, "My UOReplay Email Reset", "You have a requested a password reset, click this <a href ='http://www.uoreplay.com/login/reset_password.php?token=$token&username=$myusername'>link</a> to reset.", $headers);
}
?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form name="form1" method="post" action="reset.php">
			<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
					<tr>
						<td colspan="3"><strong>Member Password Reset </strong></td>
					</tr>
					<tr>
						<td width="78">Username</td>
						<td width="6">:</td>
						<td width="294"><input name="myusername" type="text" id="myusername"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input name="email" type="text" id="email"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" name="Submit" value="Reset"></td>
					</tr>
				</table>
			</td>
		</form>
	</tr>
</table>
