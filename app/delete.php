<?php
session_start();

// redirection 
if (!isset($_GET['id'])) {
    header('location: /projects.php');
    exit;
}




//reccupérer et supprimer projet en question
$id = $_GET['id'];
$title = $_GET['title'];
if (!empty($_POST)){
    $pdo = new \PDO('mysql:host=mysql; dbname=my_portfolio; charset=utf8mb4', 'user', 'pwd');
    $sql = "DELETE FROM project where id = :id";
    $request = $pdo->prepare($sql);
    $request->execute(['id' => $id]);
    
    $message = 'Le projet est supprimé avec succé';
    $class = 'success';
    $_SESSION['message'] = $message;
    header('location: projects.php') ;
    exit();
}
 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/delete-style.css">
    <title>Portfolio - Projets</title>

</head>

<body>
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
    
    <section class="delete-section">
        <p>Êtes-vous sûr de supprimer le projet : <?php echo $title ?> ?</p>
        <div class="choice">
            <form action="" method="post">
                <button type="submit" name="delete" class="btn-del"><a href="" class="a-del">OUI</a></button>
            </form>            
            <form action="" method="get">
                <button class="btn-del"><a href="show.php?id=<?php echo $id ?>" class="a-del">NON</a></button> 
            </form>        
        </div>


    </section>


</body>
</html>
