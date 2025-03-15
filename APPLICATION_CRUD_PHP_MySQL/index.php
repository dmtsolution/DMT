<?php
session_start();
require 'bdd.php';
if(isset($_POST['poster'])){
  if(isset($_POST['avis_site']) && !empty(trim($_POST['avis_site']))){
    $pseudo = $_SESSION['pseudo'];
    $id = $_SESSION['id'];
    $avis_site =  nl2br($_POST['avis_site']);
    $date_publication = date("d/m/Y ".'à'." H:i:s");

    $insert = $bdd ->prepare("INSERT INTO avis (pseudo, avis_site, date_publication, id_utilisateur) VALUES (:pseudo, :avis_site, :date_publication, :id_utilisateur)");
    $insert->execute(array(
      'pseudo'=>$pseudo,
      'avis_site'=>$avis_site,
      'date_publication'=>$date_publication,
      'id_utilisateur'=>$id
    ));
    header('location: index.php');
  }else{
    $erreur = "Le champ est obligatoire !";
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
    
    <div class="btn-auth">
    <?php if(!isset($_SESSION['id'])):?>
    <a href="connexion.php" class="btn btn-primary">CONNEXION</a>
    <a href="inscription.php" class="btn btn-primary">INSCRIPTION</a>
    <?php endif?>
    <?php if(isset($_SESSION['id'])):?>
    <a href="deconnexion.php" class="btn btn-primary">DECONNEXION</a>
    <?php endif?>
    </div>

    <h3 class="text-center mt-2">Réchauffement climatique</h3>
  <div class="contenaire">
    <div class="fils1 climat shadow">
        <p>L'influence de l'activité humaine sur le réchauffement climatique n'est plus à démontrer : depuis vingt ans les preuves ne cessent de s'accumuler. Mais des transports à l'industrie, en passant par la déforestation, quelles sont les activités humaines qui amplifient l'effet de serre ?
        <img src="images/climat.png">
      </p>
    </div>
    <?php
     $select = $bdd->prepare("SELECT * FROM avis");
     $select->execute();
    ?>
    <div class="fils1 shadow">
          <b>Avis des <?php if(isset($_SESSION['id'])):?>utilisateurs<?php endif?> <?php if(!isset($_SESSION['id'])):?>visiteurs<?php endif?> </b>
          <hr>
          <?php while($data = $select->fetch()):?>
          <h5><?=  htmlspecialchars($data['pseudo']) ?></h5>
          <?php if(isset($_SESSION['id'])):?>
          <?php  if($_SESSION['id'] == $data['id_utilisateur' ]):?>
            <a href="supprimer_avis.php?id_avis=<?=$data['id']?>"><img src="images/delete.png" style="float:right" width="20px"></a>
            <a href="modifier_avis.php?id_avis=<?=$data['id']?>"><img src="images/edit.png" style="float:right" width="20px"></a>
            <?php endif?>
          <?php endif?>
          </h5>
          <p><?=  htmlspecialchars($data['avis_site'])?><br>
          <small>publié le <?=  $data['date_publication'] ?> <?php if(isset($data['date_modification']) && !empty($data['date_modification'])):?>- modifié le <?php endif?><?= $data['date_modification']?></small>
          <hr>
          </p>
          <?php endwhile;?>
    </div>
  </div>
  <div class="contenaire1">
  <div class="fils shadow">
        <form action="" method="post">
          <h2>
            <?php if(!empty($erreur)){
              echo $erreur;
            }?>
          </h2>
        <label for="avis">Avis :</label><br/>
        <textarea id="avis" name="avis_site"></textarea><br/>
        <button name="poster" type="submit" class="btn btn-primary">Poster</button>
      </form>
  </div>
  </div>




</body>
</html>