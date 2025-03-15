<?php
if(isset($_POST['id']) && !empty(trim($_POST['id'])) || isset($_POST['password']) && !empty(trim($_POST['password']))){

    if(isset($_POST['id']) && !empty(trim($_POST['id']))){

    if(isset($_POST['password']) && !empty(trim($_POST['password']))){
    $user_id = $_POST["id"];
    $user_password = $_POST['password'];

}else{
    header('location: index.php?err=pw');
}

}else{
    header('location: index.php?err=id');
}

}else{
    header('location: index.php?err=tw');

}

?>