<?php
    include_once("db_conn.php");
    $id = $_GET['id'];
    $wqry = "select job_id,job_tle,work_done,name,sid from job,user where sid=$id and user.id=job.cid order by time desc;";
    $res = mysqli_query($conn,$wqry);
    while($val = $res->fetch_assoc()){
        $jid = $val['job_id'];
        $tle = $val['job_tle'];
        $wdone = $val['work_done'];
        $nm = $val['name'];
        $sid = $val['sid'];

        $str="";

        if($sid == $id && $wdone == 0){
            $str = <<<idfr
            <tr>
                <td class="fw-bold">$nm</td>
                <td class="d-flex justify-content-end">
                    <button class="btn btn-primary mx-2" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#viewDetails" onclick="vDetails2($jid, '$nm')">View</button>
                    <button class="btn btn-warning mx-2" onclick="cancelWork($jid)">Cancel</button>
                    <button class="btn btn-danger" onclick="deleteJob($jid)">Job done</button>
                </td>
            </tr>
            idfr;
        } else if ($sid == $id && $wdone == 1){
            $str = <<<idfr
            <tr>
                <td class="fw-bold">$nm</td>
                <td class="d-flex justify-content-end">
                    <button class="btn btn-primary mx-2" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#viewDetails" onclick="vDetails2($jid, '$nm')">View</button>
                    <button class="btn btn-danger" onclick="deleteJob($jid)">Job Done</button>
                </td>
            </tr>
            idfr;
        }
        


        echo $str;
    }

?>