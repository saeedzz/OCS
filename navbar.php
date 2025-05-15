<style>
  .navbar {
    background: linear-gradient(135deg, #1a1a1a, #333); /* Dark gradient */
    padding: 10px 15px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    z-index: 1050; /* ensure it stays above other content */
  }

  .navbar-brand img {
    border-radius: 50%;
    transition: transform 0.3s ease-in-out;
  }

  .navbar-brand img:hover {
    transform: scale(1.1);
  }

  .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    transition: color 0.3s, transform 0.3s;
    padding: 8px 12px;
  }

  .navbar-nav .nav-link:hover {
    color: #fff;
    transform: scale(1.1);
  }

  .navbar-nav .active {
    color: #fff !important;
    border-bottom: 2px solid #f8b400; /* Highlight active link */
  }

  .navbar-toggler {
    border-color: rgba(255, 255, 255, 0.5);
  }

  .navbar-toggler:focus {
    box-shadow: none;
  }

  @media (max-width: 576px) {
    .navbar-nav {
      text-align: center;
    }

    .navbar-nav .nav-link {
      padding: 10px;
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="./gnt_img/gntlogo.jpeg" alt="GNT Logo" width="40" height="40">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['SCRIPT_NAME'])=='index.php') echo 'active'; ?>" href="index.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['SCRIPT_NAME'])=='register.php') echo 'active'; ?>" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
