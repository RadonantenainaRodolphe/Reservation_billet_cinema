
<nav class="navbar fixed-top" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a href="/Reservation/index.php" class="navbar-brand">ReserVeo</a>
        
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                    if (isset($_SESSION['name'])) {
                        echo('<a href="/Reservation/Authentification/logout.php" class="nav-link"> ' . $_SESSION["name"] . ' Se deconnecter</a>');
                    } else{
                        echo('<a href="/Reservation/Authentification/loginForm.php" class="nav-link">Se connecter</a>');
                    }
                ?>
            </li>
        </ul>
    </div>
</nav>