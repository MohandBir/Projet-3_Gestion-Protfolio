<?php
session_start();

// redirection 
if (!isset($_GET['id'])) {
    header('location: /projects.php');
    exit;
}

$pdo = new \PDO('mysql:host=mysql; dbname=my_portfolio; charset=utf8mb4', 'user', 'pwd');

//reccupérer données de projet en question
$id = (int)$_GET['id'];

$sql = "SELECT * FROM project where id = :id";
$request = $pdo->prepare($sql);
$request->execute(['id' => $id]);
$project = $request->fetch(PDO::FETCH_ASSOC);
$request->closeCursor();

$title =  $project['title'] ;   
$description =  $project['description']; 
$git =  $project['url_git']; 
$user_id = (int) $project['user_id']; 

// reccupérer la liste des utilisateurs
$sqlUser = "SELECT * FROM user";
$request = $pdo->prepare($sqlUser);
$request->execute();
$users = $request->fetchAll(PDO::FETCH_ASSOC);
$request->closeCursor();

// Modifier un  projet...
$class = '';
$error = '';
if (!empty($_POST)) {
    $title =  trim($_POST['title']) ;   
    $description = trim($_POST['description']);
    $git = trim($_POST['git']);
    $user_id = (int)$_POST['user_id'];

    $message = fieldsVerify($title, $description, $git, $user_id);

    $class ='error';
    if (!$message) {
        $sql = "UPDATE project SET title = :title, description = :description, url_git = :git, user_id = :user_id WHERE id = :id";
        $request = $pdo->prepare($sql);
        $request->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'git' => $git,
            'user_id' => $user_id,
        ]);
        $message = 'Le projet est Modifié avec succé';
        $class = 'success';
        $_SESSION['message'] = $message;
        header('location: projects.php') ;
        exit();
    }
} 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add-style.css">
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
    
    <section class="add-section">
        <h1> Modifier votre projet </h1>
        <form action="" method="post" >
            <div>
                <label for="title">Titre</label><br>
                <input type="text" name="title" value="<?php if(isset($title)){echo htmlspecialchars($title);}?>" >
            </div> 
            <div>
                <label for="description">Description</label><br>
                <textarea name="description" id="" rows="4" cols="25" ><?php if(isset($description)){echo htmlspecialchars($description);}?></textarea> 
            </div>
            <div>
                <label for="git">Lien Github</label><br>
                <input type="url" name="git" value="<?php if(isset($git)){echo htmlspecialchars($git);}?>">
            </div>
            <div>
                <label for="user_id">Utilisateur</label><br>
                <select name="user_id">
                    <option value="" >-- Veuillez choisir un utilisateur --</option>
                    <?php foreach ($users as $user) { ?>
                    <option value="<?php echo $user['id'] ?>" <?php echo (isset($user_id) && $user_id === $user['id']) ? "selected" :"" ?> >
                        <?php echo htmlspecialchars($user['name'])?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Valider" class="valider">
            </div>

        </form>
         
        <?php if(isset($message)) { ?>
            <p class="<?php echo $class ?>"><?php echo $message  ?></p>
        <?php } ?>
    </section>


</body>
</html>
<?php 

// Gestion d'erreurs...
function fieldsVerify(string $title, string $description, string $git, int $user_id){
    if (empty($title) || empty($description) || empty($git)) {
        return 'Tout les champs doivent être rempli';
    }
    
    if (strlen($title) > 100) {       
        return 'le titre ne doit pas dépasser 100 caractères';
    }
   
    if (strlen($description) > 1000) {
        return 'La description ne doit pas dépasser 1000 caractères';
    }
    
    if (!preg_match('/^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/.*)?$/', $git)) {
        return 'veuiller rentrer un URL valide';
    }

    if (strlen($git) > 255) {  
        return 'le titre ne doit pas dépasser 255 caractères';
    }
   
    if (empty($user_id)) {
        
        return 'veuiller sellectionner un auteur';
    }
   
}
 

?>
