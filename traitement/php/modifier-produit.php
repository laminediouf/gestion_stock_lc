<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_produit']))
    {
        $_SESSION['id_produit']=$_GET['id_produit'];
    }

    if(isset($_POST['designation']) AND isset($_POST['quantite'])
    AND isset($_POST['typeproduit']) AND isset($_POST['prixunitaire']))
    {
        $req=$bdd->prepare('UPDATE produit SET designation=:designation, quantite=:quantite, unite=:unite, prixUnitaire=:prixUnitaire WHERE codProd=:codProd') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'codProd'=>$_SESSION['id_produit'],
            'designation'=>$_POST['designation'],
            'quantite'=>$_POST['quantite'],
            'unite'=>$_POST['typeproduit'],
            'prixUnitaire'=>$_POST['prixunitaire']
        ));
        echo '<script>alert("Le produit a bien ete mis a jour dans la base de donnees")</script>';
    }

    $reponse=$bdd->prepare('SELECT * FROM produit WHERE codProd=:codProd') or die(print_r($bdd->errorInfo()));
    $reponse->execute(array(
        'codProd'=>$_SESSION['id_produit']
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
                margin-left: 41%;
                margin-right: 39%;
            }
            [class*="panel panel-primary"]
            {
                margin-top: 5%;
            }
        </style>
		<title>Modifier produit</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <form class="form-horizontal" action="modifier-produit.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre">Modifier produit :</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($donnees['designation']);?>" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="quantite" name="quantite" value="<?php echo htmlspecialchars($donnees['quantite']);?>" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <select name="typeproduit" id="typeproduit" class="form-control input-md">
                                <?php
                                $reponse2=$bdd->query('SELECT * FROM type_unite_produit') or die(print_r($bdd->errorInfo()));
                                while($donnees2=$reponse2->fetch())
                                {
                                ?>
                                <option value="<?php echo htmlspecialchars($donnees2['type']);?>"><?php echo htmlspecialchars($donnees2['type']);?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="prixunitaire" name="prixunitaire" value="<?php echo htmlspecialchars($donnees['prixUnitaire']);?>" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Modifier produit" class="btn btn-info btn-block">
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
