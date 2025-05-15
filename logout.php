<?php
session_start();

if (isset($_COOKIE['cred']))
    setcookie("cred", null, -1, '/');
session_unset();
session_destroy();
header("location:index.php");

?>