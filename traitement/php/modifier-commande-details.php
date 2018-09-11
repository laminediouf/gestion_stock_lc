<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_com']))
    {
        $_SESSION['id_com']=$_GET['id_com'];
    }

    if(isset($_POST['designation']) AND isset($_POST['quantite']))
    {
        $req=$bdd->prepare('UPDATE ligne_commande SET codProd=:designation, qteCom=:quantite, prix_total=:quantite*(SELECT prixUnitaire FROM produit WHERE codProd=:designation) WHERE id=:id_com') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            ':designation'=>$_POST['designation'],
            ':quantite'=>$_POST['quantite'],
            ':id_com'=>$_SESSION['id_com']
        ));
        echo '<script>alert("La commande a bien ete mis a jour dans la base de donnees")</script>';
    }

    $reponse=$bdd->query('SELECT designation, qteCom FROM ligne_commande lc, produit p WHERE lc.codProd=p.codProd AND id='.$_SESSION['id_com'].'') or die(print_r($bdd->errorInfo()));
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
		<title>Modifier details commande</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <form class="form-horizontal" action="modifier-commande-details.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre">Modifier commande :</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <select name="designation" id="designation" class="form-control input-md">
                                <?php
                                $reponse1=$bdd->query('SELECT * FROM produit') or die(print_r($bdd->errorInfo()));
                                while($donnees1=$reponse1->fetch())
                                {
                                ?>
                                <option value="<?php echo htmlspecialchars($donnees1['codProd']);?>"><?php echo htmlspecialchars($donnees1['designation']);?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="quantite" name="quantite" value="<?php echo htmlspecialchars($donnees['qteCom']);?>" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Modifier commande" class="btn btn-info btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <script src="../js/validate_form_commande_details.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $('blockquote a').tooltip();
            });
        </script>
    </body>
</html>
