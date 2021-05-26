<?php
require_once 'connection_database.php';
$gameId= $_GET["game"];
$Id= $_GET['?Id'];
console_log($gameId);
console_log($Id);
$gameinfo2= Connect_IDS_tobase($gameId, "games");
$infoS= GetSpecificInfoFromDataBase($Id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="planning.css">
</head>
<body>
<header><h1><?php echo $gameinfo2["name"];?></h1>
    <a class="backbutton" href="index.php"><i class="fas fa-long-arrow-alt-left"></i> Terug</a></header>

    <?php foreach ($infoS as $game => $value) { 
    
    }
    ?>

<div id="container">
    <div class="detail">
        <div class="left">
            <img class="avatar img" src="afbeeldingen/<?php echo $gameinfo2["image"];?>">
            <?= $gameinfo2["youtube"]?>
        </div>  

        <div class="right">
            <h4>Beschrijving</h4>
            <?php echo $gameinfo2["description"];?>
            <h4>Expansions</h4>
            <?php  echo $gameinfo2["expansions"];?>
            <h4>Skills</h4>
            <?php   echo $gameinfo2["skills"];?>
            <h4>Minimum Spelers</h4>
            <?php   echo $gameinfo2["min_players"];?>
            <h4>Maximum Spelers</h4>
            <?php   echo $gameinfo2["max_players"];?>
            <h4>Speeltijd</h4>
            <?php   echo $gameinfo2["play_minutes"];?>
            <h4>Uitlegtijd</h4>
            <?php   echo $gameinfo2["explain_minutes"];?>
            <h4>Spelers</h4>
            <?php   echo $value["player"];?>
            <h4>Uitlegger</h4>
            <?php   echo $value["host"];?>
        </div>        
    </div> 
    
</div>
</body>
</html>