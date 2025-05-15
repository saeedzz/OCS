<?php

$jid = $_GET['jid'];

include_once("db_conn.php");

$qry  = "select job_tle,job_desp,job.address,pincode from job where job_id=$jid;";

$res = mysqli_query($conn, $qry);

while($val = $res->fetch_assoc()){
$tle = $val['job_tle'];
$desp = $val['job_desp'];
$addr = $val['address'];
$pin = $val['pincode'];

$str=<<<idfr
<div>
    <div class="mb-3">
        <label class="form-label">Work Title</label>
        <input type="text" class="form-control" name="jtle" value="$tle">
    </div>
    <div class="mb-3">
        <label class="form-label">Work Description</label>
        <textarea class="form-control" rows="4" name="jdesp">$desp</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Customer Address</label>
        <textarea class="form-control" rows="4" name="jaddr" >$addr</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Pincode</label>
        <input type="text" class="form-control" name="jpin" value="$pin">
    </div>
    <div class="mb-3 visually-hidden">
        <input type="text" class="form-control" name="jid" value="$jid">
    </div>
</div>
idfr;

echo $str;

}

?>