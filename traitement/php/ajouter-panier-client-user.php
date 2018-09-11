<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_POST['prenom']) AND isset($_POST['nom']) AND isset($_POST['adresse'])
    AND isset($_POST['email']) AND isset($_POST['telephone']))
    {
        $req=$bdd->prepare('INSERT INTO client(nom,prenom,adresse,telephone,email) VALUES(:nom,:prenom,:adresse,:telephone,:email)') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'nom'=>$_POST['nom'],
            'prenom'=>$_POST['prenom'],
            'adresse'=>$_POST['adresse'],
            'telephone'=>$_POST['telephone'],
            'email'=>$_POST['email']
        ));
        $reponse=$bdd->query('SELECT codCli FROM client WHERE codCli=(SELECT MAX(codCli) FROM client)') or die(print_r($bdd->errorInfo()));
        $_SESSION['id_client']=htmlspecialchars($donnees['codCli']);
        echo '<script>alert("Le client a bien ete ajoute dans la base de donnees")</script>';
        header('Location:achat.php');
    }
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
                margin-left: 107px;
            }
            [class*="titre"]
            {
                margin-left: 39%;
                margin-right: 35%;
            }
            [class*="titre2"]
            {
                margin-left: 40%;
                margin-right: 35%;
            }
            [class="btn btn-primary"]
            {
                margin-left: 37%;
                margin-right: 40%;
            }
        </style>
		<title>Ajout panier</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu-user.php"); ?>
            <form class="form-horizontal" action="achat-user.php" method="post">
                <fieldset>
                    <h2 class="titre">Selectionner client</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <select name="client" id="client" class="form-control input-md">
                                <?php
                                $reponse4=$bdd->query('SELECT * FROM client') or die(print_r($bdd->errorInfo()));
                                while($donnees4=$reponse4->fetch())
                                {
                                ?>
                                <option value="<?php echo htmlspecialchars($donnees4['codCli']);?>"><?php echo htmlspecialchars($donnees4['prenom']).' '.htmlspecialchars($donnees4['nom']);?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Valider" class="btn btn-info btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form class="form-horizontal" action="ajouter-panier-client-user.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre2">Ou ajouter client</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="prenom" name="prenom" placeholder="Prenom" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="adresse" name="adresse" placeholder="Adresse" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="telephone" name="telephone" placeholder="Telephone" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Ajouter client" class="btn btn-info btn-block">
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
