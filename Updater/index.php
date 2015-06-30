<?php
include "Website.php";
include "Security.php";

if (!Security::hasPermission()) {
	echo ":(";
	exit;
}
/** @var Website[] $updateSites */
$updateSites = array(
	new Website("UO-Login", "")
);
?>

<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fru1tMe Updater</title>

	<link type="text/css" rel="stylesheet" href="C:/css/compiled/styles.css" />
</head>

<body>
<div class="wrapper">
	<div class="page-title">
		<h1>Fru1tMe Updater</h1>
	</div>

	<?php
	foreach ($updateSites as $site) {
		$siteName = $site->getName();
		$result = htmlspecialchars($site->update());
		echo <<<ASDF
		<div class="updates">
			<div class="entry">
				<div class="site">$siteName</div>
				<pre class="output">$result</pre>
			</div>
		</div>
ASDF;
	}
	?>

</div>
</body>
</html>