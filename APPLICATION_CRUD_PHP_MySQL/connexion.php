<?php
session_start();
include 'bdd.php';
if(isset($_POST['connexion'])){
    if(isset($_POST['pseudo']) && !empty(trim($_POST['pseudo']))){
        if(isset($_POST['mot_de_passe']) && !empty(trim($_POST['mot_de_passe']))){
            $pseudo = $_POST['pseudo'];
            $mot_de_passe = $_POST['mot_de_passe'];

            $verifier = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
            $verifier->execute(array($pseudo));
            $data = $verifier->fetch();
            $cpt = $verifier->rowCount();

            if($cpt > 0){
                if(password_verify($mot_de_passe, $data['mot_de_passe'])){
                    $_SESSION['pseudo'] = $data['pseudo'];
                    $_SESSION['id'] = $data['id'];
                    header("Location: index.php");
                }else{
                    $mot_de_passe_comparaison = "Le mot de passe est incorrect !";
                }
            }else{
                $utilisateur_erreur = "Pseudo inexistant !";
            }
        }else{
            $mot_de_passe_erreur = "Le mot de passe est obligatoire !";
        }
    }else {
        $pseudo_erreur = "Le pseudo est obligatoire !";
    }
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <a href="./" class="btn m-4 btn-primary">Accueil</a>

    <div class="contenaire2">
  <div class="fils shadow">
  <h3 class="text-center text-primary mt-2">Connectez-vous</h3>
     <?php if(!empty($mot_de_passe_comparaison)){
        echo $mot_de_passe_comparaison;
     }?>
          <?php if(!empty($utilisateur_erreur)){
        echo $utilisateur_erreur;
     }?>
        <form action="" method="post">
        <label>Pseudo :</label><br/>
        <?php if(!empty($pseudo_erreur)){
        echo $pseudo_erreur;
        }?>
        <input id="pseudo" type="text" name="pseudo"/><br/>
        <label>Mot de passe :</label><br/>
        <?php if(!empty($mot_de_passe_erreur)){
        echo $mot_de_passe_erreur;
        }?>
        <input id="password" type="password" name="mot_de_passe"/><br/><br/>
        <button name="connexion" type="submit" class="btn btn-primary">connexion</button>
      </form>
  </div>
  </div>




</body>
</html>