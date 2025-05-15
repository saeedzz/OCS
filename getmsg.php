<?php

include_once("db_conn.php");

$sid = $_GET['sid'];
$cid = $_GET['cid'];
$dirtn1 = $_GET['dirtn'];

$sid = isset($_GET['sid']) && is_numeric($_GET['sid']) ? intval($_GET['sid']) : 0;
$cid = isset($_GET['cid']) && is_numeric($_GET['cid']) ? intval($_GET['cid']) : 0;

if ($sid == 0 || $cid == 0) {
    die("Error: Invalid chat session. Missing or incorrect SID/CID.");
}

$qry = "select msg,direction from chat where sid=$sid and cid=$cid;";

$res = $conn->query($qry);

while($val = $res->fetch_assoc()){
    $msg = $val['msg'];
    $dirtn2 = $val['direction'];

    if($dirtn1 == $dirtn2){
        $str=<<<idfr
        <div class="align-self-end bg-primary text-white px-2 mb-1 rounded-pill me-1" >$msg</div>
        idfr;
    }
    else
    {
        $str=<<<idfr
        <div class="align-self-start bg-light mb-1 px-2 rounded-pill" >$msg</div>
        idfr;
    }


    echo $str;
}


?>

