<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');


    $reponse=$bdd->query('SELECT * FROM client') or die(print_r($bdd->errorInfo()));
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
            [class*="panel panel-primary"]
            {
                margin-top: 5%;
            }
        </style>
		<title>Liste client</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu-user.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des clients</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>Code client</th>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['codCli']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['prenom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['nom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['adresse']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['telephone']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['email']);?></td>
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
