<?php
include "../config.php";
include 'database.php';
//ini_set('display_errors', 'On');
//ini_set('html_errors', 0);

if (!empty($_POST['details'])) addItem();

if (($_GET['mode']=='delete') && (!empty($_GET['id']))) deleteEntry($_GET['id']);

if ($_GET['mode']=='reset') { clearCrumbs(); header('location: ../troubleshooter.php'); }

function showItems($id) //this shows the items under the currently selected item.
{
    $pdo = dbConnect();
    $m = new Mustache_Engine;
    $template=file_get_contents('templates/tsitem.mst');
    if(empty($id)) { //shows the products if ID is empty
        $result = $pdo->query('SELECT * FROM tr_data WHERE id < \'100\'');
        while ($row = $result->fetch())
        {   //render with template
            echo $m->render($template,$row);
        }
    }
    else { 
        //addCrumb($id);
        $querystring = "SELECT elements FROM tr_data WHERE id='".$id."'";
        $elements = $pdo->query($querystring);
        $arr = $elements->fetch(PDO::FETCH_ASSOC);
        $elem = str_getcsv($arr['elements']);
        if($elem[0]==NULL) {
            echo "<tr><td class='text-center'>You have reach the end of the road. Now go have some fun!</td></tr>";
        } else {
            foreach ($elem as $value) {
            $query = "SELECT * FROM tr_data WHERE id = '".$value."'";
            $result = $pdo->query($query);
            $row = $result->fetch();
            if($row['id']==NULL) break;
            echo $m->render($template,$row);
            }
        }
        
    }
    unset($pdo);
}

function queryItems($terms) //show search results instead
{
    $pdo = dbConnect();
    $m = new Mustache_Engine;
    $template=file_get_contents('templates/tsitem.mst');
    $query = "SELECT * FROM tr_data WHERE step LIKE '$terms%' OR details LIKE '%$terms%'";
    $result = $pdo->query($query);
    while ($row = $result->fetch())
        {   //render with template
            echo $m->render($template,$row);
        }
    unset($pdo);
}

function dataEditor() //show editor instead
{
    $pdo = dbConnect();
    $m = new Mustache_Engine;
    $template=file_get_contents('templates/tseditor.mst');
    $result = $pdo->query('SELECT * FROM tr_data');
        while ($row = $result->fetch())
        {   //render with template
            echo $m->render($template,$row);
        }
    unset($pdo);
}

function newForm()
{
    $pdo = dbConnect();
    $q = $pdo->query("SELECT MAX(id) from tr_data");
    $m = new Mustache_Engine;
    $template=file_get_contents('templates/tsnewform.mst');
    $arr = $q->fetch();
    $newid['newid'] = $arr['MAX(id)']+1;
    echo $m->render($template,$newid);
    unset($pdo);
}

function addItem()
{
    $id = $_POST['id'];
    $step = $_POST['step'];
    $details = $_POST['details'];
    $pdo = dbConnect();
    $q = $pdo->prepare("INSERT INTO tr_data (id, step, details) VALUES (?, ?, ?)");
    $q->execute([$id, $step, $details]);
    unset($pdo);
}

function deleteEntry($id)
{
    $pdo = dbconnect();
    $query = "DELETE FROM tr_data WHERE id='$id'";
    if($pdo->query($query)) {
       logger(__FUNCTION__,$query,$pdo);
    header('location: ../troubleshooter.php?mode=edit'); 
    }
    else echo "Error :".$pdo->errorinfo();
    unset($pdo);
}

//breadcrumbs
function addCrumb($item)
{
    array_push($_SESSION['breadcrumb'],$item);
}

function gotoCrumb($item)
{
    $oldbreadcrumb = $_SESSION['breadcrumb'];
    $i=0;
    while (!($item==$oldbreadcrumb[$i])) {
        $newbreadcrumb = array_push($newbreadcrumb,$item);
        $i++;
    }
    $_SESSION['breadcrumb'] = $newbreadcrumb;
}

function clearCrumbs()
{
    session_destroy();
    session_start();
    $_SESSION['breadcrumb'] = array();
}

function breadCrumb()
{
    $breadcrumb=$_SESSION['breadcrumb'];

    $pdo = dbconnect();   
    $i=0;
    while ($i<count($breadcrumb)) {
        $id=$breadcrumb[$i];
        $query = "SELECT step FROM tr_data WHERE id = '$id'";
        $result = $pdo->query($query);
        $data = $result->fetch();
        $step = $data['step'];
        echo "<li class=\"breadcrumb-item\"><a href=\"troubleshooter.php?id=$id\">$step</a></li>";
        $i++;
        }
        unset($pdo);
}

function editEntry($id)
{
    $pdo = dbconnect();
    $query = "SELECT * FROM tr_data WHERE id='$id'";
    
    $m = new Mustache_Engine;
    $result = $pdo->query($query);
    $template=file_get_contents('templates/tseditentry.mst');
    $data = $result->fetch();
    $_SESSION['step']=$data['step'];
    echo $m->render($template,$data);
    logger(__FUNCTION__,$query,$pdo);
    unset($pdo);
}

function getStep($id)
{
    $pdo = dbconnect();
    $query = "SELECT step FROM tr_data WHERE id='$id'";
    $result = $pdo->query($query);
    $data = $result->fetch();
    return $data['step'];
    unset($pdo);
}

function listItems($id)
{
    //first get the current elements
    
    $pdo = dbconnect();
    $q = $pdo->query("SELECT elements FROM tr_data WHERE id='$id'");
    $res = $q->fetch();
    $elements = (explode(",",$res['elements']));
    $query = "SELECT id, step, elements FROM tr_data";
    $result = $pdo->query($query);

    $m = new Mustache_Engine;
    $template=file_get_contents('templates/checklist.mst');
    while ($row = $result->fetch())
        {   
            //check if the item should be ticked, i.e. the item is in the list of elements in the field
            if(in_array($row['id'], $elements)) $row['checked']="checked";
            //render with template
            echo $m->render($template,$row);
        }
        unset($pdo);
}

function viewEntry($id)
{
    $pdo = dbconnect();
    $query = "SELECT * FROM tr_data WHERE id='$id'";
    $m = new Mustache_Engine;
    $result = $pdo->query($query);
    $template=file_get_contents('templates/tsview.mst');
    $data = $result->fetch();
    $data['details']=nl2br($data['details']);
    echo $m->render($template,$data);
    unset($pdo);
}

?>