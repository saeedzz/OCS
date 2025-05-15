<?php
include_once("db_conn.php");

if (isset($_GET['jid']) && is_numeric($_GET['jid'])) {
    $jid = intval($_GET['jid']); // Ensure jid is an integer

    // Prepare DELETE statement
    $stmt = $conn->prepare("DELETE FROM job WHERE job_id = ?");
    $stmt->bind_param("i", $jid);

    if ($stmt->execute()) {
        echo "Job deleted successfully.";
    } else {
        echo "Error deleting job: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid job ID.";
}

$conn->close();
?>
