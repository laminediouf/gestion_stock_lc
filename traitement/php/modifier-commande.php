<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_com']))
    {
        $req=$bdd->prepare('DELETE FROM ligne_commande WHERE id=:id') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            ':id'=>$_GET['id_com']
        ));
        echo '<script>alert("La suppresion a ete prise en compte")</script>';
    }
    if(isset($_GET['id_commande']))
    {
        $_SESSION['id_commande']=$_GET['id_commande'];
    }
    $reponse=$bdd->query('SELECT id, codCom, designation, qteCom, prix_total FROM ligne_commande lc, produit p WHERE lc.codProd=p.codProd AND codCom='.$_SESSION['id_commande'].'') or die(print_r($bdd->errorInfo()));
    //Ceci verifie si il y a des commandes
    $verification=false;
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
            [class*="message"]
            {
                margin-left: 41%;
                margin-right: 35%;
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
		<title>Modifier commande</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des commandes (details)</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code commande</th>
                                    <th>Designation</th>
                                    <th>Quantite commande</th>
                                    <th>Prix total ligne</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                    $verification=true;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['id']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['codCom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['designation']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['qteCom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['prix_total']);?></td>
                                    <td>
                                        <a><?php echo '<a href="modifier-commande-details.php?id_com='.$donnees['id'].'">';?><button class="btn btn-primary btn-xs">Modifier</button></a>
                                        <a><?php echo '<a href="modifier-commande.php?id_com='.$donnees['id'].'">';?><button class="btn btn-primary btn-xs">Supprimer</button></a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                            if($verification==false)
                            {
                                echo '<h3 class="message">Pas de commande</h3>';
                            }
                        ?>
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
