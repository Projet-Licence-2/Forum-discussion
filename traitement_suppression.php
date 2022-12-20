<?php
    session_start();
    if(isset($_GET['id_sujet']))
    {
        $id_sujet = $_GET['id_sujet'];
        require_once('connecte_BD.php');
        $requet2 = $conn->prepare("SELECT * FROM sujet WHERE id_sujet=?");
        $result = $requet2->execute(array($id_sujet));
        $result = $requet2->fetch();
        if($result['id_user'] == $_SESSION['id_utilisateur'])
        {
            $requet = $conn->prepare("DELETE FROM sujet WHERE id_sujet=?");
            $requet->execute(array($id_sujet));
            if($requet)
            {
                echo "<div class='alert alert-danger' role='alert'>Supprimer avec success <a href='index.php'>Appuyer ici pour etre rediriger dans la page d'acceuil</a></div>";
            }
        
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'>Impossible de supprimer un sujet dont vous n'etes pas auteur</div>";
        }
        
        
        
    }
    else
    {
        header('Location:connexion.php'); 
    }



?>

<head>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<title>Page d'affichage des sujet</title>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
		
</head>