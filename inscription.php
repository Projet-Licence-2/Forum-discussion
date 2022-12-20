<?php 

   
       if(isset($_POST['valider']))
        {
            if(empty($_POST['prenom']) || !preg_match('/[a-zA-Z]+/', $_POST['prenom']))
            {
                $alerte = "<div class='alert alert-danger' role='alert'>Veiller saisir le prenom</div>";
            }
            elseif(empty($_POST['nom']) || !preg_match('/[a-zA-Z]+/', $_POST['nom']))
            {
                $alerte = "<div class='alert alert-danger' role='alert'>Veiller saisir le nom</div>";
            }
            elseif(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $alerte = "<div class='alert alert-danger' role='alert'>Veiller saisir un email valide</div>";
            }
            elseif($_POST['mdp_utilisateur'] != $_POST['mdp_utilisateur2'])
            {
                $alerte = "<div class='alert alert-danger' role='alert'>Mot de passe incorrect</div>";
            }
            else
            {
				require_once('connecte_BD.php');
				$photo = $_FILES['photo']['name'];
				$nomtemporairePhoto = $_FILES['photo']['tmp_name'];
				move_uploaded_file($nomtemporairePhoto,"photo_user/$photo");
				

				$nom = htmlspecialchars($_POST['nom']);
				$prenom = htmlspecialchars($_POST['prenom']);
				$email = htmlspecialchars($_POST['email']);
				$mdp_utilisateur = password_hash($_POST['mdp_utilisateur'], PASSWORD_DEFAULT);
				// $photo =htmlspecialchars($_POST['photo']);
            	
            	$requete = $conn->prepare("INSERT INTO utilisateur(prenom, nom, email, mdp_user, photo) VALUES('$prenom','$nom','$email','$mdp_utilisateur','$photo')");
				$result = $requete->execute();
				if($result)
				{
					$alerte = "<div class='alert alert-success' role='alert'>Vous êtes desormais inscrit</div>";
				}
              
			}
        }


?>
		
<!DOCTYPE html>
<html>
	<head>
		
		<link rel="stylesheet" href="css/style_inscription.css" >
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<title>Page d'inscription</title>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
		

		
	</head>

	<body>		

	<div class="container form shadow mt-5" id="global">
		<div class="container">
			<h3 class="text-uppercase text-center h1">inscription</h3>
		</div>
		<?php if(isset($alerte)) echo $alerte; ?>
		<form method="POST" enctype="multipart/form-data">
			<div class="">
				<label for="exampleInputEmail1" class="form-label">Prenom</label>
				<input type="text" class="form-control" name="prenom" id="exampleInputEmail1" aria-describedby="emailHelp">
					
			</div>
			<div class="">
				<label for="exampleInputEmail1"  class="form-label">Nom</label>
				<input type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				
			</div>
			<div class="">
				<label for="exampleInputEmail1"  class="form-label">Email</label>
				<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					
			</div>
			<div class="">
				<label for="exampleInputEmail1" class="form-label">Mot de passe</label>
				<input type="password" class="form-control" name="mdp_utilisateur" id="exampleInputEmail1" aria-describedby="emailHelp">
						
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Confirmation Mot de Passe</label>
				<input type="password" class="form-control" name="mdp_utilisateur2" id="exampleInputPassword1">
			</div>
			<div class="mb-3">
				<input class="form-control form-control-sm" id="formFileSm" type="file" name="photo">
			</div>
			<input type="submit" name="valider" class="btn btn-primary mb-2" value="S'inscrire"><br>
			<small class="text-muted cotext">Si vous avez un compte
			<a href="connexion.php">Connectez vous</a></small>
		</form>

	</div>
			
	</body>
</html>

		  


			