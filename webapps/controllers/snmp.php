<?php

if(isset($_POST['ip'])){
    $community='public';
    getModel($ip,$community);
}

function getModel($host,$community)
{
    snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
    $oid = '1.3.6.1.4.1.641.6.2.3.1.4.1';
    $model = snmpget ($host , $community , $oid );
    return $model;
}

?>