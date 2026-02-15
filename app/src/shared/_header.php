
   <header>
        <!-- afficher le nom de utilisateur connecté -->
        <?php if (isset($_SESSION['name'])){ ?>
            <div class="connexion">    
                <span>Connexion : </span><span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span><br>
                <form action="/src/auth/deconnection.php" method="post"><button type="submit">Deconnexion</button></form>
            </div>
        <?php } ?>

        <img src="../../images/profil.jpg" alt="photo de profil" class="photo-profil">
        <div class="name">Mohand BIR</div>
        <nav>
            <ul class="nav-links">
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/src/projects.php">Projets</a></li>
                <li><a href="/src/auth/connection.php">Connexion</a> / <a href="/src/auth/register.php">Enregistrement</a></li>
            </ul>
        </nav>
    </header>