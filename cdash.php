<?php
session_start();

if (!isset($_SESSION["utype"]) || $_SESSION["utype"] != "customer") {
    header("location:index.php");
}

include_once("header.php");
include_once("cnav.php");


?>



<!DOCTYPE html>
<html>
<head>
    
    <title>Service Provider Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    


 
    <style>
     
     
    
  
     
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            color: white;
        }
     
        .close {
            cursor: pointer;
            color: white;
            background: rgb(255, 255, 255);
            
        }
        .wlist {
            
            color: white;
            background: rgb(221, 39, 39);
            
        }
        </style>
        <style>
        body {
            
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('index16.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            
            
           
        }

        .header {
            text-align: center;
            background: rgb(255, 255, 255);
            backdrop-filter: blur(30px);
            padding: 20px;
            color: black;
            font-size: 28px;
            font-weight: bold;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 15px rgb(0, 0, 0);
        }

        .container {
            backdrop-filter: blur(30px);
            background-color: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            color: white;
        }

        .card {
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 0, 0, 0.75);
            border-radius: 20px;
            padding: 20px;
            width: 100%;
            max-width: 350px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 67x 30px rgba(0, 0, 0, 0.15);
            color: white;
            text-align: center;
            
        }

        .card:hover {
            transform: scale(1.05);
            background: rgb(0, 0, 0);
           
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
        }

        .btn {
            background-color:rgb(255, 0, 0);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color:rgb(179, 0, 0);
        }

        .modal-content {
    background: rgba(224, 218, 218, 0.23);
    backdrop-filter: blur(30px);
    color: white;
    border-radius: 15px;
}

/* Force black text inside form controls */
.modal-content input,
.modal-content textarea,
.modal-content select {
    color: #000 !important;
    background-color: #fff !important; /* Optional: for visibility */
}

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
        .cmbtn:hover {
    background-color: #343a40 !important;
    transition: background-color 0.2s ease;
}
    </style>
     <style>
    /* Override Bootstrap's close button (× icon) */
    .btn-close {
        filter: invert(1); /* makes the close icon white */
    }

    /* OR: Style a custom close button */
    .close {
        cursor: pointer;
        color: white;
        background: #333;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
    }
  </style>
</head>

<body>
   

        
    <div class="modal" id="chatModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Chat with Provider</h3>
            <p>Coming soon...</p>
        </div>
    </div>
    <script>
        function closeModal() {
            document.getElementById('chatModal').style.display = 'none';
        }
    </script>
</body>
</html>

