<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/25/2015
 * Time: 11:54 AM
 */
include "SQL.php";
session_start();
if (isset($_SESSION['myusername'])) {
	$sql = SQL::getConnection();
	$myusername = $_SESSION['myusername'];
	$result = $sql->query("SELECT accesslevel, lastlogin, created, email, id FROM accounts WHERE username = '$myusername'");
	$row = $result->fetch_assoc();
	$access = $row["accesslevel"];
	$lastLogin = $row["lastlogin"];
	$created = $row["created"];
	$email = $row["email"];
	$id = $row["id"];
	if ($access == 0)
		$accessLevel = "Player";
	elseif ($access == 1)
		$accessLevel = "Counselor";
	elseif ($access == 2)
		$accessLevel = "Game Master";
	elseif ($access == 3)
		$accessLevel = "Seer";
	elseif ($access == 4)
		$accessLevel = "Administrator";
	echo "Logged in as: " . $_SESSION['myusername'] . '&nbsp&nbsp<a href="logout.php">Logout</a>';
	echo <<<EOL
    <br>Some account information:
    <br>Acesslevel: $accessLevel
    <br>Last Login: $lastLogin
    <br>Date created: $created
    <br>Email: $email
EOL;
	$result = $sql->query("SELECT * FROM myrunuo.myrunuo_characters INNER JOIN accounts.accounts, accounts.characters WHERE accounts.accounts.id = '$id' AND accounts.characters.id = '$id'");
	$count = $result->num_rows;
	if ($count > 0)
		echo '<br>Character List:';
	else
		echo '<br>There are no characters on this account.';
	while ($row = $result->fetch_assoc()) {
		$charName = $row["char_name"];
		$charId = $row["char_id"];
		echo "<br><a href='http://my.uoreplay.com/player.php?id=$charId'>$charName</a>";
	}
}
?>
<?php
if (!isset($_SESSION['myusername'])) {
	ECHO <<<EOL
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form name="form1" method="post" action="checklogin.php">
			<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
					<tr>
						<td colspan="3"><strong>Member Login </strong></td>
					</tr>
					<tr>
						<td width="78">Username</td>
						<td width="6">:</td>
						<td width="294"><input name="myusername" type="text" id="myusername"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input name="mypassword" type="password" id="mypassword"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" name="Submit" value="Login"></td>
					</tr>
				</table>
			</td>
		</form>
	</tr>
</table>
EOL;
}
?>