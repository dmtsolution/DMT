<?php
session_start();
require 'bdd.php';

if(isset($_POST['modifier'])){
  if(isset($_POST['avis_site']) && !empty(trim($_POST['avis_site']))){
    $avis_site = $_POST['avis_site'];
    $id = $_SESSION['id'];
    $date_modification = date('d/m/Y'." à ".'H:i:s');
    $id_avis = $_GET['id_avis'];

    $update = "UPDATE avis set avis_site = '$avis_site', date_modification = '$date_modification' WHERE id = '$id_avis' AND id_utilisateur = '$id'";
    $modifier = $bdd ->prepare($update);
    $modifier -> execute();
    header('location: index.php');
  }else{
    $message = "Le champ est obligatoire !";
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
    <?php $select = $bdd->prepare("SELECT * FROM avis WHERE id = ? AND id_utilisateur = ?");
    $select->execute(array($_GET['id_avis'], $_SESSION['id']));
    $data = $select->fetch();
    $cpt = $select->rowCount();
    ?>
    <?php if($cpt>0):?>
    <div class="contenaire2">
  <div class="fils shadow">
  <h3 class="text-center text-primary mt-2">Modification de l'avis</h3>
  <form action="" method="post">
        <label for="avis">Avis :</label><br/>
        <?php if(isset($message) && !empty($message)){
          echo $message;
        }?>
        <textarea id="avis" name="avis_site"><?=$data['avis_site']?></textarea><br/>
        <div class="d-flex p-1 column-gap-2">
        <button name="modifier" type="submit" class="btn btn-success">Modifier</button>
        <a href="index.php"><button type="button" class="btn btn-secondary">Annuler</button></a>
        </div>

      </form>
  </div>
  </div>
  <?php endif;?>
  <?php if($cpt == 0){
    header('location: index.php');
  }?>




</body>
</html>