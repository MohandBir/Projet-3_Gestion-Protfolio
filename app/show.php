<?php

use DateTimeImmutable;
// redirection 
if (!isset($_GET['id'])){
   // header('location: projects.php');
    //exit;
}

if (!empty($_GET['id'])) {
    
    $id = $_GET['id'];

    $pdo = new \PDO(
    'mysql:host=mysql;dbname=my_portfolio;charset=utf8mb4',
    'user',
    'pwd'
    );

    $sql = "SELECT p.*, u.name FROM project p INNER JOIN user u ON u.id = user_id WHERE p.id = :id";
    $request=$pdo->prepare($sql);
    $request->execute([ 'id' => $id ]);
    $project = $request->fetch(PDO::FETCH_ASSOC);
    $id = $project['id'];
    $title = $project['title'];
    $description = $project['description'];
    $git = $project['url_git'];
    $auteur = $project['name'];
    // format de date
    $date = new DateTimeImmutable($project['creation_date']);
    $date = $date->format('d-m-Y');
    
} 

?>

<!DOCTYPE html> 
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show-style.css">
    <title>Portfolio - Projets</title>

</head>

<body>
    <header>
        <img src="images/profil.jpg" alt="photo de profil" class="photo-profil">
        <div class="name">Camile Ghastine</div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projects.php">Projets</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="projects-section">

        <h2 class="section-title">Mes Projets</h2>    

        <div class="project-card">
            <div class="project-content">
                <h2 class="project-title"><?php echo htmlspecialchars($title) ?></h2>                     
                <p class="project-description">
                   <?php echo htmlspecialchars($description) ?>
                <div class="project-links">
                    <a href="<?php echo htmlspecialchars($git) ?>" class="project-link secondary">GitHub</a>                   
                    <div class="delete"><a href="delete.php?<?php echo "id=$id&title=$title" ?>">❌</a></div>
                    <div class="update"><a href="update.php?<?php echo "id=$id" ?>">✏️</a></div>
                </div>
                <div class="infos">
                    <div><?php echo ($date) ?></div>
                    <div><?php echo htmlspecialchars(ucfirst($auteur)) ?></div>
                </div>
            </div>
        </div>    

    </section>


</body>

</html>