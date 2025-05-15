<?php
include_once("db_conn.php");

if (!$conn) {
    die("Database connection error.");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Request");
}

$id = intval($_GET['id']); // Prevent SQL Injection

// Secure Query with Prepared Statements
$stmt = $conn->prepare("SELECT j.job_id, j.job_tle, j.work_done, j.sid, u.name as worker_name 
                        FROM job j 
                        LEFT JOIN user u ON j.sid = u.id 
                        WHERE j.cid = ? 
                        ORDER BY j.time DESC;");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

$rows = $res->fetch_all(MYSQLI_ASSOC);

if (empty($rows)) {
    echo "<tr><td colspan='2' class='text-center text-muted'>No jobs found.</td></tr>";
} else {
    foreach ($rows as $val) {
        $jid = $val['job_id'];
        $tle = htmlspecialchars($val['job_tle']); // Prevent XSS
        $wdone = $val['work_done'];
        $sid = $val['sid'];
        $nm = htmlspecialchars($val['worker_name'] ?? ''); // Avoid undefined errors

        // Define button templates
        $buttonTemplates = [
            "not_assigned_not_done" => "
                <button class='btn btn-primary mx-2' data-bs-dismiss='modal' data-bs-toggle='modal' data-bs-target='#editWorkList' onclick='editWorkList($jid)'>Edit</button>
                <button class='btn btn-danger' onclick='deleteWorkList($jid)'>Delete</button>",
            "assigned_not_done" => "
                <button type='button' class='btn btn-primary mx-2 cmbtn' data-bs-toggle='offcanvas' data-bs-target='#cmsg' aria-controls='offcanvasRight' data-bs-dismiss='modal' onclick='loadMsg($sid, \"$nm\")'>Message</button>
           
                <button class='btn btn-danger mx-2' onclick='deleteWorkList($jid)'>Delete</button>",
            "assigned_done" => "
                <button class='btn btn-outline-warning'>Review and Rating</button>
                <button class='btn btn-danger mx-2' onclick='deleteWorkList($jid)'>Delete</button>"
        ];

        // Determine button set based on conditions
        if ($sid == 0 && $wdone == 0) {
            $buttons = $buttonTemplates["not_assigned_not_done"];
        } elseif ($sid != 0 && $wdone == 0) {
            $buttons = $buttonTemplates["assigned_not_done"];
        } elseif ($sid != 0 && $wdone == 1) {
            $buttons = $buttonTemplates["assigned_done"];
        } else {
            $buttons = ""; // Default empty case (should not happen)
        }

        // Output Table Row
        echo "<tr>
                <td class='fw-bold'>$tle</td>
                <td class='d-flex justify-content-end'>$buttons</td>
              </tr>";
    }
}

$stmt->close();
?>
