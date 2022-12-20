<?php 
session_start();
if(isset($_SESSION['id_utilisateur']))
{
    if(isset($_POST['modifier']))
    {
        if(empty($_POST['pass1']) || $_POST['pass1'] != $_POST['pass2'])
        {
            $alerte = "<div class='text-danger mt-3'>Mot de pass incorrect</div>";
        }
        else
        {
            require_once('connecte_BD.php');
            $mdp = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
            $moficationMotDePasee = $conn->prepare('UPDATE utilisateur SET mdp_user=? WHERE id_user=?');
            $resulataModification = $moficationMotDePasee->execute(array($mdp, $_SESSION['id_utilisateur']));
            if($resulataModification){
                $alerte = '<div class="text-success mt-3">Votre mot de passe à été mise à jour </div>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Change password</title>
        <link rel="stylesheet" href="bootstrap/css/boustrap.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/style_index.css"> -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid mt-2 mb-3 h4">
            <nav style="--bs-breadcrumb-divider: ' / ';" class="text-center" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Page profil</li>
                    <li class="breadcrumb-item " aria-current="page">Page change password</li>
                </ol>
            </nav>
        </div>
        <div class="container mt-5 w-50 bg-info p-5">
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="pass1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirmer mot de passe</label>
                    <input type="password" name="pass2" class="form-control" id="exampleInputPassword1">
                </div>
                
                <input type="submit" name="modifier" class="btn btn-primary" value="Modifier">
            </form>
            <?php if(isset($alerte)){echo $alerte;} ?>
        </div>
        
    </body>    
</html>