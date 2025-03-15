<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Contactez-nous</h1>
    
    <form action="traitement.php" method="post">
        <label for="name">Nom</label>&ensp;&emsp;
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">Email</label>&emsp;
        <input type="email" name="email" id="email" required>
        <br>
        <label for="message">Message</label>
        <textarea name="message" id="message" required></textarea>
        <br><br>
        <button>Envoyer</button>
    </form>
    
</body>
</html>