<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_user']))
    {
        $req=$bdd->prepare('DELETE FROM user WHERE id=:id') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'id'=>$_GET['id_user']
        ));
        echo '<script>alert("La suppresion a ete prise en compte")</script>';
    }
    $reponse=$bdd->query('SELECT user.id, login, email, nom, prenom, adresse, date_inscription, groupe FROM user , user_groupe WHERE user.type_groupe=user_groupe.id') or die(print_r($bdd->errorInfo()));
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
		<title>Liste utilisateur</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <div class="row">
                <section class="col-sm-12">
                    <div class="panel panel-primary">
                        <table class="table table-striped table-condensed">
                            <div class="panel-heading">
                                <h3 class="panel-title">Liste des utilisateurs</h3>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID utilisateur</th>
                                    <th>Login</th>
                                    <th>password</th>
                                    <th>Pin</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Prenom</th>
                                    <th>Adresse</th>
                                    <th>Date inscription</th>
                                    <th>Type compte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($donnees=$reponse->fetch())
                                {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donnees['id']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['login']);?></td>
                                    <td>**************</td>
                                    <td>**************</td>
                                    <td><?php echo htmlspecialchars($donnees['email']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['nom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['prenom']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['adresse']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['date_inscription']);?></td>
                                    <td><?php echo htmlspecialchars($donnees['groupe']);?></td>
                                    <td>
                                        <a><?php echo '<a href="modifier-utilisateur.php?id_user='.$donnees['id'].'">';?><button class="btn btn-primary btn-xs">Modifier</button></a>
                                        <a><?php echo '<a href="liste-utilisateur.php?id_user='.$donnees['id'].'">';?><button class="btn btn-primary btn-xs">Supprimer</button></a>
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