<!-- work buttons -->
<style>
.custom-btn {
    background: linear-gradient(135deg,rgb(255, 0, 0),rgb(255, 0, 0));
    color: #fff;
    font-weight: 600;
    font-size: 18px;
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    box-shadow: 0 8px 24px rgba(255, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    
}

.custom-btn:hover {
    background: linear-gradient(135deg,rgb(255, 0, 0),rgb(255, 0, 0);
    box-shadow: 0 12px 32px rgb(255, 0, 0);
    transform: translateY(-2px);
}
.custom-btn + .custom-btn {
    margin-left: 94px;
}

</style>

<div class="container text-center mb-4">
         <div class="container">
   
    <div class="header">
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        
     
    </div>
   </div>
<br>
<br>
    <button type="button" class="btn custom-btn my-2 me-4" data-bs-toggle="modal" data-bs-target="#crtJobs" onclick="crtJobFun()">
        ➕ Add Work Details
    </button>


    <button type="button" class="btn custom-btn my-2" data-bs-toggle="modal" data-bs-target="#workList">
        📋 View Work List
    </button>

</div>




<style>
/* Sticky container */
.search-wrapper {
    position: sticky;
    top: 0;
    background-color: transparent;
    z-index: 1000;
    display: flex;
    justify-content: center;
    padding-top: 10px;
}

/* Core search bar container */
.search-bar-dark {
    background:rgba(31, 31, 31, 0.49);
    padding: 6px 10px;
    border-radius: 30px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
    max-width: 550px;
    width: 100%;
}

/* Dropdown */
.form-dark {
    background-color:rgba(42, 42, 42, 0.95);
    color: #e0e0e0;
    border: none;
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 14px;
    height: 34px;
    flex-grow: 1;
}

.form-dark:focus {
    outline: none;
    box-shadow: 0 0 0 2pxrgb(255, 0, 0);
}

/* Search button */
.search-btn-dark {
    background:rgb(255, 0, 0);
    color: #fff;
    border: none;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.search-btn-dark:hover {
    background:rgb(255, 0, 0);
}



</style>
<div class="search-wrapper sticky-top py-2">
    <div class="search-bar-dark d-flex align-items-center gap-2">
        <select class="form-select form-dark" id="stype">
            <option selected>Select Service Type (ALL)</option>
            <option value="Painter">Painter</option>
            <option value="Electrician">Electrician</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Gardener">Gardener</option>
            <option value="Plumber">Plumber</option>
            <option value="House cleaner">House cleaner</option>
        </select>

        <button class="btn search-btn-dark" onclick="searchService()">🔍</button>
    </div>
</div>




<!-- Create Work -->
<div class="modal fade" id="crtJobs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" method="POST" action="crtJob.php">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Work Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cwBody">
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="jobCat" name="jobCat" onclick="jbtnact()">
                        <option selected disabled>Select Work Category</option>
                        <option value="Painter">Painter</option>
                        <option value="Electrician">Electrician</option>
                        <option value="Carpenter">Carpenter</option>
                        <option value="Gardener">Gardener</option>
                        <option value="Plumber">Plumber</option>
                        <option value="House cleaner">House cleaner</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Work Title</label>
                    <input type="text" class="form-control" id="jobTitle" name="jobTle">
                </div>
                <div class="mb-3">
                    <label for="jobDescription" class="form-label">Work Description</label>
                    <textarea class="form-control" id="jobDescription" rows="4" name="jobDesp"></textarea>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" rows="4" name="address"><?php echo $_SESSION['address']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" class="form-control" name="pincode" value="<?php echo $_SESSION['pincode']; ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="jobBtn" disabled>Submit</button>
            </div>
        </form>
    </div>
</div>


<!-- Work List -->
<div class="modal fade" id="workList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark text-white"><!-- Apply dark background and white text -->
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-white" id="exampleModalLabel">Work List</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-dark text-white"><!-- Dark table with white text -->
                    <tbody id="wList">
                        <!-- Dynamic rows go here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-top">
                <!-- Optional footer content -->
            </div>
        </div>
    </div>
</div>


<!-- Edit Worklist -->
<div class="modal fade" id="editWorkList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <form class="modal-content" action="updateWorkList.php" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Worklist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadWorkList">
                ...
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Chat List Offcanvas -->



<div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="mb-0">Messages</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="overflow-auto">
            <table class="table table-dark table-hover mb-0">
                <tbody>
                    <?php
                    include_once("db_conn.php");
                    $cid = $_SESSION['id'];
                    $qry = "SELECT DISTINCT(user.id), name, pfpic 
                            FROM user, chat 
                            WHERE user.id = chat.sid AND cid = $cid 
                            ORDER BY time DESC";

                    $res = $conn->query($qry);

                    while ($val = $res->fetch_assoc()) {
                        $snm = htmlspecialchars($val['name']);
                        $sid = $val['id'];
                        $pfpic = htmlspecialchars($val['pfpic']);

                        $str = <<<HTML
                            <tr style="cursor:pointer;" class="cmbtn align-middle" 
                                data-bs-toggle="offcanvas" 
                                data-bs-target="#cmsg" 
                                aria-controls="offcanvasRight" 
                                onclick='loadMsg($sid,"$snm")'>
                                <td class="d-flex align-items-center gap-3 py-3">
                                    <img src="$pfpic" alt="avatar" height="50" width="50" class="rounded-circle shadow-sm" />
                                    <span class="fw-semibold fs-6">$snm</span>
                                </td>
                            </tr>
                        HTML;

                        echo $str;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Chat Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cmsg" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <span data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="color: grey;" onclick="clmsgintvrl()">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
      </svg>
    </span>
    <h5 id="offcanvasRightLabel">Messages</h5>
    <button type="button" class="btn-close text-reset" onclick="clmsgintvrl()" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          <!-- Send Location Button -->
      <div class="d-flex justify-content-end mb-2">
        <button type="button" onclick="sendLiveLocation()" class="btn btn-outline-warning btn-sm">
          📍 Send Live Location
        </button>
      </div>
  </div>
<script>
  function sendLiveLocation() {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(function(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        const mapLink = `https://www.google.com/maps?q=${lat},${lng}`;
        
        // Add clickable link to the chat area
        const msgDiv = document.getElementById("msg");
        const messageElement = document.createElement("div");
        messageElement.className = "text-light mb-2";
        messageElement.innerHTML = `<a href="${mapLink}" target="_blank" class="text-info text-decoration-underline">📍 My Live Location</a>`;
        msgDiv.appendChild(messageElement);
        msgDiv.scrollTop = msgDiv.scrollHeight;

      }, function(error) {
        alert("Unable to retrieve location.");
      });
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }
</script>

  <div class="offcanvas-body">
    <div class="position-relative h-100">
      
      <!-- Message Display Area -->
      <div id="msg" class="d-flex flex-column overflow-auto text-wrap" style="height: 85%;">
      </div>

      <hr>



      <!-- Message Input & Send -->
      <div class="d-flex position-absolute bottom-0 w-100 bg-dark p-3">
        <input type="text" class="form-control text-white bg-secondary border-0" id="msgval" placeholder="Type Message Here ...">
        <button type="button" onclick="sendMsg()" class="btn btn-primary mx-2 px-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
          </svg>
        </button>
      </div>

    </div>
  </div>
</div>

<!-- JavaScript for Location Sharing -->
<script>
  function sendLiveLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        const mapLink = `https://www.google.com/maps?q=${lat},${lon}`;
        document.getElementById('msgval').value = mapLink;
        sendMsg(); // Optional: comment this out if you want manual sending
      }, function () {
        alert('Unable to retrieve your location.');
      });
    } else {
      alert('Geolocation is not supported by your browser.');
    }
  }

  function sendMsg() {
    const message = document.getElementById("msgval").value;
    if (message.trim() === "") return;

    // Sample message appending – replace with actual backend logic
    const msgBox = document.getElementById("msg");
    const newMsg = document.createElement("div");
    newMsg.className = "bg-primary text-white p-2 rounded mb-2 align-self-end";
    newMsg.innerText = message;
    msgBox.appendChild(newMsg);

    document.getElementById("msgval").value = "";
    msgBox.scrollTop = msgBox.scrollHeight;
  }

  function clmsgintvrl() {
    // Add your cleanup or close logic if needed
  }
