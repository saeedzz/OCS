<?php

      include_once("db_conn.php");
      $sid = $_GET['id'];
      $ctqry = "select job_id,job.cid,name,pfpic,work_done,job.sid from user,job,service where job_cat=(select s_type where service.id=$sid) and job.pincode=(select pincode from user where id=$sid) and job.cid=user.id;";

      $res = mysqli_query($conn, $ctqry);
      while ($val2 = $res->fetch_assoc()) {
        $cnm2 = $val2['name'];
        $cid2 = $val2['cid'];
        $pfpic = $val2['pfpic'];
        $jid = $val2['job_id'];
        $wdone = $val2['work_done'];
        $sid2 = $val2['sid'];

        $str2 = "";

        if ($wdone == 0 && $sid2 == 0) {
          $str2 = <<<ccard
          <div class="card text-center border-3 rounded-3 m-2" style="width: 18rem;">
          <img src="$pfpic" class="card-img-top w-50 h-50 mx-auto d-block mt-3" alt="avatar"  style="clip-path:circle(40%)">
          <hr>
          <div class="card-body">
            <h5 class="card-title">$cnm2</h5>
            <a href="#" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#viewDetails" onclick="vDetails($cid2,'$cnm2',$jid)" >View Details</a>
          </div>
          </div>
        ccard;
        }

        echo "$str2";
      }

?>
    