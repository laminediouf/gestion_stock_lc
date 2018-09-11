<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_livraison']))
    {
        $req=$bdd->prepare('INSERT INTO livraison (codCom, status) VALUES (:codCom, :status)') or die(print_r($bdd->errorInfo()));
        $req->execute(array(
            ':codCom'=>$_GET['id_livraison'],
            ':status'=>'En cours'
        ));
        echo '<script>alert("Votre livraison a ete prise en compte")</script>';
    }
    if(isset($_GET['id_commande']))
    {
        $req=$bdd->prepare('DELETE FROM commande WHERE id=:id_commande') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            ':id_commande'=>$_GET['id_commande']
        ));
        $req=$bdd->prepare('DELETE FROM ligne_commande WHERE codCom=:id_commande') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            ':id_commande'=>$_GET['id_commande']
        ));
        echo '<script>alert("La suppresion de la commande a ete prise en compte")</script>';
    }
    $reponse=$bdd->query('SELECT commande.id AS id_commande, nom, prenom, adresse, codeCli, dateCom, SUM( prix_total ) AS total FROM commande, ligne_commande, client WHERE client.codCli=commande.codeCli AND commande.id=ligne_commande.codCom GROUP BY commande.id') or die(print_r($bdd->errorInfo()));
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
		<title>Liste commande</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des commandes</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Code commande</th>
                                    <th>Code client</th>
                                    <th>Nom et prenom client</th>
                                    <th>Adresse</th>
                                    <th>Date Commande</th>
                                    <th>Montant commande</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                    $verification=true;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['id_commande']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['codeCli']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['nom']).' '.htmlspecialchars($donnees['prenom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['adresse']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['dateCom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['total']);?></td>
                                    <td>
                                        <a><?php echo '<a href="modifier-commande.php?id_commande='.$donnees['id_commande'].'">';?><button class="btn btn-primary btn-xs">Modifier</button></a>
                                        <a><?php echo '<a href="liste-commande.php?id_commande='.$donnees['id_commande'].'">';?><button class="btn btn-primary btn-xs">Supprimer</button></a>
                                        <a><?php echo '<a href="liste-commande.php?id_livraison='.$donnees['id_commande'].'">';?><button class="btn btn-primary btn-xs">Livraison</button></a>
										<a class="btn btn-warning btn-xs" <?php echo 'href="../generation-facture/facture.php?id_commande='.$donnees['id_commande'].'" target="_blank">';?> <span class="glyphicon glyphicon-print"></span></a>
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
