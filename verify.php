    <?php include_once("header.php"); ?>
    <?php include_once("navbar.php"); ?>

    <?php

        $em = base64_decode(explode("?",$_SERVER["REQUEST_URI"])[1]);

        include_once("db_conn.php");

        $qry = "update user set verification=1 where email='$em'";

        if($conn->query($qry)){
            echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
            <div>
              Account Activated Successfully
            </div>
          </div>";
        }

    ?>

    <div class="container">
        Click Here go to the <a href="index.php">Login Page</a>
    </div>

  <?php include_once("footer.php") ?>




