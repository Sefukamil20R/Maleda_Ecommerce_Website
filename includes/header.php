<?php
session_start();
?>
<header>
      <nav class="main-nav">
        <a href="" class="logo">MALEDA</a>
        <ul class="middle-nav">
          <li><a class="main-nav-link" href="index.html">Home</a></li>
          <li><a class="main-nav-link" href="AboutUs.html">About</a></li>
          <li><a class="main-nav-link" href="Portfolio.html">portfolio</a></li>
          <li><a class="main-nav-link" href="shop.html">Products</a></li>
          <li><a class="main-nav-link" href="Contactus.html">Contact</a></li>
        </ul>
        <div class="double-buttons">
        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                echo '<p>Welcome, ' . $_SESSION["email"] . '</p>';
                echo '<a href="logout.php" class="logout">Logout</a>';
            } else {
                echo '<button class="create">Create</button>';
                echo '<button class="login">Login</button>';
            }
            ?>
          <i class="nav-dropdown-btn bi bi-list"></i>
        </div>
      </nav>
      <ul class="dropdown-menu">
        <li><a class="main-nav-link" href="index.html">Home</a></li>
        <li><a class="main-nav-link" href="AboutUs.html">About</a></li>
        <li><a class="main-nav-link" href="Portfolio.html">portfolio</a></li>
        <li><a class="main-nav-link" href="shop.html">Products</a></li>
        <li><a class="main-nav-link" href="Contactus.html">Contact</a></li>
        <li>
          <div class="double-buttons">
            <button class="create">Create</button>
          </div>
        </li>
      </ul>
    </header>