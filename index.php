<?php
require_once 'connection_database.php';
$gameinfo= GetGamesDataFromBase();
$planninginfo = GetPlanningDataFromBase();
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

                <?php foreach ($planninginfo as $game => $value) { ?>  
                        <?php 
                            $id= $value["game"];
                            $gameinfo2= Connect_IDS_tobase($id, "games");
                        ?>

                    <div class="detail item">
                        <div class="left">
                            <img class="avatar" src="afbeeldingen/<?php echo $gameinfo2["image"];?>">
                            <h3><?=$gameinfo2["name"];?></h3> 
                            <p><?=$value["game"];?></p>
                            <p><?=$value["start_time"];?></p>
                            <p><?=$value["host"];?></p>
                            <p><?=$value["player"];?></p>
                        </div> 
                    </div> 
                <?php } ?>
                
                
            <a class="" href="viewingpage.php" style= "text-decoration: none">Spel plannen</a>
        </div>
</body>
</html>