<?php
require_once 'connection_database.php';
$gameinfo= GetGamesDataFromBase();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <link rel="stylesheet" href="planning.css">
</head>
<body>
    <div class="container">
    <a href="index.php" style="text-decoration: none">Terug</a>
        <h1>Kies een game!</h1>
        <?php foreach($gameinfo as $array => $game){?>
            <a class="item" href="gamepage.php?id=<?= $game["id"];?>">
            <div class="left">
                <img class="avatar" src="afbeeldingen/<?php echo $game["image"];?>">
            </div>
            <div class="right">
                <h2><?=$game["name"];?></h2>
                <!-- <div class="stats">
                    <ul class="fa-ul">
                        <li><span class="fa-li"><i class="fas fa-heart"></i></span><?=$game["health"]?></li>
                        <li><span class="fa-li"><i class="fas fa-fist-raised"></i></span><?=$name["attack"]?></li>
                        <li><span class="fa-li"><i class="fas fa-shield-alt"></i></span><?=$name["defense"]?></li>
                        <li><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span><?=$nameLocation; ?></li>
                    </ul>
                </div> -->
            </div>
            <div class="detailButton"><i class="fas fa-search"></i> bekijk</div>
        </a>
        <?php } ?>
    </div>

</body>
</html>