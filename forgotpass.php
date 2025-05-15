    <?php include_once("header.php") ?>
    <?php include("navbar.php"); ?>

    <?php
    
    include_once("send_email.php");

    extract($_POST);
    if (isset($subBtn)) {
      include_once("db_conn.php");
      
        $qry = "select * from user where email='$email'";
        $res = $conn->query($qry);
        

      if ($res->num_rows>0) {
        echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
          Password Reset Link Send to your email address ! 
        </div>
      </div>";
        $msg = "http://".$_SERVER["SERVER_NAME"]."/gnt_service/resetpass.php?".base64_encode($email);
        send_link($email,"GNT_Service",$msg,"Password Reset with GNT Service");
      }
      else
      {
        echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
          Password Reset Link Send to your email address ! 
        </div>
      </div>";
      }
    }


    
    ?>

    <br><br>
    <div class="container-md mt-5 col-8 border border-5 rounded-3 pb-5 px-3">
        <form method="post">
            <div class="mb-3">

                <br><br>
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            </div>
  
            <div class="d-grid gap-2 col-md-3 mx-auto">
                <button type="submit" class="btn btn-primary" name="subBtn">Forgot Password</button>
            </div>

        </form>

        <div class="mt-3">
          <a href="index.php"> Login ? </a>
        </div>

    </div>


    <?php include_once("footer.php") ?>