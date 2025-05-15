<?php
    include_once("db_conn.php");

    $qry = "select * from contact;";
    $res = mysqli_query($conn,$qry);
    $c=1;

    while($val = $res->fetch_assoc()){
        $conid=$val["id"];
        $nm = $val["name"];
        $em = $val["email"];
        $cm = $val["comment"];

        $str=<<<idfr
        <tr>
        <td>$c</td><td>$nm</td><td><a href="mailto:$em">$em</a></td><td>$cm</td><td><button onclick="deleteCon($conid)" class="btn btn-danger">Delete</button></td>
        </tr>
        idfr;

        echo $str;

        $c = $c+1;

    }

?>