<?php

include_once("db_conn.php");

$sid = $_GET['sid'];
$cid = $_GET['cid'];
$msg = $_GET['msgText'];
$dirtn = $_GET['dirtn'];

$qry1 = "insert into chat values($cid,$sid,'$msg',current_timestamp,'$dirtn');";

$conn->query($qry1);

$qry2 = "select msg,direction from chat where sid=$sid and cid=$cid";

$res = $conn->query($qry2);

while($val = $res->fetch_assoc()){
    $msg = $val['msg'];
    $dirtn2 = $val['direction'];

    if($dirtn == $dirtn2){
        $str=<<<idfr
        <div class="align-self-end bg-primary text-white px-2 mb-1 rounded-pill" >$msg</div>
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