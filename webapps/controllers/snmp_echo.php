<?php

if(isset($_GET['ip'])){
    $community='public';
    getModel($_GET['ip'],$community);
}

function getModel($host,$community)
{
    snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
    $oid = '1.3.6.1.4.1.641.6.2.3.1.4.1';
    $model = snmpget ($host , $community , $oid );
    echo $model;
}

?>