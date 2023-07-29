
<nav class="navbar" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">ReserVeo</a>
        <form class="d-flex">
            <input type="search" class="form-control me-2" placeholder="Recherche ..." aria-label="Search">
            <button type="submit" class="btn btn-outline-primary">Recherche</button>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                    if (isset($_SESSION['name'])) {
                        echo('<a href="Authentification/logout.php" class="nav-link"> ' . $_SESSION["name"] . ' Se deconnecter</a>');
                    } else{
                        echo('<a href="Authentification/loginForm.php" class="nav-link">Se connecter</a>');
                    }
                ?>
            </li>
        </ul>
    </div>
</nav>