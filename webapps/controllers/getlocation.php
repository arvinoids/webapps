<?php
snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
//$host=$_GET['ip'];
$community='public';
//$oid = '1.3.6.1.4.1.641.6.2.3.1.4.1';
$oid = "1.3.6.1.2.1.1.6.0";
$host = "10.194.46.252";

$result = snmpget ($host , $community , $oid );
echo $result;
//$pattern1= '/STRING: "/';
//$pattern2= '/"/m';
//$str1 = preg_replace($pattern1 ,'',$result);
//$model = preg_replace($pattern2,'',$str1);
//echo $model;
?>
