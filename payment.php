<html>
		<head>
			<title>Address page</title>
			<link href="./../design_submit_button.css" rel="stylesheet">
		</head>
			<body>
				<main>
<?php
if (isset($_POST)) {

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:7777");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_POST , 1);
	curl_setopt($ch, CURLOPT_USERPWD , 'bitcoin:LQ4LYRsfgAPTz1xqxutBcOzL8CWj_ZRGGMB8b6B9v7A=');
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"id\":\"curltext\",\"method\":\"addrequest\",\"params\":{\"amount\":\"0.00000001\",\"force\":\"true\"}}");

	$result = curl_exec($ch);

	$obj = json_decode($result, true);

	echo "<div id=\"sub\"><p>".$obj["result"]["address"]."</p></div>";

	curl_close($ch);
}
?>
				</main>
		</body>
</html>
