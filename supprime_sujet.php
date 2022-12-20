<?php 
    session_start();
    if(isset($_GET['id_sujet']))
    {
        $id_sujet = $_GET['id_sujet'];
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
<body>
    <div class="mt-5" align="center">
        <a href="traitement_suppression.php?id_sujet=<?=$id_sujet?>" class="btn btn-danger">OUI</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="index.php" class="btn btn-info">NON</a>
    </div>    

</body>