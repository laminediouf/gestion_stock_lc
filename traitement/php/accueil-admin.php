<?php
    include_once('connexion_sql.php');
	session_start();
	include_once('logout.php');
    
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
            [class*="nav navbar-nav"]
            {
                margin-left: 35px;
            }
        </style>
	<title>Accueil</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <div class="row">
                <section class="col-sm-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">FAQ :</h3>
                        </div>
                        <div class="list-group">
                            <a href="#infos" class="list-group-item" data-toggle="modal">
                                Gestion clients
                                <span class="badge">?</span>
                            </a>
                            <div class="modal fade" id="infos" role="dialog" aria-labelledby="modalTitre" area-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 id="modalTitre" class="modal-title">Plus d'information</h4>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote>
                                                <p> La gestion des clients se subdivise en deux partie,
                                                la liste des clients et l'ajout des clients.
                                                C'est dans la liste des clients que l'on effectuer les modifications.</p>
                                                <hr>
                                                <small class="pull-right">Gestion clients </small><br>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#infos1" class="list-group-item" data-toggle="modal">
                                Gestion fournisseurs
                                <span class="badge">?</span>
                            </a>
                            <div class="modal fade" id="infos1" role="dialog" aria-labelledby="modalTitre" area-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 id="modalTitre" class="modal-title">Plus d'information</h4>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote>
                                                <p> La gestion des fournisseurs se subdivise en deux partie,
                                                la liste des fournisseurs et l'ajout des fournisseurs.
                                                C'est dans la liste des fournisseurs que l'on effectuer les modifications.</p>
                                                <hr>
                                                <small class="pull-right">Gestion fournisseurs </small><br>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#infos2" class="list-group-item" data-toggle="modal">
                                Magazin
                                <span class="badge">?</span>
                            </a>
                            <div class="modal fade" id="infos2" role="dialog" aria-labelledby="modalTitre" area-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 id="modalTitre" class="modal-title">Plus d'information</h4>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote>
                                                <p> La gestion du magazin se subdivise en deux partie,
                                                la liste des produits et l'ajout des produits.
                                                C'est dans la liste des produits que l'on effectuer les modifications.</p>
                                                <hr>
                                                <small class="pull-right">Gestion magazin </small><br>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#infos3" class="list-group-item" data-toggle="modal">
                                Gestion commandes
                                <span class="badge">?</span>
                            </a>
                            <div class="modal fade" id="infos3" role="dialog" aria-labelledby="modalTitre" area-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 id="modalTitre" class="modal-title">Plus d'information</h4>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote>
                                                <p> Pour ajouter une commande, il faut aller dans le panier
                                                et inserer le client concerner, puis remplir son panier et enfin
                                                valider la commande, pour voir la liste des commande et les modifier,
                                                rendez-vous dans Gestion commande et livraison puis liste commande.</p>
                                                <hr>
                                                <small class="pull-right">Gestion commandes</small><br>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#infos4" class="list-group-item" data-toggle="modal">
                                Gestion utilisateurs
                                <span class="badge">?</span>
                            </a>
                            <div class="modal fade" id="infos4" role="dialog" aria-labelledby="modalTitre" area-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 id="modalTitre" class="modal-title">Plus d'information</h4>
                                        </div>
                                        <div class="modal-body" data-toggle="modal">
                                            <blockquote>
                                                <p> La gestion des utilisateurs se subdivise en deux partie,
                                                la liste des utilisateurs et l'ajout des utilisateurs.
                                                C'est dans la liste des utilisateurs que l'on effectuer les modifications.</p>
                                                <hr>
                                                <small class="pull-right">Gestion utilisateurs </small><br>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#infos5" class="list-group-item" data-toggle="modal">
                                Gestion livraison
                                <span class="badge">?</span>
                            </a>
                            <div class="modal fade" id="infos5" role="dialog" aria-labelledby="modalTitre" area-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 id="modalTitre" class="modal-title">Plus d'information</h4>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote>
                                                <p> Pour ajouter une livraison, il faut aller dans les commandes
                                                et cliquer sur livraison.Puis si vous voulez valider ou la mettre en cours cette
                                                commande vous pouvez aller dans livraison puis cliquez sur les boutons suivant
                                                des livraisons concerner VALIDER, EN COURS ou ANUULER.</p>
                                                <hr>
                                                <small class="pull-right">Gestion livraison</small><br>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-sm-8">
                    <div id="carousel" class="carousel slide">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                            <li data-target="#carousel" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active"><img alt="Paysage" src="../../media/Sans-titre---2.png"></div>
                            <div class="item"><img alt="Paysage" src="../../media/Sans-titre---1.png"></div>
                            <div class="item"><img alt="Paysage" src="../../media/1237.jpg"></div>
                            <div class="item"><img alt="Paysage" src="../../media/1238.jpg"></div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Resume dernieres commandes</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Code commande</th>
                                    <th>Code client</th>
                                    <th>Nom et prenom client</th>
                                    <th>Adresse</th>
                                    <th>Date Commande</th>
                                    <th>Montant commande</th>
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
                $('.carousel').carousel();
                $('blockquote a').tooltip();
            });
        </script>
    </body>
</html>
