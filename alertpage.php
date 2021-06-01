<?php
require_once 'connection_database.php'; 
$Id= $_GET['Id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verwijderpagina</title>
</head>
<body>

    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]).'?Id='.$Id;?>" method="POST">
        <label for="delete">Weet u zeker dat u dit spel wilt verwijderen?</label>
        <input name="Id" type="hidden" value="<?= $Id?>">
        <br>
        <button type="submit" name="delete">Ja</button>
        <a href="index.php">Nee, terug naar homepagina</a>
    </form>
    
</body>
</html>