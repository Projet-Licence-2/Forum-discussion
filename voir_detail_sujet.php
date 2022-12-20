<?php
	session_start();
	if(isset($_GET['id_sujet'])){
    $id_sujet = $_GET['id_sujet'];
    require_once('connecte_BD.php');
    //Requete pour afficher 
	//<-- debut -->
	$requete1 = $conn->prepare('SELECT * FROM sujet WHERE id_sujet=?');
	$result1 = $requete1->execute(array($id_sujet));
	$result1 = $requete1->fetch();
	if($result1)
	{	
		$message = $result1['titre_sujet'];
	}
	//<-- fin -->

	

	if(isset($_POST['poster']))
	{
		
		if(empty($_POST['titre_message']) || !preg_match('/[a-zA-Z]+/', $_POST['titre_message']))
        {
            $alerte = "<div class='alert alert-danger' role='alert'>Veiller remplir le champ titre message</div>";
        }
        elseif(empty($_POST['contenu_message']) || !preg_match('/[a-zA-Z]+/', $_POST['contenu_message']))
        {
            $alerte = "<div class='alert alert-danger' role='alert'>Veiller remplir le champ contenu message</div>";
        }
		else
		{
			$titre_message = htmlspecialchars($_POST['titre_message']);
			$contenu_message = htmlspecialchars($_POST['contenu_message']);
			if(isset($_SESSION['id_utilisateur']))
			{
				//Requete pour inserer le message publier pour que quant il ajout qu'on puisse les voir directement dans la page
				//<-- debut -->
				$requete2 = $conn->prepare('INSERT INTO message_user(titre_message,texte_message,date_create,id_user,id_sujet) VALUES(?,?,NOW(),?,?)');
				$requete2->execute(array($titre_message, $contenu_message, $_SESSION['id_utilisateur'], $id_sujet));
				//<-- fin -->
				if($requete2){
				$alerte = "<div class='alert alert-success' role='alert'>reponse poster avec succes</div>";
				

				}else{
					$alerte = "<div class='alert alert-success' role='alert'>reponse poster avec succes</div>";
				}
			}else{
				header('Location:connexion.php');
			}
				
		}
	}
	
	//Requete pour afficher les message publier <-- debut -->
	//<-- debut -->
	$requete3 = $conn->prepare("SELECT * FROM message_user WHERE id_sujet=? ORDER BY id_message DESC LIMIT 25");
	$requete3->execute(array($id_sujet));
	//<-- fin -->
?>

<!DOCTYPE html>
<html>
    <head>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<title>Page d'affichage des message</title>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
			
	</head>
    <body>

		<div class="container-fluid mt-2 mb-3 h4">
			<nav style="--bs-breadcrumb-divider: ' / ';" class="text-center" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
					<li class="breadcrumb-item active" aria-current="page">Page sujet</li>
					<li class="breadcrumb-item " aria-current="page">Page message</li>
				</ol>
			</nav>
		</div>
	
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4 text-uppercase"><?php if(isset($message)){echo $message;} ?></h2>
                </div>
				<table class="table border tabale-hover">
						
						<tr class="bg-info text-center">
							<th scope="col">Utilisateur</th>
							<th scope="col">Message</th>
							<th scope="col">Date de pubilication</th>
						</tr>
						
						<?php $compteur = 0; while($result3 = $requete3->fetch()){
								
								//Requete pour avoir les informations de l'utilisateur qui a publier le sujet
								$user = $conn->prepare("SELECT * FROM utilisateur WHERE id_user =?");
								$user->execute(array($result3['id_user']));
								$resultUser = $user->fetch();
								$compteur++;
								//fin requete
						?>
						<tr class="text-center">
							<td><?= $resultUser['email'] ?></td>
							<td><b> Titre :  </b><?= $result3['titre_message'] ?><br>
							<b>Contenu :  </b><?= $result3['texte_message'] ?>
							</td>
							<td><?= $result3['date_create'] ?></td>
						</tr>
						<?php 
							}  $insertReponse = $conn->prepare("UPDATE sujet SET nbr_reponse = ? WHERE id_sujet=?");
								$resultInserte = $insertReponse->execute(array($compteur,$id_sujet));
						?>
						
				</table>


                <form method="POST">
                    <div class="mt-2">
                        <h6>Poster un message</h6>
                    </div>
                    <?php if(isset($alerte)){echo $alerte;} ?>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="titre_message" placeholder="titre du message">
                    </div>
                    <div class="mb-2">
						<textarea name="contenu_message"  class="form-control" cols="30" rows="5" placeholder="Veiller saisir le contenu de votre message ici"></textarea>
					</div>
                                        
                    <input type="submit" class="btn btn-warning float-end mb-5" name="poster" >
                </form>
            </div>
        </div>
		
    </body>
</html>
<?php } else { header('Location:connexion.php'); }
	// include('footer.php');
?>