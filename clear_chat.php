<?php
// clear_chat.php
include 'db_conn.php'; // make sure you have this setup

$cid = intval($_POST['cid']);
$sid = intval($_POST['sid']);

if ($cid > 0 && $sid > 0) {
    $stmt = $conn->prepare("DELETE FROM chat WHERE cid = ? AND sid = ?");
    $stmt->bind_param("ii", $cid, $sid);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
} else {
    echo "invalid";
}
$conn->close();
