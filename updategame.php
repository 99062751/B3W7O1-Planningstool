<?php
require_once 'connection_database.php';
$gameinfo= GetGamesDataFromBase();
$game= $_GET['game'];
$Id= $_GET['?Id'];
$gameinfo2= Connect_IDS_tobase($Id, $table= "planning");
console_log($Id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spel aanmaken</title>
    <link rel="stylesheet" href="planning.css">
</head>
<body>
<div class="container">
    <h1>Welkom!</h1>
    <h3>Hier maakt u uw spellen aan</h3>
    <p>Dit zijn uw keuzes:</p>

    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]).'?Id='.$Id;?>" method="POST">
        <label for="gamename">Spel</label>
        <input type="hidden" name="ItemID" value="<?= $Id?>">
        
        <select name="GameiD">
          <?php 
           foreach($gameinfo as $arr => $info){ ?>
                <option value="<?= $info["id"];?>" <?php if($info["id"] == $game){ echo "selected='selected'";} ?> ><?= $info["name"];?></option>
            <?php } ?>
        </select>
            <br>
        <label for="time">Starttijd</label>
        <input type="time" name="time" value="<?= date('H:i' , strtotime($gameinfo2["start_time"]));?>">
        <br>
        <label for="GameMaster">Persoon die uitlegt</label>
        <input name="GameMaster" type="text" value="<?= $gameinfo2["host"]?>">
        <br>
        <label for="players">Personen die spelen</label><br>
        <textarea name="players" cols="30" rows="10">
        <?= $gameinfo2["player"]?>
        </textarea>
        <br>
        <button type="submit" name="update" value="submit">Maak</button>
        <br>
        <a href="index.php">Terug naar homepagina</a>
    </form>
</div>
</body>
</html>


