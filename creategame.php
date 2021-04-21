<?php
require_once 'connection_database.php';
$gameinfo= GetGamesDataFromBase();
$id= $_GET["id"];
console_log($id);
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
        <input type="time"  placeholder="00:00" >
        <br>
        <label for="">Persoon die uitlegt</label>
        <input name="personexplain_input" type="text">
        <br>
        <label for="">Personen die spelen</label>
        <input name="personsplay_input" type="text">
        <br>
        <button type="submit" name="submit">Maak</button>
        <a href="index.php" style="text-decoration: none">Terug naar homepagina</a>
    </form>

</div>
</body>
</html>