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
$maddr = urlencode($addr);

$str=<<<idfr
<div>
    <div class="mb-3">
        <label class="form-label">Work Title</label>
        <input type="text" class="form-control" value="$tle" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Work Description</label>
        <textarea class="form-control" rows="4" disabled>$desp</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Customer Address</label>
        <textarea class="form-control" rows="4" disabled>$addr</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Pincode</label>
        <input type="text" class="form-control" value="$pin" disabled>
    </div>
  
idfr;

echo $str;

}

?>