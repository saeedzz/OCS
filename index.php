<?php

extract($_POST);

if (isset($subBtn)) {

    include_once("db_conn.php");

    if ($conn->connect_error) {
        die("Connection failed");
    }

    $qry = "select * from user where email='$email' and pwd='$pwd';";


    $res = $conn->query($qry);


    if ($res->num_rows > 0) {
        $a = mysqli_fetch_assoc($res);

        if ($a["verification"] == 1) {
            session_start();

            $_SESSION["name"] = $a["name"];
            $_SESSION["email"] = $a["email"];
            $_SESSION["utype"] = $a["utype"];
            $_SESSION["id"] = $a["id"];
            $_SESSION["pfpic"] = $a["pfpic"];
            $_SESSION["address"] = $a["address"];
            $_SESSION["pincode"] = $a["pincode"];

            if (isset($rme)) {
                setcookie("cred", "$email:$pwd", time() + 86400, '/');
            }

            if($a["utype"] == "service provider"){
                $id = $a["id"];
                $sqry = "select s_type from service where id=$id;";
                $res2 = mysqli_query($conn,$sqry);
                $val = mysqli_fetch_assoc($res2);
                $_SESSION['s_type'] = $val['s_type'];
            }


            if ($a["utype"] == "customer") {
                header("location:cdash.php");
            } else if ($a["utype"] == "service provider") {
               
                
                header("location:sdash.php");
            }else if($a["utype"] == "admin"){
                header("location:admin.php");
            }
        } else {
            echo "<p style='color:green'> <br>Verification Link Send to your email, please activate your account </p>";
            include_once("send_email.php");
            $msg = "http://" . $_SERVER["SERVER_NAME"] . "/gnt_service/verify.php?" . base64_encode($email);
            send_link($email, "GNT_Service", $msg, "Verify your Account with GNT Service");
        }
    } else {
        echo "<p style='color:red'> <br>Incorrect email or password </p>";
    }
}
?>
<?php include_once("header.php"); ?>
<?php include_once("navbar.php"); ?>
<br>
<?php




// Dynamic heading text

$heading = "Online Worker finding system!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Glowing Heading with Changing Text</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: url('your-background.jpg') no-repeat center center/cover;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      text-align: center;
    }

    .heading-container {
      padding: 30px 50px;
      background: rgba(51, 49, 49, 0.55);
      backdrop-filter: blur(30px);
      border-radius: 20px;
      box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
      animation: fadeIn 1.2s ease-in-out;
    }

    h1 {
      font-size: 42px;
      font-weight: 600;
      color: #fff;
      animation: glowColors 4s infinite linear;
      text-shadow:
        0 0 10px #fff,
        0 0 20px #ff00de,
        0 0 30px #ff00de,
        0 0 40px #00eaff,
        0 0 50px #00eaff;
    }

    #subheading {
      font-size: 20px;
      font-weight: 300;
      margin-top: 10px;
      color: rgba(255, 255, 255, 0.85);
      animation: pulseText 3s ease-in-out infinite;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowColors {
      0% { text-shadow: 0 0 10px #ff004f, 0 0 20px #ff004f, 0 0 30px #ff004f; }
      25% { text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff, 0 0 30px #00f7ff; }
      50% { text-shadow: 0 0 10px #39ff14, 0 0 20px #39ff14, 0 0 30px #39ff14; }
      75% { text-shadow: 0 0 10px #ffd700, 0 0 20px #ffd700, 0 0 30px #ffd700; }
      100% { text-shadow: 0 0 10px #ff004f, 0 0 20px #ff004f, 0 0 30px #ff004f; }
    }

    @keyframes pulseText {
      0%, 100% { opacity: 0.8; }
      50% { opacity: 1; }
    }
  </style>
</head>
<body>

<div class="heading-container">
  <h1><?php echo $heading; ?></h1>
  <p id="subheading">Your one-stop solution for all services.</p>
</div>

<script>
  const subheading = document.getElementById('subheading');
  const messages = [
    "Your one-stop solution for all services.",
    "Find verified workers instantly!",
    "Reliable services at your doorstep.",
    "Connecting you with local experts.",
    "Fast, easy, and trusted service."
  ];

  let i = 0;
  setInterval(() => {
    subheading.textContent = messages[i];
    i = (i + 1) % messages.length;
  }, 3000); // Change every 3 seconds
</script>

</body>
</html>



<style>
    body {
        background: url('index8.jpg') no-repeat center center/cover;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
        background: rgba(0, 0, 0, 0.26);
        backdrop-filter: blur(20px);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.6);
        text-align: center;
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-container h2 {
        color: #fff;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .input-group-text {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        color: #fff;
    }

    .btn-primary {
        background: linear-gradient(135deg,rgb(183, 29, 93), #ff758c);
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        transition: background 0.3s, transform 0.2s;
        margin-bottom: 20px;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #ff6384, #ff3366);
        transform: scale(1.05);
    }

    .login-links a {
        text-decoration: none;
        color: #ff7eb3;
        transition: color 0.3s;
    }

    .login-links a:hover {
        color: #ff3366;
    }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    footer {
    position: relative;
    width: 100%;
    margin-top: 20px;
}
</style>
<br>
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="login-container">
        <h2>Login to GNT Service</h2>
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-white">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="pwd" required>
                    <span class="input-group-text">
                        <i class="bi bi-eye-slash-fill" id="togglePassword"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3 form-check text-white">
                <input type="checkbox" class="form-check-input" name="rme">
                <label class="form-check-label">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="subBtn">Login</button>
        </form>

        <div class="login-links mt-3">
            <a href="forgotpass.php">Forgot Password?</a> | <a href="register.php">New User?</a>
        </div>
    </div>
</div>


</div>

<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {

            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });
    </script>
<div class="robot-box" id="robotBox"></div>

<script>
    const messages = [
        "Hello there! Need any help?",
        "Did you know? We offer 24/7 support!",
        "Keep your password secure!",
        "New features coming soon! Stay tuned!"
    ];
    function displayRandomMessage() {
        const randomIndex = Math.floor(Math.random() * messages.length);
        document.getElementById("robotBox").innerText = messages[randomIndex];
    }
    setInterval(displayRandomMessage, 5000);
    displayRandomMessage();
</script>
<?php include_once("footer.php"); ?>
