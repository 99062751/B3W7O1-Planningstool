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
        <div class="gameblock"> 
            <?php 
                    $time= $explain = $players = $game = "";
                
                    if($_SERVER["REQUESTMETHOD"] == "POST"){
                        $game= $_POST["GameiD"];
                        $time= $_POST["time"];
                        $explain= $_POST["explain_time"];
                        $players= $_POST["players"];

                        echo "<b>Game: </b>". $game;
                        echo "<b>Starttijd: </b>". $start_time;
                        echo "<b>Host: </b>". $explain;
                        echo "<b>Spelers: </b>". $players;
                    }
            /*foreach($gameinfo as $arr => $game){?>
                
                    <?php $time= $explain_time = $players = $game = "";
                        if($_SERVER["REQUESTMETHOD"] == "POST"){
                            $game= $_POST["game"];
                            $time= $_POST["start_time"];
                            $explain_time= $_POST["explain_time"];
                            $players= $_POST["players"];

                            echo "<b>Game: </b>". $game;
                            echo "<b>Starttijd: </b>". $start_time;
                            echo "<b>Host: </b>". $explain;
                            echo "<b>Spelers: </b>". $players;
                        
                    }   ?>
                </div>
            <?php }*/?> 
        </div>
        <a href="viewingpage.php" style= "text-decoration: none">Spel plannen</a>
    </div>
   
</body>
</html>