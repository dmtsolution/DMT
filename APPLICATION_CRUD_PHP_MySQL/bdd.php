<?php

try{
    $bdd = new PDO('mysql:host=localhost;dbname=nom-base-de-données;charset=utf8mb4','nom-utilisateur','mot-de-passe');
}catch(Exception $e){
    die('Une erreur a été trouvée : ' .$e->getMessage());
}

?>