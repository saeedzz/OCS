<?php
ob_start(); // Start output buffering
session_start();


if (!isset($_SESSION["utype"]) || $_SESSION["utype"] != "service provider") {
  header("location:index.php");
}

include_once("header.php");
include_once("snav.php");

include_once("db_conn.php");

$sid = $_SESSION["id"];











?>



<!-- buttons -->
<div class="container text-center mb-5">
  <button type="button" class="btn btn-primary btn-lg ms-3 my-2" data-bs-toggle="modal" data-bs-target="#workList">
    Work List
  </button>
</div>
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
        }
     
        .close {
            cursor: pointer;
            color: white;
            background: rgb(255, 255, 255);
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
            background: rgba(255, 0, 0, 0.51);
            backdrop-filter: blur(20px);
            padding: 20px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.21);
        }

        .container {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
        }

        .card {
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgb(255, 0, 0);
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
            background: rgba(255, 255, 255, 0.15);
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
        }

        .btn {
            background-color:rgb(255, 3, 3);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color:rgba(255, 0, 0, 0.68);
        }

        .modal-content {
            background: rgba(141, 141, 141, 0.21);
            color: white;
            border-radius: 15px;
        }

        .form-control {
            background: rgba(182, 174, 174, 0.1);
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
<!-- Chat List Offcanvas -->
<div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header border-bottom border-secondary">
    <h5 class="mb-0">Messages</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body p-0">
    <div class="overflow-auto" style="max-height: 100%;">
      <table class="table table-hover table-borderless mb-0 text-white" style="background-color: #000;">
        <tbody>
          <?php
          include_once("db_conn.php");
          $sid = $_SESSION['id'];
          $qry = "SELECT DISTINCT(user.id), name, pfpic 
                  FROM user, chat 
                  WHERE user.id = chat.cid AND sid = $sid 
                  ORDER BY time DESC";

          $res = $conn->query($qry);

          while ($val = $res->fetch_assoc()) {
            $cnm = htmlspecialchars($val['name']);
            $cid = $val['id'];
            $pfpic = htmlspecialchars($val['pfpic']);

            echo <<<HTML
              <tr class="cmbtn align-middle" style="cursor: pointer; background-color: #000;" 
                  data-bs-toggle="offcanvas" data-bs-target="#clientChatBox" 
                  aria-controls="offcanvasRight" onclick='loadMsg($cid, "$cnm")'>
                <td class="p-3">
                  <img src="$pfpic" alt="avatar" height="50" width="50" class="rounded-circle shadow-sm border border-light">
                </td>
                <td class="fw-semibold fs-6 text-white">$cnm</td>
              </tr>
            HTML;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<style>
  #msg {
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .msg-bubble {
    padding: 10px 15px !important;
    border-radius: 20px !important;
    max-width: 70% !important;
    word-break: break-word !important;
    font-size: 0.95rem !important;
  }

  .msg-bubble.sender {
    align-self: end !important;
    background-color:rgba(253, 13, 13, 0.66) !important;
    color: #fff !important;
    border-bottom-right-radius: 0 !important;
  }

  .msg-bubble.receiver {
    align-self: start !important;
    background-color: #000 !important; /* force black background */
  
    border-bottom-left-radius: 0 !important;
  }

  .quick-buttons button {
    margin-bottom: 5px !important;
  }

  .chat-footer {
    background: rgba(0, 0, 0, 0.73) !important;
    border-top: 1px solid #dee2e6 !important;
  }
  
</style>




<!-- Client Chat Box -->
<div class="offcanvas offcanvas-end bg-light" tabindex="-1" id="clientChatBox" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header border-bottom">
    <span data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" onclick="clmsgintvrl()" style="color: grey; cursor: pointer;">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
      </svg> 
    </span>
    <h5 id="offcanvasRightLabel" class="mb-0">Messages</h5>
    <button type="button" class="btn-close" onclick="clmsgintvrl()" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body d-flex flex-column p-0">
    <div id="msg" class="flex-grow-1 overflow-auto px-3 py-3" style="max-height: calc(100vh - 160px);">
      <!-- Sample messages -->
      <!-- <div class="msg-bubble receiver">Hello!</div>
      <div class="msg-bubble sender">Hi there!</div> -->
    </div>

    <!-- Quick Text Buttons -->
    <div class="quick-buttons px-3 pb-2 bg-light">
      <button class="btn btn-outline-secondary btn-sm me-2" onclick="sendQuickText('Hi')">Hi</button>
      <button class="btn btn-outline-secondary btn-sm me-2" onclick="sendQuickText('Send contact')">Send contact</button>
      <button class="btn btn-outline-secondary btn-sm me-2" onclick="sendQuickText('I\'m on my way')">I'm on my way</button>
      <!-- Clear Chat Button -->
<div class="px-3 pb-2">
  <button class="btn btn-danger btn-sm" onclick="clearChat()">Clear Chat</button>
</div>

    </div>

    <!-- Message Input -->
    <div class="chat-footer d-flex align-items-center p-3">
      <input type="text" class="form-control me-2 rounded-pill" id="msgval" placeholder="Type message here...">
      <button type="button" onclick="sendMsg()" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
          <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
        </svg>
      </button>
    </div>
  </div>
</div>

<script>
  function clearChat() {
  const cid = 31; // Replace with actual cid, or get dynamically
  const sid = 41; // Replace with actual sid, or get dynamically

  if (confirm("Are you sure you want to clear this chat?")) {
    fetch("clear_chat.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `cid=${cid}&sid=${sid}`
    })
    .then(res => res.text())
    .then(data => {
      if (data.trim() === "success") {
        document.getElementById("msg").innerHTML = ""; // clear messages in UI
      } else {
        alert("Failed to clear chat.");
      }
    });
  }
}

</script>

<!-- Modal service type -->
<div class="modal fade" id="sTypeDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Welcome, <?php echo $_SESSION['name']; ?> </h5>
      </div>
      <form method="post">
        <div class="modal-body">
          <label for="stype" class="form-label">Please select what service you want to provide ? </label>
          <select class="form-select" aria-label="Default select example" name="stype" id="stlist" onclick="pbtnact()">
            <option selected disabled>Select Service Type</option>
            <option value="Painter">Painter</option>
            <option value="Electrician">Electrician</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Gardener">Gardener</option>
            <option value="Plumber">Plumber</option>
            <option value="House cleaner">House cleaner</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" name="pbtn" class="btn btn-primary mx-auto" id="prcdbtn" disabled>Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Work Details card -->
<div class="container">
  <div class="row justify-content-evenly" id="workCard">
    
  </div>
</div>


<!-- View Details -->
<style>
  #viewDetails .form-control {
    color: #000 !important;           /* input text color */
    background-color: #fff !important; /* input background */
  }

  #viewDetails .form-control::placeholder {
    color: #6c757d;                   /* optional: placeholder color */
  }
