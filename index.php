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
            <a class="" href="viewingpage.php" style= "text-decoration: none">Spel plannen</a>
            <h3>Uw spellen:</h3>

                <?php foreach ($planninginfo as $game => $value) { ?>  
                        <?php 
                            $id= $value["game"];
                            $Id= $value["id"];
                            $gameinfo2= Connect_IDS_tobase($id, "games");
                        ?>

                <a href="gamedetails.php?game=<?= $value["game"] .'&?Id=' .$value["id"];?>">
                    <div class="detail itemX">
                        <div class="left stats" style="text-align: center">
                            <img class="avatar" src="afbeeldingen/<?php echo $gameinfo2["image"];?>">
                            <h3><?=$gameinfo2["name"];?></h3> 
                            <p>Begintijd: <?=$value["start_time"];?></p>
                            <p>Uitlegger: <?=$value["host"];?></p>
                            <p>Duur: <?=$value["duration"];?> minuten</p>
                            <p><a href="">Bewerk</a></p>
                            <p><a href="">Verwijder</a></p>
                        </div> 
                    </div> 
                </a>
                        
                    
                <?php } ?>
        </div>
</body>
</html>