<?php 

require 'database.php';

function showPrinters($pdo,$user) //just display the table
{
    $m = new Mustache_Engine;
    $result = $pdo->query('SELECT * FROM printers');
    $template=file_get_contents('templates/printer.mst');
    while ($row = $result->fetch())
    {
        //determine actions to show
        $row["action"]= shownAction($row,$user);
        //render with template
        echo $m->render($template,$row);
    }
}

function showPrinterView($pdo) //just display the table
{
    $m = new Mustache_Engine;
    $result = $pdo->query('SELECT * FROM printers');
    $template=file_get_contents('templates/printerview.mst');
    while ($row = $result->fetch())
    {
        echo $m->render($template,$row);
    }
}

function shownAction($array,$user) //
{
    $reserve = 'Reserve';
    $release = 'Release';
    $request = 'Request';
    $disabled = 'Disabled';
    if ($array['is_online']=='Offline') return $disabled; 
    else {
        if ($array['reservedby']==NULL) return $reserve;
        else {
            if ($user==$array['reservedby']) return $release;
                else return $request;
        }
    }
}

function getIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[count($ips) - 1]);
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function getOnline($address)
{
    $timeout = 1;
    $socket = @fsockopen( $address, 443, $errno, $errstr, $timeout );
    $is_online = ( $socket !== false );
    if ($is_online) return "Online"; else return "Offline";
}

function updateOnline()
{
    $pdo=dbConnect();
    $sql= 'SELECT address FROM printers';
    $data=$pdo->query($sql);
    while ($row = $data->fetch())
    {
        $online = getOnline($row['address']);
        $query="UPDATE printers SET is_online='".$online."' where address='".$row['address']."'";
        $pdo->query($query);
    }  
    logger(__FUNCTION__,$sql,$pdo);
    unset($pdo);
}

function fetchProfile($ip)
{
    $pdo = dbconnect();
    $query = "SELECT * FROM installprofiles WHERE ip='".$ip."'";
    logger(__FUNCTION__,$query,$pdo);
    $m = new Mustache_Engine;
    $result = $pdo->query($query);
    $template=file_get_contents('templates/profileview.mst');
    $data = $result->fetch(); //after this, insert files count to data
    $data['files'] = getFilesCount($ip);
    echo $m->render($template,$data);
    unset($pdo);
}

function getFilesCount($ip)
{
    $pdo = dbconnect();
    $query = "SELECT count(0) FROM ip_files WHERE ip='".$ip."'";
    $result = $pdo->query($query)->fetchColumn();
    $ans = ($result=='0') ? 'None' : $result;
    return $result;
}

function updateProfile($ip)
{
    $pdo = dbconnect();
    $query = "SELECT * FROM installprofiles WHERE ip='".$ip."'";
    $m = new Mustache_Engine;
    $result = $pdo->query($query);
    $template=file_get_contents('templates/profileupdate.mst');
    $data = $result->fetch();
    echo $m->render($template,$data);
    logger(__FUNCTION__,$query,$pdo);
    unset($pdo);
}

function showServers($pdo) //just display the table
{
    $m = new Mustache_Engine;
    $query='SELECT * FROM servers ORDER BY apps ASC';
    $result = $pdo->query($query);
    $template=file_get_contents('templates/server.mst');
    while ($row = $result->fetch())
    {
        //render with template
        echo $m->render($template,$row);
    }
    logger(__FUNCTION__,$query,$pdo);
    unset($pdo);
}

function getStatus($address)
{
    $timeout = 2;
    $socket = @fsockopen( $address, 443, $errno, $errstr, $timeout );
    $online = ( $socket !== false );
    if ($online) return "Online"; else return "Offline";
}

function updateStatus()
{
    $pdo=dbConnect();
    $servers='SELECT address FROM servers';
    $data=$pdo->query($servers);
    while ($row = $data->fetch())
    {
        $status = getStatus($row['address']);
        $query="UPDATE servers SET status='".$status."' where address='".$row['address']."'";
        $pdo->query($query);
    }  
    unset($pdo);
}

function troubleshoot()
{
    if(empty($_SESSION['step'])) showProducts();
    else {
        showStep();
    }
}

//troubleshooter
function showProducts()
{
    $pdo = dbConnect();
    $m = new Mustache_Engine;
    $result = $pdo->query('SELECT * FROM tr_data WHERE id < \'100\'');
    $template=file_get_contents('templates/card.mst');
    while ($row = $result->fetch())
    {
        //render with template
        echo $m->render($template,$row);
    }
    unset($pdo);
}

function showStep($id)
{
    $m = new Mustache_Engine;
    $result = $pdo->query("SELECT * FROM tr_data WHERE id = '".$id."'");

    $template=file_get_contents('templates/card.mst');
    while ($row = $result->fetch())
    {
        //render with template
        echo $m->render($template,$row);
    }
    unset($pdo);
}

//file manager
function showFiles($ip)
{
    $pdo = dbConnect();
    if (isset($ip)) $query = "SELECT * FROM ip_files WHERE ip='$ip'";
        else $query = "SELECT * FROM ip_files";
    $data = $pdo->query($query);
    $m = new Mustache_Engine;
    $template = file_get_contents('templates/files.mst');
    while ($row = $data->fetch())
    {
        echo $m->render($template,$row);
    }

}
?>