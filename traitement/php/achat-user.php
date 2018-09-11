<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_POST['client']))
    {
        $_SESSION['id_client']=$_POST['client'];
    }

    if(isset($_GET['validate_panier']))
    {
        //Creer une commande et donner son ID aux elements de la table ligneCommande
        $req=$bdd->prepare('INSERT INTO commande (codeCli, dateCom) VALUES (:codeCli, NOW())') or die(print_r($bdd->errorInfo()));
        $req->execute(array(
            ':codeCli'=>$_SESSION['id_client']
        ));
        echo '<script>alert("Votre commande a ete prise en compte")</script>';

        //Requete recuperant le dernier element de la table commande
        $reponse4=$bdd->query('SELECT MAX(id) AS maxi FROM commande') or die(print_r($bdd->errorInfo()));
        while($donnees4=$reponse4->fetch())
        {
            $_SESSION['dernier_element']=htmlspecialchars($donnees4['maxi']);
        }

        //Ajouter les elements du panier dans la table ligneCommande
        $bdd->query('INSERT INTO ligne_commande (codProd, QteCom, prix_total) SELECT codProd, QteCom, prix_total FROM panier') or die(print_r($bdd->errorInfo()));

        //Requete recuperant le nombre d'elements de la table panier
        $reponse5=$bdd->query('SELECT COUNT(id) AS nbTotal FROM panier');
        while($donnees5=$reponse5->fetch())
        {
            $_SESSION['nombre_element']=htmlspecialchars($donnees5['nbTotal']);
        }

        //Affectation d'une commande a une ligne commande
        //Attention en PDO 'LIMIT' supporte mal les requetes prepares d'ou cette facon de faire
        $bdd->query('UPDATE ligne_commande SET codCom='.$_SESSION['dernier_element'].' ORDER BY id DESC LIMIT '.$_SESSION['nombre_element'].'') or die(print_r($bdd->errorInfo()));

        //Vider la table panier a la fin de la saisie du panier
        $bdd->query('TRUNCATE TABLE panier') or die(print_r($bdd->errorInfo()));
    }

    if(isset($_POST['designation']) AND isset($_POST['quantite']))
    {
        $req=$bdd->prepare('INSERT INTO panier(codProd, QteCom, prix_total) VALUES (:codProd,:QteCom,:QteCom*(SELECT prixUnitaire FROM produit WHERE codProd=:codProd))') or die(print_r($bdd->errorInfo()));
        $req->execute(array(
            ':codProd'=>$_POST['designation'],
            ':QteCom'=>$_POST['quantite']
        ));
        echo '<script>alert("Le produit a bien ete ajoute au panier")</script>';
    }
    $reponse2=$bdd->query('SELECT * FROM produit') or die(print_r($bdd->errorInfo()));
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
                margin-left: 37%;
                margin-right: 35%;
            }
            [class*="message"]
            {
                margin-left: 43%;
                margin-right: 35%;
            }
            [class="btn btn-primary"]
            {
                margin-left: 37%;
                margin-right: 40%;
            }
        </style>
		<title>Achat</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu-user.php"); ?>
            <form class="form-horizontal" action="achat.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre">Ajout produit au panier:</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <select name="designation" id="designation" class="form-control input-md">
                                <?php
                                $reponse=$bdd->query('SELECT * FROM produit') or die(print_r($bdd->errorInfo()));
                                while($donnees=$reponse->fetch())
                                {
                                ?>
                                <option value="<?php echo htmlspecialchars($donnees['codProd']);?>"><?php echo htmlspecialchars($donnees['designation']);?></option>
                                <?php
                                }
                                ?>
                            </select>
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
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Ajouter au panier" class="btn btn-info btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Contenu panier</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Designation</th>
                                    <th>Type unite</th>
                                    <th>Quantite</th>
                                    <th>Prix unitaire</th>
                                    <th>Prix total ligne</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $reponse3=$bdd->query('SELECT id, designation, unite, QteCom, prixUnitaire, prix_total FROM panier, produit WHERE panier.codProd=produit.codProd') or die(print_r($bdd->errorInfo()));
                                $verification=false;
                                while($donnees3=$reponse3->fetch())
                                {
                                    $verification=true;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees3['id']);?></td>
                                    <td><?php echo htmlspecialchars($donnees3['designation']);?></td>
                                    <td><?php echo htmlspecialchars($donnees3['unite']);?></td>
                                    <td><?php echo htmlspecialchars($donnees3['QteCom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees3['prixUnitaire']);?></td>
                                    <td><?php echo htmlspecialchars($donnees3['prix_total']);?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                            if($verification==false)
                            {
                                echo '<h3 class="message">Panier vide</h3>';
                            }
                        ?>
                    </div>
                </section>
            </div>
            <a href="achat.php?validate_panier=true"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> Valider panier et passer commande</button></a>
        </div>
        <script src="../js/validate_form_panier.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $('blockquote a').tooltip();
            });
        </script>
    </body>
</html>
