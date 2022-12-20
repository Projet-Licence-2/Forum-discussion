<?php
    session_start();
    if(isset($_GET['id_sujet'])){
        $id_sujet = $_GET['id_sujet'];
        require_once('connecte_BD.php');
        if(isset($_POST['modif']))
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
                    $requete3 = $conn->prepare("SELECT * FROM sujet WHERE id_sujet=?");
                    $requete3->execute(array($id_sujet));
                    $result3 = $requete3->fetch();
                    //Requete pour modifier le sujets
                    $requete2 = $conn->prepare("UPDATE sujet SET titre_sujet = ?, date_creation = NOW() WHERE id_sujet = ?");
                    $requete2->execute(array($titre_sujet, $id_sujet));
                    if($requete2){
                        $alerte = "<div class='alert alert-success' role='alert'>Sujet modifier avec succes <a href='index.php'>voir la modification</a></div>";
                        
                    }
                    else{ 
                        $alerte = "<div class='alert alert-danger' role='alert'>Erreur lors de la modification veiller reprendre</div>";
                    }
                    //<-- debut -->

                    
                }
                else{
                    header('Location:connexion.php');
                }
                    
            }
            
        }
    }

?>
<head>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<title>Page d'affichage des sujet</title>
		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
		
	</head>
<div class="m-auto col-md-5 col-xs-4 col-sm-4">
						<form  method="POST">
							<div class="mt-2">
								<h4 class="text-center">Modification du sujet</h4>
							</div>
							<?php if(isset($alerte)){echo $alerte;} ?>
							<div class="mb-2">
								<textarea name="titre_sujet"  class="form-control" cols="30" rows="5" placeholder="Veiller saisir le titre du sujet"></textarea>
							</div>
							<input type="submit" class="btn btn-info float-end mb-5" name="modif" value="Modifier">
						</form>
</div>