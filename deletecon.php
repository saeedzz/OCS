<?php

include_once("db_conn.php");

$conid = $_GET["conid"];
$qry = "delete from contact where id=$conid;";

mysqli_query($conn,$qry);


?>