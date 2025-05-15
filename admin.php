<?php
session_start();

if (!isset($_SESSION["utype"]) || $_SESSION["utype"] != "admin") {
    header("location:index.php");
}

include_once("header.php");
?>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <img src="./gnt_img/gntlogo.jpeg" alt="Gnt logo" width="40" height="40" class="rounded-circle shadow-sm">
      <span class="fw-bold fs-5">GNT Services</span>
    </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            <div class="d-flex">
                <div class="px-3">
                    <!-- Button trigger modal Account -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">
                        <img src="./gnt_img/person-circle.svg" alt="Account">
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Modal Account -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> My Account </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="text-center position-relative">
                    <img src="<?php echo $_SESSION['pfpic']; ?>" class="rounded-circle" height="128px" width="128px" alt="avatar">
                </div>

                <div class="h3 my-2 text-center"><?php echo $_SESSION["name"]; ?></div>

            </div>
            <div class="modal-footer justify-content-between">
                <a href="test.php" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#updateProfile">Update Profile</a>
                <div>
                    <a href="logout.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Profile -->
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <form class="modal-content" method="POST" action="updateProfile.php" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="text-center mb-3">
                    <div class="mb-3">
                        <img src="<?php echo $_SESSION['pfpic']; ?>" class="rounded-circle" id="prfimg" height="128px" width="128px" alt="avatar">
                    </div>
                    <input type="file" name="pfpic" accept="image/*" onchange="loagImg(event)">
                </div>

                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="uname" id="Name" value="<?php echo $_SESSION["name"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $_SESSION["email"]; ?>" disabled aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="inputAddress" class="form-label">Address</label>
                    <textarea rows="4" class="form-control" name="address" id="inputAddress"><?php echo $_SESSION["address"]; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" class="form-control" name="pincode" value="<?php echo $_SESSION['pincode']; ?>">
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<div class="fs-1 py-3 bold text-center bg-warning">
    Admin Panel
</div>

<!-- Manage contact us -->
<div class="container mt-5">
    <table class="table table-striped caption-top">
        <caption class="text-center fs-4 bold">List of Contact</caption>
        <thead class="table-dark">
            <th>S. no.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>#</th>
        </thead>
        <tbody id="loadContact">
 
        </tbody>
    </table>
</div>




<script>
    function loagImg(event) {
        var image = document.getElementById('prfimg');
        image.src = URL.createObjectURL(event.target.files[0]);
    }

    function loadContact(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("loadContact").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "loadContact.php", true);
        xhttp.send();
    }

    setInterval(loadContact, 1000);

    function deleteCon(conid){
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "deleteCon.php?conid="+conid, true);
        xhttp.send();
    }
</script>
<?php
include_once("footer.php");
?>