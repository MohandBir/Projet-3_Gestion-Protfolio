<?php
session_start();

//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index-style.css">
    <title>Portfolio</title>
</head>
<body>
    <?php 
    require 'src/shared/_header.php';
    ?>
    
    
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-subtitle">Développeur Web Junior</h1>
            <p class="hero-title">Créer des expériences digitales modernes</p>
            <p class="hero-description">
                Passionné par le développement web et les technologies, je conçois des applications :
            </p>
            <ul class="hero-skills">
                <li>🎨 élégantes</li>
                <li>🚀 performantes</li>
                <li>🔒 sécurisées</li>
            </ul>
        </div>
    </section>
</body>

</html>
