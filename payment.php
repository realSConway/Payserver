<html>
		<head>
		<title>Address page</title>
		<link href="./../design_submit_button.css" rel="stylesheet">
		<!--		<style>
						body {
								background-color: MediumSeaGreen;
						}
						h1 {
								text-align: center;
								font-family: Arial;
						}
				</style>-->
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
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"id\":\"curltext\",\"method\":\"addrequest\",\"params\":{\"amount\":\"0.00000001\"}}");

	$result = curl_exec($ch);

	$obj = json_decode($result, true);
//	echo "<div id=\"sub><p>".$obj["result"]["address"]."</p></div>";
	echo $obj["result"]["address"];
//	echo "<div id=\"sub><p>css test</p></div>";
	echo "test";
	
}
?>
				</main>
		</body>
</html>
