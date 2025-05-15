<?php

session_start();

// Check if session variable is set
if (!isset($_SESSION['id'])) {
    // Handle error (e.g., redirect to an error page)
    header("location:error.php");
    exit();
}

$cid = $_SESSION['id'];

// Validate POST data
if (!isset($_POST['jobCat'], $_POST['jobTle'], $_POST['jobDesp'], $_POST['address'], $_POST['pincode'])) {
    // Handle error (e.g., redirect to an error page)
    header("location:error.php");
    exit();
}

extract($_POST);

include_once("db_conn.php");

// Sanitize input
$jobCat = mysqli_real_escape_string($conn, $jobCat);
$jobTle = mysqli_real_escape_string($conn, $jobTle);
$jobDesp = mysqli_real_escape_string($conn, $jobDesp);
$address = mysqli_real_escape_string($conn, $address);
$pincode = intval($pincode); // Assuming pincode is an integer

if (isset($sid)) {
    $qry = "INSERT INTO job(cid, job_cat, job_tle, job_desp, address, pincode, time, sid) VALUES ($cid, '$jobCat', '$jobTle', '$jobDesp', '$address', $pincode, current_timestamp, $sid);";
} else {
    $qry = "INSERT INTO job(cid, job_cat, job_tle, job_desp, address, pincode, time) VALUES ($cid, '$jobCat', '$jobTle', '$jobDesp', '$address', $pincode, current_timestamp);";
}

if (!mysqli_query($conn, $qry)) {
    // Handle query error (e.g., log the error)
    error_log("Database query failed: " . mysqli_error($conn));
    header("location:error.php");
    exit();
}


header("location:cdash.php");

?>
