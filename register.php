<?php include_once("header.php"); ?>
<?php include("navbar.php"); ?>

<style>
    body {
        background: url('index8.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .content-container {
        margin-top: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 100px);
        padding-bottom: 50px;
    }

    .register-container {
        background: rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(30px);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.32);
        color: white;
        width: 100%;
        max-width: 500px;
    }

    /* DARKER INPUT BOXES */
    .form-control {
        background: rgba(255, 255, 255, 0.2);
        color: white; /* White text */
        border: 2px solid #555; /* Slight border */
        border-radius: 10px;
        padding: 10px;
        transition: 0.3s;
    }

    /* Glow effect on focus */
    .form-control:focus {
        background: #fff;
        border-color:rgb(164, 30, 75);
        box-shadow: 0 0 8px rgba(255, 61, 142, 0.77);
        outline: none;
    }

    .btn-primary {
        background: linear-gradient(to right,rgb(175, 20, 87),rgb(199, 51, 118));
        border: none;
        border-radius: 50px;
        padding: 10px;
        font-size: 18px;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(to right,rgb(155, 20, 76),rgb(190, 35, 102));
        transform: scale(1.05);
    }

    .text-link {
        color:rgba(255, 255, 255, 0.99);
        text-decoration: none;
    }

    .text-link:hover {
        text-decoration: underline;
    }
    
</style>

<div class="content-container">
    <div class="register-container">
        <h2 class="text-center mb-4">Create Your Account</h2>

        <?php
        include_once("send_email.php");

        extract($_POST);
        if (isset($subBtn)) {
            include_once("db_conn.php");

            $chkqry = "SELECT * FROM user WHERE email='$email' OR aadhaar='$adn';";
            $res = $conn->query($chkqry);

            if (!$res->num_rows > 0) {
                $qry = "INSERT INTO user(name, gender, email, dob, pwd, aadhaar, utype, address, pincode) 
                        VALUES('$uname', '$gender', '$email', '$dob', '$pwd', '$adn', '$utype', '$address', '$pincode');";

                if ($conn->query($qry)) {
                    echo "<div class='alert alert-success text-center'>Activation link sent to your email!</div>";
                    $msg = "http://" . $_SERVER["SERVER_NAME"] . "/gnt_service/verify.php?" . base64_encode($email);
                    send_link($email, "GNT_Service", $msg, "Verify your Account with GNT Service");
                }
            } else {
                echo "<div class='alert alert-warning text-center'>Email or Aadhaar already registered!</div>";
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="uname" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" checked>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female">
                        <label class="form-check-label">Female</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="pwd" minlength="8" maxlength="16" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Aadhaar Number</label>
                <input type="number" class="form-control" name="adn" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Register as</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="utype" value="customer">
                        <label class="form-check-label">Customer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="utype" value="service provider" checked>
                        <label class="form-check-label">Service Provider</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Pincode</label>
                <input type="number" class="form-control" name="pincode" required>
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" required>
                <label class="form-check-label">Agree to Terms and Conditions</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="subBtn">Sign Up</button>
            </div>

            <div class="text-center mt-3">
                <a href="index.php" class="text-link">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>

<?php include_once("footer.php"); ?>
<?php

