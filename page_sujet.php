<?php 
	session_start();
	if(isset($_GET['id_categorie'])){
	$id_categorie = $_GET['id_categorie'];
	require_once('connecte_BD.php');
	
	//Requete pour afficher la description de la categorie publier
	//<-- debut -->
	$requete1 = $conn->prepare('SELECT * FROM categorie WHERE id_categorie=?');
	$result1 = $requete1->execute(array($id_categorie));
	$result1 = $requete1->fetch();
	if($result1)
	{	
		$message = $result1['descript'];
	}
	//<-- fin -->

	if(isset($_POST['publier'],$_POST['titre_sujet']))
	{
		$titre_sujet = htmlspecialchars($_POST['titre_sujet']);
		if(empty($_POST['titre_sujet']) || !preg_match('/[a-zA-Z]+/', $_POST['titre_sujet']))
        {
            $alerte = "<div class='alert alert-danger' role='alert'>Veiller remplir le champ</div>";
		}
		else
		{
			if(isset($_SESSION['id_utilisateur']))
			{
				//Requete pour inserer le sujets publier pour que quant il ajout qu'on puisse les voir directement
				$requete2 = $conn->prepare('INSERT INTO sujet(titre_sujet,date_creation,id_user,id_categorie,nbr_reponse) VALUES(?,NOW(),?,?,?)');
				$requete2->execute(array($titre_sujet, $_SESSION['id_utilisateur'], $id_categorie, NULL));
				$alerte = "<div class='alert alert-success' role='alert'>Sujet ajouter avec succes</div>";
				//<-- debut -->
				
			}
			else{
				header('Location:connexion.php');
			}
				
		}
		
	}
	//Requete pour afficher les sujets publier <-- debut -->
	//<-- debut -->
	$requete3 = $conn->prepare("SELECT * FROM sujet WHERE id_categorie=? ORDER BY id_sujet DESC");
	$requete3->execute(array($id_categorie));

	// if($requete3==false){
	// 	$rien = "Aucun contenu pour le moment ";
	// }
	//<-- fin -->
	
	

?>
<!DOCTYPE html>
<html>
    <head>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<title>Page d'affichage des sujet</title>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
		
	</head>
    <body>
	
		
		<div class="container-fluid mt-3 h4">
			<nav style="--bs-breadcrumb-divider: ' / ';" class="text-center" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
					<li class="breadcrumb-item" aria-current="page">Page Sujet</li>
				</ol>
			</nav>
		</div>
		



		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 mt-4">
					<h3 class="text-center mb-4 text-uppercase "><?php if(isset($message)){echo $message;} ?></h3>

					
					<?php  while($result3 = $requete3->fetch()){
						
						$user = $conn->prepare("SELECT * FROM utilisateur WHERE id_user =?");
						$user->execute(array($result3['id_user']));
						$resultUser = $user->fetch();
						
					?>
					<div class="container bg-info w-100 p-3 mb-4">
						<div class="row">
							<div class="col-md-4">
								
								<h6><?= $resultUser['email'] ?></h6>
								
								<a href="voir_detail_sujet.php?id_sujet=<?=$result3['id_sujet']?>"><p><?= $result3['titre_sujet'] ?></p></a>
								
							</div>
							<div class="col-md-2">
								<a href="modif_sujet.php?id_sujet=<?=$result3['id_sujet']?>" class="btn btn-warning">Modifier</a>
								
							</div>	
							<div class="col-md-2">
								<a href="supprime_sujet.php?id_sujet=<?=$result3['id_sujet']?>" class="btn btn-danger">Suprimer</a>
							</div>	
							
							<div class="col-md-4">
								<b> Publier le </b>
								<span><?= $result3['date_creation'] ?><br></span>
								<span > <b>Repondu : </b> <?php if($result3['nbr_reponse']==NULL){ echo "Aucune reponse pour le moment"; }else{ echo $result3['nbr_reponse']; } ?> </span>
							</div>
							
						</div>
						
					</div>
					<?php } ?>
					
					<div class="m-auto col-md-5 col-xs-4 col-sm-4">
						<form  method="POST">
							<div class="mt-2">
								<h4 class="text-center">Créer un nouveau sujet de discution</h4>
							</div>
							<?php if(isset($alerte)){echo $alerte;} ?>
							<div class="mb-2">
								<textarea name="titre_sujet"  class="form-control" cols="30" rows="5" placeholder="Veiller saisir le titre du sujet (appeller aussi titre d'une discussion)"></textarea>
							</div>
							<input type="submit" class="btn btn-info float-end mb-5" name="publier" value="Publier">
						</form>
					</div>
				</div>
					
			
				<!-- <div class="col-md-5 ">
					<img src="assets/img/img4.jpg" class="" width="100%" height="700" alt="" >
				</div> -->
				
			</div>


		</div>


		<!-- <form method="POST">
			<div class="col-md-3">
				<input type="text" class="form-control mb-2" name="contenu_message" placeholder="Saisir votre message ici">
				<input type="submit" class="btn btn-info float-end " value="Envoyer" name="envoyer">
			</div>
						
		</form> -->	
		<div class="container bg-info w-100">
			
			
		</div>

    </body>
</html>
<?php } else { header('Location:connexion.php'); }
	// include('footer.php');
?>