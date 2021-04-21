<?php
require_once 'connection_database.php';
$gameinfo= GetGamesDataFromBase();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planningstool</title>
    <link rel="stylesheet" href="planning.css">
</head>
<body>
    <div class="container">
        <h1>Welkom in deze webiste!</h1>
        <h3>Uw spellen:</h3>
    <?php  foreach($gameinfo as $arr => $game){?>
    <div class="gameblock">
        <?php $time= $explain_time = $players = $game = "";
            if($_SERVER["REQUESTMETHOD"] == "GET"){
                $game= $_GET["game"];
                $time= $_GET["start_time"];
                $explain_time= $_GET["explain_time"];
                $players= $_GET["players"];

                echo "<b>Game: </b>". $game;
                echo "<b>Starttijd: </b>". $start_time;
                echo "<b>Host: </b>". $explain;
                echo "<b>Spelers: </b>". $players;
            
        }   ?>
    </div>
   <?php }?>
        <a href="viewingpage.php" style= "text-decoration: none">Spel plannen</a>
    </div>
   
</body>
</html>