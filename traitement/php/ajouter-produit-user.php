<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_POST['designation']) AND isset($_POST['quantite'])
    AND isset($_POST['typeproduit']) AND isset($_POST['prixunitaire']))
    {
        $req=$bdd->prepare('INSERT INTO produit(designation, quantite, unite, prixUnitaire) VALUES(:designation, :quantite, :unite, :prixUnitaire)') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'designation'=>$_POST['designation'],
            'quantite'=>$_POST['quantite'],
            'unite'=>$_POST['typeproduit'],
            'prixUnitaire'=>$_POST['prixunitaire']
        ));
        echo '<script>alert("Le produit a bien ete ajoute dans la base de donnees")</script>';
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
                margin-left: 43%;
                margin-right: 40%;
            }
        </style>
		<title>Ajout produit</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu-user.php"); ?>
            <form class="form-horizontal" action="ajouter-produit.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre">Ajout produit :</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="designation" name="designation" placeholder="Designation" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="quantite" name="quantite" placeholder="Quantite" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <select name="typeproduit" id="typeproduit" class="form-control input-md">
                                <?php
                                $reponse=$bdd->query('SELECT * FROM type_unite_produit') or die(print_r($bdd->errorInfo()));
                                while($donnees=$reponse->fetch())
                                {
                                ?>
                                <option value="<?php echo htmlspecialchars($donnees['type']);?>"><?php echo htmlspecialchars($donnees['type']);?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="prixunitaire" name="prixunitaire" placeholder="Prix unitaire" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Ajouter produit" class="btn btn-info btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <script src="../js/validate_form_produit.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $('blockquote a').tooltip();
            });
        </script>

    </body>
</html>
