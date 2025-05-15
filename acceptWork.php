<?php
include_once('db_conn.php');

if (!isset($_GET['jid']) || !isset($_GET['sid'])) {
    die("Missing required parameters.");
}

$jid = $_GET['jid'];
$sid = $_GET['sid'];

// Validate inputs as integers
if (!filter_var($jid, FILTER_VALIDATE_INT) || !filter_var($sid, FILTER_VALIDATE_INT)) {
    die("Invalid input.");
}

// Use prepared statements to prevent SQL Injection
$aqry = "UPDATE job SET sid = ? WHERE job_id = ?";
$stmt = mysqli_prepare($conn, $aqry);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $sid, $jid);
    if (mysqli_stmt_execute($stmt)) {
        echo "Job updated successfully.";
    } else {
        echo "Error updating job: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Database query preparation failed.";
}

mysqli_close($conn);
?>
