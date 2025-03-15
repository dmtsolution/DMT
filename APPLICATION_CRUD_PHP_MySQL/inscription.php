<?php
include 'bdd.php';

if(isset($_POST['inscription'])){
  if(isset($_POST['pseudo']) && !empty(trim($_POST['pseudo']))){
    if(isset($_POST['mot_de_passe']) && !empty(trim($_POST['mot_de_passe']))){
      $pseudo = $_POST['pseudo'];
      $mot_de_passe = $_POST['mot_de_passe'];
      $date_inscription = date("d/m/Y ".'à'. " H:i:s");

      $verifier = $bdd -> prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = ?");
      $verifier->execute(array($pseudo));

      $cpt = $verifier -> rowCount();

      if($cpt===0){
        $cout = ['cost'=>12];
        $mot_de_passe_valide = password_hash($mot_de_passe, PASSWORD_BCRYPT, $cout);

        $insert = $bdd ->prepare("INSERT INTO utilisateurs (pseudo, mot_de_passe, date_inscription) VALUES (:pseudo, :mot_de_passe, :date_inscription)");
        $insert ->execute(array(
          'pseudo' => $pseudo,
          'mot_de_passe' => $mot_de_passe_valide,
          'date_inscription' => $date_inscription
        ));
        header('Location: index.php');
      }else{
        $existe = 'Le pseudo existe déjà';
      }
    }else{
      $mot_de_passe_erreur="Le mot de passe est obligatoire !";
    }
  }else{
    $pseudo_erreur = 'Le pseudo est obligatoire !';
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
  <h3 class="text-center text-success mt-2">Inscription</h3>
        <?php if(!empty($existe)){
          echo $existe;
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
        <button name="inscription" type="submit" class="btn btn-success">s'inscrire</button>
      </form>
  </div>
  </div>




</body>
</html>