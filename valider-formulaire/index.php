<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Traitement de formulaire en PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
    <div class="contenaire">
        <div class="fils shadow">
        <form action="traitement.php" method="post">
        <label for="id">Identifiant :</label><br/>
        <input class="form-control" type="text" id="id" name="id" autocomplete="off"><br/>
        <label for="password">Mot de passe :</label><br/>
        <input class="form-control" type="password" id="password" name="password" autocomplete="off"><br/>
        <button type="submit" class="btn btn-outline-light">envoyer</button>
      </form>
        </div>
    </div>





</body>
</html>