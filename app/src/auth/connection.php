<?php
session_start();

$message ='';

if (isset($_GET['register']) && $_GET['register'] === '1') {
    $message = 'Votre enregsitrement a été réalisé avec succès !<br> Vous pouvez maintenant vous connecter.';
}

// si le formulaire a été soumis --> On stocker les données du formulaire dans des variables PHP
if(!empty($_POST)) {
    $name = $_POST['name'];
    $pwd = $_POST['pwd'];

    // On récupère de la BDD le password du pseudo saisi par l'utilisateur
    $pdo = new \PDO(
        'mysql:host=mysql;dbname=my_portfolio;charset=utf8mb4',
        'user',
        'pwd'
    );
    $sql="SELECT * FROM user WHERE name=:name";
    $request = $pdo->prepare($sql);
    $request->execute([
        'name' => $name
    ]);
    $user = $request->fetch(PDO::FETCH_ASSOC);
    
    // si les mot de passe concordent [fonnction php password_verify($pwdSaisi, $pwdFromBdd)]
    if ($user && password_verify($pwd, $user['pwd'])) {
        // on enregistre en session $_SESSION['pseudo'] = $pseudo
        $_SESSION['name'] = $name;
        header('Location: /index.php');
        exit;
    } else {
        // Sinon on affiche un message d'erreur
        $message = 'Les identifiants sont incorrects !';
    }    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="post">
        Pseudo <input type="text" name="name" required> <br>
        Mot de passe <input type="password" name="pwd" rquired><br>
        <input type="submit" value="Connexion">
        <?php echo $message ?>
    </form>
    <p><a href="/">Retour à l'accueil</a></p>
</body>
</html>