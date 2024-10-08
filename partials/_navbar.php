<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">BAYKUS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tools
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="nmap.php">Nmap</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">All tools</a></li>
          </ul>
        </li>
      </ul>
      <?php
      session_start();
      $username = $_SESSION['username'];
      if (!$_SESSION["loggedIn"]) {
          echo '<a href="login.php" class="btn btn-outline-success">Login</a>';
      } else {
          echo '<a style="color: white;">Welcome, ' . $username . '!&nbsp;&nbsp;&nbsp;</a><div class="flex-shrink-0 dropdown">
          <a class="d-block link-body-emphasis text-decoration-none dropdown-toggle show" role="button" data-bs-toggle="dropdown" aria-expanded="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
          </a>  
          <ul class="dropdown-menu text-small shadow" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 34px);" data-popper-placement="bottom-end">   
              <li><a href="profile.php" class="dropdown-item">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a href="functions/_logout.php" class="dropdown-item">Logout</a></li>
          </ul></div>';
      }
      ?>
    </div>
  </div>
</nav>