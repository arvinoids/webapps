<?php
include '../config.php';
include 'functions.php';
include 'snmp.php';

//get values
$model = $_POST['model'];
$address = $_POST['address'];
$action = $_POST['action'];
$useraddress = $_POST['useraddress'];
$user = $_POST['user'];
$confirm = $_POST['confirm'];

function setCurrentSelection($model, $address, $action, $useraddress, $user)
{
    try{
        $pdo = dbConnect();
        $stmt = 'INSERT INTO selection (address, model, action, useraddress, user) VALUES ( \''.$address.'\', \''.$model.'\', \''.$action.'\', \''.$useraddress.'\', \''.$user.'\')'   ;
        $pdo->query('TRUNCATE TABLE selection');
        $pdo->query($stmt);
        unset($pdo);
        }
        catch (Exception $e) {
            echo 'Caught Exception: ', $e->getMessage(),'\n';
    }
}

function is_legacy($address)
{
    $pdo = dbConnect();
    $result = $pdo->query("SELECT is_legacy FROM printers where address = '".$address."'");
    $device = $result->fetch();
    $legacy = $device['is_legacy'];
    unset($pdo);
    return $legacy;
}

function createPJL($address,$useraddress)
{
    $addresses = $useraddress.','.SERVER;
    $file = fopen('reserve.pjl', 'w') or die("Unable to create file!");
    //compose UCF in PJL code
    $esc = chr(27);
    $init = $esc."%-12345X@PJL JOB\n@PJL LWRITEUCF\n";
    $end = "@PJL EOF\n@PJL LPORTROTATE\n".$esc."%-12345X";
    $moja = 'network.IPRESTRICTLIST "'.$addresses."\"\n";
    fwrite($file,$init);
    fwrite($file,$moja);
    fwrite($file, $end);
    fclose($file);
}

function release($address)
{
    if (is_legacy($address)=='1'){
        //$command = "IPRESTRICT 0 \"".SERVER."\"\n";
                //$command = "IPRESTRICT 0 \"".SERVER."\"\n";
        $command = "IPRESTRICT 0 \"\"\n";

    } else {
        //$command = "network.IPRESTRICTLIST \"".SERVER."\"\n";
        $command = "network.IPRESTRICTLIST \"\"\n";
    }

    $file = fopen('release.pjl', 'w') or die("Unable to create file!");
    $esc = chr(27);
    $init = $esc."%-12345X@PJL JOB\n@PJL LWRITEUCF\n";
    $end = "@PJL EOF\n@PJL LPORTROTATE\n".$esc."%-12345X";
    fwrite($file,$init);
    fwrite($file, $command);
    fwrite($file, $end);
    fclose($file);

    $pjl = file_get_contents("release.pjl");
    $fp=pfsockopen($address, 9100);
    fwrite($fp, $pjl);
    fclose($fp);

    $fp = pfsockopen($address, 9100, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } 
    else
        {
            $pjl = file_get_contents("release.pjl");
            fwrite($fp, $pjl);
            fclose($fp);
        }

    $pdo = dbConnect();
    $stmt = 'UPDATE printers set status = \'Available\', reservedby = \'\' WHERE address=\''.$address.'\'';
    $pdo->query($stmt);
    unset($pdo);
}

function sendToLegacy($address,$useraddress)
{
    $addresses=SERVER.','.$useraddress;
    $data="vac.255.IPRESTRICTLIST =".$addresses;
    $path="http://".$address."/cgi-bin/postpf/cgi-bin/dynamic/config/net/ip.html";
    $ch = curl_init( $path );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec( $ch );
}

function sendToMoja($address,$useraddress)
{
    createPJL($address,$useraddress);
    sendToPrinter($address);
}

function updateDatabase($user,$address)
{
    $pdo = dbConnect();    
    $stmt = 'UPDATE printers set status = \'Reserved\', reservedby = \''.$user.'\' WHERE address=\''.$address.'\'';
    $pdo->query($stmt);
    unset($pdo);
}

function reserve($address,$useraddress,$user)
{
    if (is_legacy($address)=='1'){
        sendToLegacy($address,$useraddress);
        updateDatabase($user,$address);
    } else {
        sendToMoja($address,$useraddress);
        updateDatabase($user,$address);
    }
}

function sendToPrinter($address)
{
    $pjl = file_get_contents("reserve.pjl");
    $fp=pfsockopen($address, 9100);
    fwrite($fp, $pjl);
    fclose($fp);

    $fp = pfsockopen($address, 9100, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } 
    else
        {
            $pjl = file_get_contents("reserve.pjl");
            fwrite($fp, $pjl);
            fclose($fp);
        }
}

function request($address,$currentuser,$user_ipaddress)
{
    //get current user's email address from database
    $pdo = dbConnect();
    $row = $pdo->query("SELECT email FROM accounts where username = '".$currentuser."'");
    $ans = $row->fetch();
    $currentuseremail = $ans['email'];

    //get recipient's email address from database and the printer model
    $row = $pdo->query("SELECT reservedby,model FROM printers where address = '".$address."'");
    $ans = $row->fetch();
    $reservedby = $ans['reservedby'];
    $model = $ans['model'];

    $row = $pdo->query("SELECT email FROM accounts where username = '".$reservedby."'");
    $reservedby_email = $ans['email'];
    unset($pdo);

    $subject = "Printer Access Request for ".$address;

    $msg = "The user ".$currentuser." would like to request access to the ".$model." on ".$address.". You have reserved this device. \n";
    $msg .= "To give access to ".$currentuser.", please go to the device's TCP/IP Restricted Server list and add the IP address ".$user_ipaddress." on the list.\n
Alternatively, you can also release the device if you are no longer using it by logging on to the Level 3 Lab Printers page at https://level3.dhcp.lexmark.com/printers/.\n\n
Thanks!\nThe Level3 Printer Lab Admin";

    $headers .= 'To: <'.$reservedby_email.'>'. "\r\n";
    $headers .= 'From: L3 Lab Printers Admin <amagaway@lexmark.com>'. "\r\n";
    $headers .= 'Cc: amagaway@lexmark.com,'. $currentuseremail . "\r\n";
    $headers .= "X-Priority: 1 (Highest)\n";
    $headers .= "X-MSMail-Priority: High\n";
    
    mail($reservedby_email,$subject,$msg,$headers);

}


if (!empty($address)) setCurrentSelection($model, $address, $action, $useraddress, $user);

if ($confirm=='true')
{
    switch($action) {
        case 'Reserve': reserve($address,$useraddress,$user); break;
        case 'Release': release($address); break;
        case 'Request': request($address,$user,$useraddress); break;
    }
}

?>