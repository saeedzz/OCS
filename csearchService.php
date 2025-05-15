<?php

include("db_conn.php");

$cid = $_GET['id'];
$stype = $_GET['stype'];

if(in_array($stype,["Painter","Electrician","Carpenter","Gardener","Plumber","House cleaner"])){
    $sqry = "select user.id,name,s_type,pfpic from user,service where user.id=service.id and utype='service provider' and s_type='$stype' limit 10;";
}else{
    $sqry = "select service.id,name,s_type,pfpic from user,service where utype='service provider' and user.id=service.id limit 6;";
}

$spres = $conn->query($sqry);

while ($val = $spres->fetch_assoc()) {
    $snm = $val['name'];
    $stp = $val['s_type'];
    $sid = $val['id'];
    $pfpic = $val['pfpic'];

    $str = <<<idfr
    <div class='card text-center border-3 rounded-3 m-3' style='width: 18rem;'>
    <img src='$pfpic' class='card-img-top w-50 h-50 mx-auto mt-3 d-block' alt='avatar' style="clip-path:circle(40%)">
    <hr>
    <div class='card-body'>
    <h5 class='card-title'>$snm</h5>
    <p class='card-text'>$stp</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vService" onclick="vProfile($sid,'$snm')" > View Profile </button>
    </div>
    </div>
    idfr;

    echo $str;
}



?>