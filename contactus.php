<?php
include_once("db_conn.php");

$str = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subBtn'])) {
    $Fname = $_POST['Fname'] ?? '';
    $email = $_POST['email'] ?? '';
    $comment = $_POST['comment'] ?? '';

    if (!empty($Fname) && !empty($email) && !empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO contact (name, email, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $Fname, $email, $comment);

        if ($stmt->execute()) {
            $str = "We received your message, we will contact you shortly!";
        } else {
            $str = "Something went wrong. Please try again.";
        }

        $stmt->close();
    } else {
        $str = "All fields are required.";
    }
}

include_once("header.php");
include_once("navbar.php");
?>

<!-- Page content -->
<h2 class="text-center mt-5 mb-4 display-4 text-warning">Contact Us</h2>

<div class="container mt-5 border border-4 rounded shadow-lg p-5 blurred-box" style="max-width: 700px;">

    <form method="POST">
        <div class="mb-4">
            <label class="form-label fs-4 text-dark">Full Name</label>
            <input type="text" name="Fname" class="form-control form-control-lg border-info" placeholder="Enter your full name" required>
        </div>
        <div class="mb-4">
            <label class="form-label fs-4 text-dark">Email Address</label>
            <input type="email" name="email" class="form-control form-control-lg border-info" placeholder="Enter your email" required>
        </div>
        <div class="mb-4">
            <label class="form-label fs-4 text-dark">Comment</label>
            <textarea name="comment" rows="4" class="form-control form-control-lg border-info" placeholder="Write your comment here" required></textarea>
        </div>
        <button type="submit" name="subBtn" class="btn btn-primary btn-lg w-100 mt-4 hover-shadow">Submit</button>
    </form>
</div>

<?php
if (!empty($str)) {
    echo "<div class='text-center mt-3 alert alert-info animated fadeIn'>$str</div>";
}
include_once("footer.php");
?>

<!-- Custom Styles -->
<style>
    body {
        background: url('contact2.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .blurred-box {
        background: rgba(255, 255, 255, 0.2); /* Light translucent white */
        backdrop-filter: blur(10px);          /* Blur effect */
        -webkit-backdrop-filter: blur(10px);  /* Safari support */
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
    }

    .form-control:hover {
        border-color: #007bff;
        box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .alert {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>

