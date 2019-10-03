<html>
        <head>
                <style>
                        body {
                                background-color: MediumSeaGreen;
                        }
                        h1 {
                                text-align: center;
                                font-family: Arial;
                        }
                </style>
        </head>
<body>
                <main>
                        <h1>
                                <?php
                                        if (isset($_POST['submit'])) {
                                                //      $amount =$_POST['amount'];
                                                //      $month =$_POST['month'];

                                                $ch = curl_init();

                                                curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:7777");
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                curl_setopt($ch, CURLOPT_POST , 1);
                                                curl_setopt($ch, CURLOPT_USERPWD , 'bitcoin:LQ4LYRsfgAPTz1xqxutBcOzL8CWj_ZRGGMB8b6B9v7A=');
                                                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                                //      curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"id\":\"curltext\",\"method\":\"listaddresses\",\"params\":[]}");
                                                //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"id\":\"curltext\",\"method\":\"getbalance\",\"params\":[]}");
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"id\":\"curltext\",\"method\":\"addrequest\",\"params\":{\"amount\":\"0.00000001\"}}");

                                                $result = curl_exec($ch);

                                                //if (curl_errno($ch)) { echo 'Error:' . curl_error($ch); }
                                                //      curl_close ($ch);

                                                $obj = json_decode($result, true);
                                                echo $obj["result"]["address"];

                                                //print_r($obj);
                                        }
                                ?>
                        </h1>
                </main>
        </body>
</html>
