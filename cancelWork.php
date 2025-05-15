<?php
include_once("db_conn.php");

if (isset($_GET['jid']) && is_numeric($_GET['jid'])) {
    $jid = intval($_GET['jid']);  // Ensures jid is an integer

    $stmt = $conn->prepare("UPDATE job SET sid = 0 WHERE job_id = ?");
    $stmt->bind_param("i", $jid);

    if ($stmt->execute()) {
        echo "Job updated successfully.";
    } else {
        echo "Error updating job: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid job ID.";
}

$conn->close();
?>
