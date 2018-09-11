<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_produit']))
    {
        $req=$bdd->prepare('DELETE FROM produit WHERE codProd=:codProd') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'codProd'=>$_GET['id_produit']
        ));
        echo '<script>alert("La suppresion a ete prise en compte")</script>';
    }
    $reponse=$bdd->query('SELECT * FROM produit') or die(print_r($bdd->errorInfo()));
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
            [class*="panel panel-primary"]
            {
                margin-top: 5%;
            }
        </style>
		<title>Liste produit</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des clients</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Code produit</th>
                                    <th>Designation</th>
                                    <th>Quantite</th>
                                    <th>Unite</th>
                                    <th>Prix unitaire</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['codProd']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['designation']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['quantite']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['unite']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['prixUnitaire']);?></td>
                                    <td>
                                        <a><?php echo '<a href="modifier-produit.php?id_produit='.$donnees['codProd'].'">';?><button class="btn btn-primary btn-xs">Modifier</button></a>
                                        <a><?php echo '<a href="liste-produit.php?id_produit='.$donnees['codProd'].'">';?><button class="btn btn-primary btn-xs">Supprimer</button></a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $('blockquote a').tooltip();
            });
        </script>
    </body>
</html>
