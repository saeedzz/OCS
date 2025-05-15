<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg py-3">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <img src="./gnt_img/gntlogo.jpeg" alt="Gnt logo" width="40" height="40" class="rounded-circle shadow-sm">
      <span class="fw-bold fs-5">GNT Services</span>
    </a>

<style>
.bg-switch-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%; /* make sure it's same as header height */
}

.bg-switch-btn {
    border: 1px solid white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    background-color: rgba(0, 255, 0, 0.1);
    transition: all 0.3s ease;
}


.bg-switch-btn:hover {
    background-color: rgb(19, 149, 25);
    color: #000;
}

</style>



    <!-- 🔽 Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- 🔽 Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Empty nav list -->
      </ul>

      <div class="d-flex flex-column flex-sm-row gap-2 mt-3 mt-sm-0">
        <!-- Chat button -->
        <div class="px-3">
          <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
              class="bi bi-chat-text" viewBox="0 0 16 16">
              <path
                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
              <path
                d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
            </svg>
          </button>
        </div>


        <!-- Profile Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">
          <img src="./gnt_img/person-circle.svg" alt="Profile Icon" width="24" height="24">
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- MODAL: Login/Profile -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginLabel">My Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="<?php echo $_SESSION['pfpic']; ?>" class="rounded-circle" height="128" width="128" alt="avatar">
        <div class="h3 my-2"><?php echo $_SESSION["name"]; ?></div>
      </div>
      <div class="modal-footer justify-content-between">
        <a class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#updateProfile">Update Profile</a>
        <a href="logout.php" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- MODAL: Update Profile -->
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="updateProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <form class="modal-content" method="POST" action="updateProfile.php" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfileLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="<?php echo $_SESSION['pfpic']; ?>" class="rounded-circle" id="prfimg" height="128" width="128" alt="avatar">
          <input type="file" name="pfpic" accept="image/*" onchange="loagImg(event)">
        </div>
        <div class="mb-3">
          <label for="Name" class="form-label">Name</label>
          <input type="text" class="form-control" name="uname" value="<?php echo $_SESSION["name"]; ?>">
        </div>
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" value="<?php echo $_SESSION["email"]; ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="inputAddress" class="form-label">Address</label>
          <textarea rows="4" class="form-control" name="address"><?php echo $_SESSION["address"]; ?></textarea>
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


<button id="bgToggleBtn" class="btn btn-outline-light bg-switch-btn">🖼️ Change Background</button>
    <script>
    const body = document.body;
    const toggleBtn = document.getElementById("bgToggleBtn");

    let isImage = true;

    toggleBtn.addEventListener("click", () => {
        if (isImage) {
            body.style.background = "#000"; // or a dark gradient
            body.style.backgroundImage = "none";
        } else {
            body.style.background = "url('index20.png') no-repeat center center fixed";
            body.style.backgroundSize = "cover";
        }
        isImage = !isImage;
    });
</script>
</body>
</html>
