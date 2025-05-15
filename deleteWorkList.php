<?php
include_once("db_conn.php");

$jid = $_GET['jid'];

$dqry = "delete from job where job_id=$jid;";

mysqli_query($conn, $dqry);

?>