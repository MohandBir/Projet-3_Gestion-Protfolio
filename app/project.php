<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/projects.css">
    <title>Mes Projets</title>
</head>
<body>
    <header>
       <img class="photo" src="images/profil.jpg" alt="photo de profile"> 
        <h1>Mohand Bir</h1>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="projects.html">Projets</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Mes Projets</h2>
        <div class="container">
        <?php for ($i=0; $i<5; $i++) {?>
            <div class="card">
                <figure>
                    <img src="images/php.jpg" alt="logo php">
                </figure>
                <div class="subcard">
                    <h3>PHP</h3>
                    <p class="description">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati doloribus voluptatibus rem, odit architecto quo odio fugiat autem asperiores itaque.
                    </p>
                    <ul>
                        <li><a href="">Voir le projet</a></li>
                        <li><a href="">GitHub</a></li>
                    </ul>
                </div>
            </div>
        <?php }?>   
        </div>
    </main>
</body>
</html>