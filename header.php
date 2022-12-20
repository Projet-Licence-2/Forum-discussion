<?php
	// session_start();

?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<link rel="stylesheet" href="style_inscription.css" >

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" href="personal-style.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/min.css">
		
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
		

		
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
                            <a class="nav-link me-5 ms-5" aria-current="page" href="#">Acceuil</a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorie</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <?php while($result = $requete->fetch()): ?>
                                            <a href="page_sujet.php?id_categorie=<?=$result['id_categorie']?>" class='h4 text-body' style='text-decoration:none; padding:20px;' ><?=$result['nom'].'<br>'.'<hr>' ?>
                                            </a>
                                        <?php endwhile ?>
                                    
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item ms-5">
                            <a class="nav-link me-5 ms-5" aria-current="page" href="#">Mon compte</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                    <a class="btn btn-outline-info me-2" href= "#">Profil</a>
                    <a class="btn btn-outline-warning me-4" href="deconnexion.php">Deconnexion</a>
                    </form>
                </div>
            </div>
        </nav>
    </body>
</html>