</style>
<div class="modal fade" id="viewDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="vJobDetail">
      </div>
      <div class="modal-footer" id="vJobFooter">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="offcanvas" data-bs-target="#clientChatBox" aria-controls="offcanvasRight" id="vBtn">Accept</button>
      </div>
    </div>
  </div>
</div>

<!-- Work List -->
<div class="modal fade" id="workList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-secondary">
        <h5 class="modal-title" id="exampleModalLabel">Work List</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-dark table-striped">
          <tbody id="wList">
            <!-- Dynamic rows here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer border-secondary">
        <!-- Optional footer -->
      </div>
    </div>
  </div>
</div>





<script>
function deleteJob(jid) {
  if (confirm("Did you completed this job?")) {
    fetch('deleteWork.php?jid=' + jid)
      .then(res => res.text())
      .then(data => {
        alert(data);
        loadWorkList(); // Reload the list; ensure this function exists
      })
 
  }
}
</script>

<script>
  





  
  function pbtnact() {
    let l = document.getElementById('stlist');
    if (l.selectedIndex > 0) {
      document.getElementById('prcdbtn').disabled = false;
    }
  }

  var cid2, cnm2;
  var msgwin = document.getElementById('msg');
  var ldmsgintvrl;

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
    xhttp.open("GET", "setmsg.php?cid=" + cid2 + "&sid=<?php echo $_SESSION['id']; ?>&msgText=" + msgText + "&dirtn=stc", true);
    xhttp.send();
  }

  function loadMsg(cid, cnm) {
    cid2 = cid;
    cnm2 = cnm;
    document.getElementById('offcanvasRightLabel').innerText = cnm;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("msg").innerHTML = this.responseText;
        msgwin.scrollTop = msgwin.scrollHeight;
      }
    };
    xhttp.open("GET", "getmsg.php?cid=" + cid + "&sid=<?php echo $_SESSION['id']; ?>" + "&dirtn=stc", true);
    xhttp.send();
  }

  function vDetails(cid, cnm, jid) {
    document.getElementById('vTitle').innerText = cnm;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("vJobDetail").innerHTML = this.responseText;
        document.getElementById('vBtn').setAttribute('onclick', 'loadMsg(' + cid + ',\"' + cnm + '\"); acceptWork(' + jid + ');');
      }
    };
    xhttp.open("GET", "getJobDetail.php?jid=" + jid, true);
    xhttp.send();
  }

  function vDetails2(jid, cnm) {
    document.getElementById('vTitle').innerText = cnm;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("vJobDetail").innerHTML = this.responseText;
        document.getElementById('vBtn').classList.add("visually-hidden");
      }
    };
    xhttp.open("GET", "getJobDetail.php?jid=" + jid, true);
    xhttp.send();
  }

  function acceptWork(jid) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "acceptWork.php?sid=<?php echo $_SESSION['id']; ?>&jid=" + jid, true);
    xhttp.send();
  }

  function sWorkList() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("wList").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "sWorkList.php?id=<?php echo $_SESSION['id']; ?>", true);
    xhttp.send();
  }

  setInterval(sWorkList, 2000);

  function cancelWork(jid) {
    if (confirm("Are you sure you want to cancel this work ?")) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "cancelWork.php?jid=" + jid, true);
      xhttp.send();
    }
  }
  

  function getWorkCard() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("workCard").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "getWorkCard.php?id=<?php echo $_SESSION['id']; ?>", true);
    xhttp.send();
  }

  setInterval(getWorkCard, 1000);


  function clmsgintvrl() {
    clearInterval(ldmsgintvrl);
  }

  document.querySelector('#msgval').addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
      sendMsg();
    }
  });


  function loagImg(event) {
    var image = document.getElementById('prfimg');
    image.src = URL.createObjectURL(event.target.files[0]);
  }

  document.querySelector('.cmbtn').addEventListener('click', () => {
    ldmsgintvrl = setInterval(loadMsg, 1000, cid2, cnm2);
  });

  
</script>


<?php

extract($_POST);
include_once("db_conn.php");
$sid = $_SESSION['id'];

if (isset($pbtn)) {
  $qry1 = "insert into service values($sid, '$stype')";
  $conn->query($qry1);
}

$qry2 = "select * from service where id=$sid;";

$sres = $conn->query($qry2);

if ($sres->num_rows == 0) {
  echo "<script>
        window.onload = function(){
        var myModal = new bootstrap.Modal(document.getElementById('sTypeDetail'), {});
        myModal.toggle();
        }
        




        
        </script>";
}

?>


<script>

function sendQuickText(text) {
  document.getElementById('msgval').value = text;
  sendMsg();
}
</script>



<?php include_once("footer.php") ?>

