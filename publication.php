<?php 
session_start();
if(isset($_GET['id_categorie'])){
    $id_categorie = $_GET['id_categorie'];
    require_once('connecte_BD.php');
    if(isset($_SESSION['id_utilisateur']))
    {
        $requete1 = $conn->prepare('SELECT * FROM sujet WHERE id_user=?');
        $result1 = $requete1->execute(array($_SESSION['id_utilisateur']));
       
        
    }
    else{
        header("Location:connexion.php");
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
                    <table class="table border table-responsive tabale-hover ">
						
						<tr class="bg-info text-center">
							<th scope="col">Sujet</th>
							<th scope="col">categorie</th>
                            <th scope="col">Date de pubilication</th>
							
						</tr>
						
						<?php while( $result1 = $requete1->fetch()){
							$user = $conn->prepare("SELECT * FROM utilisateur WHERE id_user =?");
                            $user->execute(array($result1['id_user']));
                            $resultUser = $user->fetch();

                            $requete2 = $conn->prepare('SELECT * FROM categorie WHERE id_categorie=?');
                            $result2 = $requete2->execute(array($id_categorie));
						?>
						<tr class="text-center">
							<td><b></b><?= $result1['titre_sujet'] ?><br>
							</td>
							<td><?= $result1['date_creation'] ?></td>
						</tr>
						<?php } ?>
						
					</table>

    </body>
</html>

<?php } else{ header('Location:connexion.php');}