</script>



<!-- service provider card -->
<div class="container">
    <div class="row justify-content-evenly" id="usCard">
        <?php

        include_once("db_conn.php");

        $id = $_SESSION["id"];

        $spqry = "select service.id,name,s_type,pfpic from user,service where utype='service provider' and user.id=service.id and pincode=(select pincode from user where id=$id) limit 6;";
        $spres = $conn->query($spqry);

        while ($val = $spres->fetch_assoc()) {
            $snm = $val['name'];
            $stp = $val['s_type'];
            $sid = $val['id'];
            $pfpic = $val['pfpic'];

            $str = <<<idfr
            <div class='card text-center border-primary border-3 rounded-3 m-2 col-md-4 col-sm-6 shadow-lg'>
            <img src='$pfpic' class='card-img-top w-50 h-50 mx-auto mt-3 d-block' alt='avatar' style="clip-path:circle(40%)">
            <hr>
            <div class='card-body'>
            <h5 class='card-title'>$snm</h5>
            <p class='card-text'>$stp</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vService" onclick="vProfile($sid,'$snm','$stp')"> View Profile </button>
            </div>
            </div>
            idfr;

            echo $str;
        }

        ?>
    </div>
</div>

<!-- View Service Provider Profile -->
<div class="modal fade" id="vService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="vProf">
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class='btn btn-primary cmbtn' data-bs-toggle='offcanvas' data-bs-target='#cmsg' aria-controls='offcanvasRight' data-bs-dismiss="modal" id="mBtn"></button>
        <button type="button" class="btn btn-primary" id="bnBtn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#crtJobs">Book Now</button>
                <button type="button" class='btn btn-primary cmbtn' data-bs-toggle='offcanvas' data-bs-target='#cmsg' aria-controls='offcanvasRight' data-bs-dismiss="modal" id="mBtn"></button>
      </div>
    </div>
  </div>
