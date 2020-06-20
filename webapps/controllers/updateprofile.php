<?php
//required files
require '../config.php';
require 'functions.php';

if(isset($_POST['ip']))
{
    updateProfileData($_POST['ip']);
    $header = 'location: ../ipview.php?ip='.$_POST['ip'];
    header($header);
    exit;
}

else echo "IP not set.";

function updateProfileData($ip)
{
    $pdo = dbconnect();
    $query = "UPDATE installprofiles 
    SET status='".$_POST['status']."', account='".$_POST['account']."', project='".$_POST['project']."', app_owner='".$_POST['app_owner']."', email='".$_POST['email']."', 
    phone='".$_POST['phone']."', project_manager='".$_POST['project_manager']."', ps='".$_POST['ps']."', installer='".$_POST['installer']."', solutions='".$_POST['solutions']."',
    platform='".$_POST['platform']."',platform_version='".$_POST['platform_version']."',sol_version='".$_POST['sol_version']."',notes='".$_POST['notes']."',
    third_party_sol='".$_POST['third_party_sol']."',third_party_sup='".$_POST['third_party_sup']."',driver='".$_POST['driver']."',lb_details='".$_POST['lb_details']."',
    workgroup='".$_POST['workgroup']."',ldd_db='".$_POST['ldd-db']."',tsc='".$_POST['tsc']."',support_model='".$_POST['support_model']."',geo='".$_POST['geo']."',
    region='".$_POST['region']."',hours='".$_POST['hours']."',sla_details='".$_POST['sla_details']."',escalation='".$_POST['escalation']."' 
    WHERE ip='".$ip."'";
    $pdo->query($query);
}

?>