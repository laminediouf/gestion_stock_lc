<?php
    include_once('connexion_sql.php');
    session_start();
	include_once('logout.php');

    if(isset($_GET['id_user']))
    {
        $_SESSION['id_user']=$_GET['id_user'];
    }

    if(isset($_POST['login']) OR isset($_POST['password']) OR isset($_POST['pin']) OR isset($_POST['prenom'])
    OR isset($_POST['nom']) OR isset($_POST['adresse']) OR isset($_POST['email']) OR isset($_POST['type_groupe']))
    {
        $req=$bdd->prepare('UPDATE user SET login=:login,password=:password,pin=:pin,email=:email,nom=:nom, prenom=:prenom, adresse=:adresse, type_groupe=:type_groupe WHERE id=:id') or die(print_r($bbd->errorInfo()));
        $req->execute(array(
            'id'=>$_SESSION['id_user'],
            'login'=>$_POST['login'],
            'password'=>sha1($_POST['password']),
            'pin'=>sha1($_POST['pin']),
            'email'=>$_POST['email'],
            'nom'=>$_POST['nom'],
            'prenom'=>$_POST['prenom'],
            'adresse'=>$_POST['adresse'],
            'type_groupe'=>$_POST['type_groupe']
        ));
        echo '<script>alert("La modification a ete prise en compte")</script>';
    }

    $reponse=$bdd->prepare('SELECT user.id, login, email, nom, prenom, adresse, date_inscription, groupe FROM user , user_groupe WHERE user.type_groupe=user_groupe.id AND user.id=:id') or die(print_r($bdd->errorInfo()));
    $reponse->execute(array(
        'id'=>$_SESSION['id_user']
    ));
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
                margin-left: 39%;
                margin-right: 37%;
            }
            [class*="panel panel-primary"]
            {
                margin-top: 5%;
            }
        </style>
		<title>Modifier utilisateur</title>
    </head>
    <body>
        <div class="container">
            <?php include("menu.php"); ?>
            <form class="form-horizontal" action="modifier-utilisateur.php" method="post" onsubmit="return validate(this)">
                <fieldset>
                    <h2 class="titre">Modifier utilisateur :</h2>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="id_user" name="id_user" placeholder="id" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['id']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="login" name="login" placeholder="Login" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['login']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="password" name="password" placeholder="Password" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="pin" name="pin" placeholder="Pin" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="prenom" name="prenom" placeholder="Prenom" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['prenom']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['nom']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="text" id="adresse" name="adresse" placeholder="Adresse" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['adresse']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control input-md" value="<?php echo htmlspecialchars($donnees['email']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <select name="type_groupe" id="type_groupe" class="form-control input-md">
                                <?php
                                $reponse2=$bdd->query('SELECT * FROM user_groupe') or die(print_r($bdd->errorInfo()));
                                while($donnees2=$reponse2->fetch())
                                {
                                ?>
                                <option value="<?php echo htmlspecialchars($donnees2['id']);?>"><?php echo htmlspecialchars($donnees2['groupe']);?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 control-label">
                            <input type="submit" value="Modifier utilisateur" class="btn btn-info btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <script src="../js/validate_form_user.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $('blockquote a').tooltip();
            });
        </script>
    </body>
</html>