</div>


<script>
    var sid2, snm2;
    var msgwin = document.getElementById('msg');
    var ldmsgintvrl;

    function jbtnact() {
        let l = document.getElementById('jobCat');
        if (l.selectedIndex > 0) {
            document.getElementById('jobBtn').disabled = false;
        }
    }

    function sendMsg() {
        var msgText = document.getElementById('msgval').value;
        var xhttp = new XMLHttpRequest();
        document.getElementById('msgval').value = "";
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("msg").innerHTML = this.responseText;
                msgwin.scrollTop = msgwin.scrollHeight;
            }
        };
        xhttp.open("GET", "setmsg.php?cid=<?php echo $_SESSION['id']; ?>&sid=" + sid2 + "&msgText=" + msgText + "&dirtn=cts", true);
        xhttp.send();
    }

    function loadMsg(sid, snm) {
        sid2 = sid;
        snm2 = snm;
        document.getElementById('offcanvasRightLabel').innerText = snm;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("msg").innerHTML = this.responseText;
                msgwin.scrollTop = msgwin.scrollHeight;
            }
        };
        xhttp.open("GET", "getmsg.php?cid=<?php echo $_SESSION['id']; ?>&sid=" + sid + "&dirtn=cts", true);
        xhttp.send();
    }

    function vProfile(sid,snm,stp){
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("vProf").innerHTML = this.responseText;
                document.getElementById("mBtn").setAttribute("onclick","loadMsg("+sid+",\'"+snm+"\')");
                document.getElementById("bnBtn").setAttribute("onclick","bookNow("+sid+",\'"+stp+"\')");
            }
        };
        xhttp.open("GET", "viewProfile.php?sid="+sid, true);
        xhttp.send();
    }

    function bookNow(sid,cat){
        document.getElementById("jobCat").value=cat;
        document.getElementById("jobCat").classList.add("visually-hidden");
        let ctn = document.getElementById("cwBody");
        if(document.getElementById("jobSid")){
            document.getElementById("jobSid").remove();
        }
        let el = document.createElement("input");
        el.setAttribute("value",sid);
        el.setAttribute("id","jobSid");
        el.classList.add("form-control");
        el.classList.add("visually-hidden");
        el.setAttribute("name","sid");
        ctn.appendChild(el);
        document.getElementById('jobBtn').disabled = false;
    }

    function crtJobFun(){
        document.getElementById('jobBtn').disabled = true;
        document.getElementById("jobCat").disabled = false;
        document.getElementById('jobCat').selectedIndex = 0;
        if(document.getElementById("jobSid")){
            document.getElementById("jobSid").remove();
        }
    }

    function workList() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("wList").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "workList.php?id=<?php echo $_SESSION['id']; ?>", true);
        xhttp.send();
    }

    setInterval(workList, 2000);

    function deleteWorkList(jid) {
        if (confirm("Are you sure you want to delete?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "deleteWorkList.php?jid=" + jid, true);
            xhttp.send();
        }
    }

    function editWorkList(jid) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("loadWorkList").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "getWorkList.php?jid=" + jid, true);
        xhttp.send();
    }


    function clmsgintvrl() {
        clearInterval(ldmsgintvrl);
    }

    document.querySelector('#msgval').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMsg();
        }
    });

    document.querySelector('.cmbtn').addEventListener('click', () => {
        ldmsgintvrl = setInterval(loadMsg, 1000, sid2, snm2);
    });

    function loagImg(event) {
        var image = document.getElementById('prfimg');
        image.src = URL.createObjectURL(event.target.files[0]);
    }

    function searchService() {
        let stype = document.getElementById("stype").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("usCard").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "csearchService.php?stype=" + stype+"&id=<?php echo $_SESSION['id']; ?>", true);
        xhttp.send();
    }



</script>


<style>
    .bg-switch-btn {
    position: -webkit-sticky;
    top: 15px;
    right: 20px;
    z-index: 1100;
    border: 1px solid white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    background-color: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.bg-switch-btn:hover {
    background-color: rgba(255, 255, 255, 0.25);
    color: #000;
}





<?php include_once("footer.php") ?>