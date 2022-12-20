<?php 
session_start();
if(isset($_POST['connexion']))
{
	if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $alerte = "<div class='alert alert-danger' role='alert'>Veiller saisir un email valide</div>";
    }
    elseif(empty($_POST['mdp_utilisateur']))
    {
        $alerte = "<div class='alert alert-danger' role='alert'>Veiller remplir le champ mot de passe</div>";
	}
	else
	{
		$email = htmlspecialchars($_POST['email']);
		$mdp_utilisateur = $_POST['mdp_utilisateur'];

		require_once('connecte_BD.php');
		$requete = $conn->prepare('SELECT * FROM utilisateur WHERE email=?');
		$result = $requete->execute(array($email));
		$result = $requete->fetch();

		if(!$result){
			$alerte = "<div class='alert alert-danger' role='alert'>Cet adresse email n'existe pas veiller bien le verifier</div>";
		}
		else 
		{
			$mdp_utilisateurOk = password_verify($mdp_utilisateur, $result['mdp_user']);
			if($mdp_utilisateurOk)
			{
				
				$_SESSION['id_utilisateur'] = $result['id_user'];
				$_SESSION['nom'] = $result['nom'];
				$_SESSION['email'] = $result['email'];
				

				if(isset($_POST['seSouvenir']))
              	{
					setcookie("email", $email);
					setcookie("motDePasse", $mdp_utilisateur);
              	}
              	else
              	{
					if(isset($_COOKIE['email']))
					{
					setcookie($_COOKIE['email'], "");
					}
					if(isset($_COOKIE['mdp_utilisateur']))
					{
					setcookie($_COOKIE['mdp_utilisateur'], "");
					}
              	}
				header('Location:index.php');
			}
			else
			{
				$alerte = "<div class='alert alert-danger' role='alert'>Le mot de passe saisi est incorrect</div>";
			}
		}
	}
	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style_connexion.css">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<title>Page de connexion</title>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
	</head>
	<body>
		
		<div class="container bg-secondary mt-5" id="global" style="color:#FFF;">
			<div class="container">
				<h3 class="text-uppercase text-center h1">Connexion</h3>
			</div>
			<?php if(isset($alerte)) echo $alerte; ?>
			<form method="POST">
				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Adresse Email</label>
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value=<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>>
					
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Mot de passe</label>
					<input type="password" name="mdp_utilisateur" class="form-control" id="exampleInputPassword1" value=<?php if(isset($_COOKIE['motDePasse'])) echo $_COOKIE['motDePasse']; ?>>
				</div>
				<input type="submit" name="connexion" class="btn btn-primary mb-2" value="Se connecter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="form-check-input" type="checkbox" name="seSouvenir" id="flexCheckDefault">
              	<label class="form-check-label" for="flexCheckDefault">Se souvenir de moi</label>
				<br>
				<small class="">Si vous n'avez pas de compte
				<a href="inscription.php" class="link link-hover" style="color:#E78;">Inscrivez vous ici</a></small>	
			</form>

		</div>
		
</body>
</html>