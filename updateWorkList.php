<?php
include_once("db_conn.php");

$jid = $_POST['jid'];
$jtle = $_POST['jtle'];
$jdesp = $_POST['jdesp'];
$jaddr = $_POST['jaddr'];
$jpin = $_POST['jpin'];

$uqry = "update job set job_tle='$jtle', job_desp='$jdesp', address='$jaddr', pincode=$jpin where job_id=$jid;";

mysqli_query($conn, $uqry);

header("location:cdash.php");

?>