<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_livr']))
    {
        $req=$bdd->prepare('UPDATE livraison SET status=:status, dateLivraison=NOW() WHERE codeli=:codeli') or die(print_r($bdd->errorInfo()));
        $req->execute(array(
            ':codeli'=>$_GET['id_livr'],
            ':status'=>'Livrer'
        ));
        echo '<script>alert("Votre modification du status a ete prise en compte")</script>';
    }

    $reponse=$bdd->query('SELECT codeli, codCom, nom, prenom, adresse, dateCom, dateLivraison, status FROM livraison li, commande c, client cl WHERE li.codCom=c.id AND cl.codCli=c.codeCli') or die(print_r($bdd->errorInfo()));
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
                margin-left: 107px;
            }
            [class*="panel panel-primary"]
            {
                margin-top: 5%;
            }
        </style>
		<title>Liste livraison</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu-user.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des livraison</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Code livraison</th>
                                    <th>Code client</th>
                                    <th>Nom et prenom client</th>
                                    <th>Adresse</th>
                                    <th>Date commande</th>
                                    <th>Date livraison</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                    $verification=true;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['codeli']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['codCom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['nom']).' '.htmlspecialchars($donnees['prenom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['adresse']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['dateCom']);?></td>
                                    <td><?php
                                        if(strcmp(htmlspecialchars($donnees['dateLivraison']),'0000-00-00')==0)
                                        {
                                            echo 'non livre';
                                        }
                                        else
                                        {
                                            echo htmlspecialchars($donnees['dateLivraison']);
                                        }
                                     ?></td>
                                    <td><?php echo htmlspecialchars($donnees['status']);?></td>
                                    <td>
                                        <a><?php echo '<a href="liste-livraison.php?id_livr='.$donnees['codeli'].'">';?><button class="btn btn-primary btn-xs">Valider</button></a>
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
                                echo '<h3 class="message">Pas de livraison</h3>';
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
