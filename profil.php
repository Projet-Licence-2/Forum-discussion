<?php
    session_start();
    if(isset($_SESSION['id_utilisateur']))
    {
        require_once('connecte_BD.php');
        $verificationIdUser = $conn->prepare("SELECT * FROM utilisateur WHERE id_user=?");
        $resultVerification = $verificationIdUser->execute(array($_SESSION['id_utilisateur']));
        $resultVerification = $verificationIdUser->fetch();
        if(!$verificationIdUser)
        {
            header('Location:connexion.php');
        } 

    } else{
        header('Location:connexion.php');
    }


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Page d'acceuil</title>
        <link rel="stylesheet" href="bootstrap/css/boustrap.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/style_index.css"> -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>


        <div class="container-fluid mt-3 h4">
			<nav style="--bs-breadcrumb-divider: ' / ';" class="text-center" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
					<li class="breadcrumb-item " aria-current="page">Page profil</li>
				</ol>
			</nav>
		</div>
        <!-- <img src="photo_user/<?= $resultVerification['photo'] ?>" alt=""> -->

        <table class="table border table-hover w-25">
        
            <tr>
                <td class="text-center">PROFIL UTILISATEUR</td>
                <td></td>
            </tr>
            <tr>
                <td>Nom</td>
                <td><?=$resultVerification['nom'] ?></td>
            </tr>
            <tr>
                <td>Prenom</td>
                <td><?=$resultVerification['prenom'] ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?=$resultVerification['email'] ?></td>
            </tr>
            <tr>
                <td>photo</td>
                <td><img src="photo_user/<?= $resultVerification['photo'] ?>" width="200"height="100" alt=""></td>
            </tr>
           
        </table>
        <a href="change_password.php" class="btn btn-info w-25">Changer le mot de passe</a>
        
        
    </body>
</html>