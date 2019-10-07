<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Bitcoin payment page</title>
</head>
<body>
<?php
if (isset($_POST['month'])) {
	// this should be cURL execute
	echo '<h2>Current month, ' . htmlentities($_POST['month']) . '</h2>';
	echo '<h2>BTC address, ' . htmlentities($_POST['month']) . '</h2>';
}
?>
<form method="post">
<label>What is current month? <input type="text" name="month"></label><br>
<input type="submit">
</form>
</body>
</html>
