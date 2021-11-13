<?php
    // print_r($_REQUEST);
    $in = $_REQUEST;

    $pickup = date("Y-m-d H:i:s", strtotime($in['pickUpDate'] . ' ' . $in['pickUpTime']));
    $return = date("Y-m-d H:i:s", strtotime($in['returnDate'] . ' ' . $in['returnTime']));

    $email = <<<EOT
To: juanaharrisdht@att.net
Bcc: patrickmp1975@gmail.com
Subject: Bus Request for {$in['userName']} on $pickup

EOT;

    $body = "\n\n";
    foreach ($in as $key=>$val) {
        $body .= $key . ': ' . $val . "\n";
    }
    $body .= "\n";

    $email .= $body;

    $iso = date("YmdHis");
    file_put_contents("requests/$iso.txt", $email);

?>
