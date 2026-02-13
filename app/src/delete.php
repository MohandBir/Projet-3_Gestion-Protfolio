<?php
session_start();


 
if (!isset($_GET['id'])) {
    header('location: projects.php');
    exit;
}




//reccupérer et supprimer projet en question

$id =  $_GET['id'];
$title = isset($_GET['title']) ? str_replace('_', ' ', $_GET['title']) : '';
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
    <link rel="stylesheet" href="../css/delete-style.css">
    <title>Portfolio - Projets</title>

</head>

<body>

    <?php 
    require 'shared/_header.php';
    ?>

    <section class="delete-section">
        <p>Êtes-vous sûr de supprimer le projet : <?php echo $title ?> ?</p>
        <div class="choice">
            <form action="" method="post">
                <button type="submit" name="delete" class="btn-del" >OUI</button>
            </form>            
            
           <a href="show.php?id=<?php echo $id?>" class="a-del"> <button class="btn-del">NON</button> </a>
             
        </div>


    </section>


</body>
</html>
