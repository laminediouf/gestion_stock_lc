<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_fournisseur']))
    {
        $_SESSION['codeFournisseur']=$_GET['id_fournisseur'];
    }

    if(isset($_POST['prenom']) OR isset($_POST['nom']) OR isset($_POST['adresse'])
    OR isset($_POST['email']) OR isset($_POST['telephone']))
    {
        $req=$bdd->prepare('UPDATE client SET nom=:nom,prenom=:prenom,adresse=:adresse,telephone=:telephone,email=:email WHERE codFour=:codFour') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'codFour'=>$_SESSION['codeFournisseur'],
            'nom'=>$_POST['nom'],
            'prenom'=>$_POST['prenom'],
            'adresse'=>$_POST['adresse'],
            'telephone'=>$_POST['telephone'],
            'email'=>$_POST['email']
        ));
        echo '<script>alert("La modification a ete prise en compte")</script>';
    }

    $reponse=$bdd->prepare('SELECT * FROM fournisseur WHERE codFour=:codFour') or die(print_r($bdd->errorInfo()));
    $reponse->execute(array(
        'codFour'=>$_SESSION['codeFournisseur']
    ));
    $donnees=$reponse->fetch();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body
            {
                background-color: #DDD;
                padding-top: 10px;
            }
            [class*="col-"]
            {
                margin-bottom: 20px;
            }
            img
            {
                width: 100%;
            }
            .well
            {
                background-color: #CCC;
                padding: 20px;
            }
            a:active, a:focus
            {
                outline: none;
            }
            [class*="nav navbar-nav"]
            {
                margin-left: 35px;
            }
            [class*="titre"]
            {
                margin-left: 38%;
                margin-right: 35%;
            }
            [class*="panel panel-primary"]
            {
                margin-top: 5%;
            }
        </style>
		<title>Modifier fournisseur</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <form class="form-horizontal" action="modifier-client.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre">Modifier fournisseur :</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="id_client" name="id_client" placeholder="id" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['codFour']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="prenom" name="prenom" placeholder="Prenom" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['prenom']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['nom']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="adresse" name="adresse" placeholder="Adresse" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['adresse']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="telephone" name="telephone" placeholder="Telephone" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['telephone']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['email']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Modifier fournisseur" class="btn btn-info btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <script src="../js/validate_form_client.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $('blockquote a').tooltip();
            });
        </script>
    </body>
</html>
