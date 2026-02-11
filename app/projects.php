<?php 
session_start();

session_destroy();
$_SESSION['test']='test';
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/projects-style.css">
    <title>Portfolio - Projets</title>

</head>

<body>
    <?php if(isset($_SESSION['message'])) { ?>
        <p class="success"><?php echo $_SESSION['message']  ?></p>
    <?php } ?>
    <header>
        <img src="images/profil.jpg" alt="photo de profil" class="photo-profil">
        <div class="name">Mohand BIR</div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projects.php">Projets</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="projects-section">
        <h1 class="section-title">Mes Projets</h2>

        <div class="add-project">
            <p><a href="add.php">➕</a></p>
        </div>

        <div class="projects-list">


            <?php
            $pdo = new \PDO(
                'mysql:host=mysql;dbname=my_portfolio;charset=utf8mb4',
                'user',
                'pwd'
            );

            $sql = "SELECT * FROM project ";
            $request=$pdo->prepare($sql);
            $request->execute();
            $projects = $request->fetchAll(PDO::FETCH_ASSOC);
            


            ?>

            <?php  foreach ($projects as $project) { 
                $discription = $project['description'];
                ?>
            <div class="project-card">
                <div class="project-content">
                    <h2><a href="show.php?id=<?php echo $project['id'] ?>" class="project-title"><?php echo htmlspecialchars($project['title']) ?></a></h2>
                    <p class="project-description">
                        <?php echo htmlspecialchars(substr($discription,0, 200).'...')  ?>
                    </p>
                </div>
            </div>    
            <?php } ?>

            
        </div>
        
    </section>


</body>

</html>