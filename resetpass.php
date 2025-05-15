    <?php include_once("header.php") ?>
    <?php include("navbar.php"); ?>

    <?php

        extract($_POST);

        $em = base64_decode(explode("?",$_SERVER["REQUEST_URI"])[1]);

        if (isset($subBtn)) {

            include_once("db_conn.php");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $qry = "update user set pwd='$pwd' where email='$em';";

            if ($conn->query($qry)) {
                echo "<p style='color:green'> Password Changed </p>";
                header("location:index.php");
            } else {
                echo "<p style='color:red'> Error Occured </p>";
                header("location:index.php");
            }
        }

    ?>

    <br><br>
    <div class="container-md mt-5 col-8 border border-5 rounded-3 pb-5 px-5">
        <form method="post" onsubmit="return conpass()" on >
            <div class="mb-3">
                <br><br>
                <label for="exampleInputEmail1" class="form-label">New Password</label>
                <input type="password" minlength="8" maxlength="16" class="form-control" id="p1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="p2" name="pwd" onkeyup="checkpass()" >
            </div>
            <p style="color:red" id="conmsg"></p>
            <div class="d-grid gap-2 col-2 mx-auto">
                <button type="submit" class="btn btn-primary" name="subBtn">Submit</button>
            </div>
            <p id="demo"></p>
        </form>



    </div>
    <script>

        function checkpass(){
            let pass1 = document.getElementById('p1').value;
            let pass2 = document.getElementById('p2').value;
            if(pass1 != pass2)
                document.getElementById('conmsg').innerHTML = "Password does not match !";
            else
                document.getElementById('conmsg').innerHTML = "";
        }

        function conpass(){
            let pass1 = document.getElementById('p1').value;
            let pass2 = document.getElementById('p2').value;
            if(pass1 == pass2)
                return true;
            else
                alert("Password does not match !, Please check it")
                return false;

        }

    </script>

<?php include_once("footer.php") ?>