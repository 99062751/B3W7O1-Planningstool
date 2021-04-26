<?php
require_once 'connection_database.php';
$gameinfo= GetGamesDataFromBase();
$id= $_GET["id"];
$gameinfo2= Connect_IDS_tobase();
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
    <h3> Hier maakt u uw spellen aan</h3>
    <p>Dit zijn uw keuzes:</p>

    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
        Spel
        <select name="gamename">
          <?php  foreach($gameinfo as $arr => $game){?>
                <option value="<?php echo $game["id"];?>" <?php if($game["id"] == $id){ echo "selected='selected'";} ?> ><?php echo $game["name"];?></option>
            <?php   }?>
        </select>
            <br>
        <label for="time">Starttijd</label>
        <input type="time" name="time">
        <input type="hidden" name="explaintime" value="<?= $gameinfo2["explain_minutes"]?>">
        <input type="hidden" name="GameiD" value="<?= $gameinfo2["id"]?>">
        <br>
        <label for="GameMaster">Persoon die uitlegt</label>
        <input name="GameMaster" type="text">
        <br>
        <label for="players">Personen die spelen</label><br>
        <textarea name="players" cols="30" rows="10"></textarea>
        <br>
        <button type="submit" name="submit">Maak</button>
        <br>
        <a href="viewingpage.php" style="text-decoration: none">Terug naar overzicht</a>
    </form>

</div>
</body>
</html>