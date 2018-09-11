<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['codFour']))
    {
        $req=$bdd->prepare('DELETE FROM fournisseur WHERE codFour=:codFour') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'codFour'=>$_GET['codFour']
        ));
        echo '<script>alert("La suppresion a ete prise en compte")</script>';
    }
    $reponse=$bdd->query('SELECT * FROM fournisseur') or die(print_r($bdd->errorInfo()));
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
		<title>Liste fournisseur</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des fournisseurs</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Code fournisseur</th>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['codFour']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['prenom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['nom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['adresse']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['telephone']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['email']);?></td>
                                    <td>
                                        <a><?php echo '<a href="modifier-fournisseur.php?id_fournisseur='.$donnees['codFour'].'">';?><button class="btn btn-primary btn-xs">Modifier</button></a>
                                        <a><?php echo '<a href="liste-fournisseur.php?id_fournisseur='.$donnees['codFour'].'">';?><button class="btn btn-primary btn-xs">Supprimer</button></a>
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
