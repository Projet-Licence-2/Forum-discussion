<?php
	session_start();
	if(isset($_SESSION['id_utilisateur'])){
	require_once('connecte_BD.php');
	$requete = $conn->prepare('SELECT * FROM categorie ORDER BY nom');
	$result = $requete->execute();
?>	

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Page d'acceuil</title>
	<link rel="stylesheet" href="bootstrap/css/boustrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_index.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">


		<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

		<link href="css/tooplate-little-fashion.css" rel="stylesheet">
		


	<link rel="stylesheet" href="css/slick.css"/> 
	<link href="css/tooplate-little-fashion.css" rel="stylesheet">-->


	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php"><span style="color:red;">DISCUTION</span><span style="color:darkturquoise;"> FORUM</span></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link me-5 ms-5" aria-current="page" href="index.php">Acceuil</a>
					</li>
					
					<li class="nav-item dropdown me-5 ">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Categorie</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li>
								<a class="dropdown-item" href="#">
									<?php while($result = $requete->fetch()): ?>
										<a href="page_sujet.php?id_categorie=<?=$result['id_categorie']?>" class='h4 text-body text-center ms-1' style='text-decoration:none; ' >
											<?=$result['nom'].'<br>'.'<hr>' ?>
										</a>
									<?php endwhile ?>
								
								</a>
							</li>

						</ul>
					</li>

					<!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Mon compte</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li class="h4"> 
								<a class="dropdown-item  mb-3" href="publication.php">Mes publications</a>
								<a class="dropdown-item" href="message_ecrit.php">Mes messages poster</a>
							</li>

						</ul>
					</li> -->

				</ul>
				<form class="d-flex">
                  <a class="btn btn-outline-info me-2" href= "profil.php">Mon Profil</a>
                  <a class="btn btn-outline-warning me-4" href="deconnexion.php">Deconnexion</a>
                </form>
			</div>
		</div>
	</nav>
			
	<img src="assets/img/img2.jpg" class="" width="100%" height="600" alt="">
		
	<h3 class="text-center mt-4 mb-5">Bienvenu dans le forum de discussion entre toute personne passionnée par l'informatique</h3>
	<div class="container mb-5">
		<div class="row">
			<div class="col-md-6">
				<p style="font-size:20px;">Un forum de discussion est un service offert dans le réseau internet permettant à un groupe de personnes d'échanger des informations, 
					des idées sur un thème précis. Les forums servent aussi à posés 
					une question sur laquelle les moteurs de recherches et les répertoires n'ont pas fournis de reponse
				</p>
			
			</div>
				
			<div class="col-md-6 ">
				<img src="assets/img/img3.jpg" class="img-responsive" alt="">
			
			</div>
		</div>
	</div>

</body>
</html>
<?php } else { header('Location:connexion.php'); }
	include('footer.php');
?>