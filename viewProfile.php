<?php

include_once("db_conn.php");

$sid = $_GET['sid'];

$qry = "select * from user,service where user.id=$sid and user.id=service.id;";

$res = mysqli_query($conn,$qry);

while($val = mysqli_fetch_assoc($res)){
    $nm = $val["name"];
    $stype = $val["s_type"];
    $addr = $val["address"];
    $pin = $val["pincode"];
    $pf = $val["pfpic"];

    $str=<<<idfr
    <div class="mb-3 text-center">
    <img src="$pf" alt="avatar" height="150px" width="150px" style="clip-path: circle(50%)" />
    </div>
    <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" value="$nm" disabled>
    </div>
    <div class="mb-3">
    <label class="form-label">Service Type</label>
    <input type="text" class="form-control" value="$stype" disabled>
    </div>
    <div class="mb-3">
    <label class="form-label">Address</label>
    <textarea class="form-control" rows=4  disabled>$addr</textarea>
    </div>
    <div class="mb-3">
    <label class="form-label">Pincode</label>
    <input type="text" class="form-control" value="$pin" disabled>
    </div>
    idfr;

    echo $str;
}


?>