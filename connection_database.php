<?php
//console.log om dingen te loggen is makkelijker voor mezelf
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>'; 
    }
    echo $js_code;
}

/*============ Connectie met database ===============*/
function connect(){
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "B3W4O1__forChar";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
/*============ Geplande data van spel ophalen en in database zetten ===============*/
function GetGamesDataFromBase(){
    $conn= connect();

    $stmt = $conn->prepare("SELECT * FROM games");
    $stmt->execute();
    $gameinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;
    return $gameinfo;
}
function GetPlanningDataFromBase(){
    $conn= connect();

    $stmt = $conn->prepare("SELECT * FROM planning ORDER BY start_time");
    $stmt->execute();
    $planninginfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;
    return $planninginfo;
}

//Resultaat ophalen uit database met zelfde id als $id
function Connect_IDS_tobase($id, $table = "games"){
    $conn= connect();
   
    if (!empty($id) && is_numeric($id) && isset($id) && ($table == "planning" || $table == "games")) {
        $stmt = $conn->prepare("SELECT * FROM `$table` WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $gameinfo2 = $stmt->fetch(PDO::FETCH_ASSOC);    
        return  $gameinfo2;
    }

    $conn = null;
}


function GetSpecificInfoFromDataBase($Id){
    $conn= connect();

    $stmt = $conn->prepare("SELECT * FROM planning WHERE id=:id");
    $stmt->bindParam(':id', $Id);
    $stmt->execute();
    $infoS = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;
    return $infoS;
}

/*============ Controles ===============*/

function trimdata($var){
    $var= trim($var);
    $var= stripslashes($var);
    $var= htmlspecialchars($var);
    return $var;
}

function Controle(){
    $data=[];
    $errors=[];
 
    if(!empty($_POST["update"])){
        if(isset($_POST["ItemID"]) && !empty($_POST["ItemID"])){
            $ItemID= trimdata($_POST["ItemID"]);
            settype($ItemID, "int");
            $info= Connect_IDS_tobase($ItemID, "planning");
            if(is_numeric($ItemID) && isset($ItemID) && !empty($ItemID) && isset($info) && !empty($info)) {
                $data["ItemID"]= $ItemID;
            } else{
                $errors["ItemID"] = "het geplande spel dat je wilt aanpassen bestaat niet.";
            }
        } else{
            $errors["ItemID"] = "het geplande spel dat je wilt aanpassen bestaat niet of word niet meegestuurd";
        }
    } 
    
//maak errors self explaining

    if(isset($_POST["GameiD"]) && !empty($_POST["GameiD"])){
        $GameiD= trimdata($_POST["GameiD"]);
        settype($GameiD, "int");
        $game= Connect_IDS_tobase($GameiD, "games");
        if(is_numeric($GameiD) && isset($GameiD) && !empty($GameiD) && isset($game) && !empty($game)) {
            $data["GameiD"]= $GameiD;
        }
    }

    if(isset($_POST["GameMaster"]) && !empty($_POST["GameMaster"])){
        $GM= trimdata($_POST["GameMaster"]);
        if (preg_match("/^[a-zA-Z-' ]*$/", $GM)) {
            $data["GameMaster"]= $GM;
        }
    }
   
    if (isset($_POST["players"]) && !empty($_POST["players"])) {
        $players= trimdata($_POST["players"]);
        if (preg_match("/^[a-zA-Z-,' .]*$/", $players)) {
            $data["players"]= $players;
        }
    }

    if(isset($_POST["time"]) && !empty($_POST["time"])){
        $time = trimdata($_POST["time"]);
        if (preg_match("/^(?:2[0-4]|[01][1-9]|10):([0-5][0-9])$/", $time)) {
            $data["start_tijd"]= $time;
        }
    }

    if(isset($_POST["GameiD"]) && !empty($_POST["GameiD"])){
        $id= $_POST["GameiD"];
        $game = Connect_IDS_tobase($id, "games");
       
        $duration= CalculateDuration($game["explain_minutes"], $game["play_minutes"]);
        $data["duration"]= $duration;
    }
    $data["errors"]= $errors;    
    return $data;
}

/*============ CRUD ===============*/
function AddCreatedGameToBase($data){
    $conn= connect();
    if(isset($data["start_tijd"]) && isset($data["GameMaster"]) && isset($data["players"])){
        console_log("SUCCESFULLY ADDED: DATA");
        $stmt = $conn->prepare("INSERT INTO `planning`(game, start_time, duration, host, player) VALUES(:game, :start_time, :duration, :host, :players)");
        $stmt->bindParam(':game', $data["GameiD"]);
        $stmt->bindParam(':start_time', $data["start_tijd"]);
        $stmt->bindParam(':duration', $data["duration"]);
        $stmt->bindParam(':host', $data["GameMaster"]);
        $stmt->bindParam(':players', $data["players"]);
        $stmt->execute();  
        echo 'game is toegevoegd.'; 
    } else{
        console_log("ERROR: NAME FOR LOCATION IS EMPTY");
    }
    $conn = null;
}    

function UpdateGame($data){
    console_log($data["ItemID"]);
    $conn= connect();
    if(isset($data["start_tijd"]) && isset($data["GameMaster"]) && isset($data["players"]) && isset($data["GameiD"]) && isset($data["ItemID"])){
        $stmt = $conn->prepare("UPDATE `planning` SET game= :game, start_time= :start_time, duration= :duration, host= :host, player= :players WHERE id=:id");
        $stmt->bindParam(':game', $data["GameiD"]);
        $stmt->bindParam(':start_time', $data["start_tijd"]);
        $stmt->bindParam(':duration', $data["duration"]);
        $stmt->bindParam(':host', $data["GameMaster"]);
        $stmt->bindParam(':players', $data["players"]);
        $stmt->bindParam(':id', $data["ItemID"]);
        $stmt->execute();   
        console_log("SUCCESFULLY UPDATED DATA");
        echo 'game is ge-updated.';

    } else{
        console_log("ERROR: NAME FOR LOCATION IS EMPTY");
    }
    $conn = null;
} 

function Delete($Id){
    $conn= connect();
    
    if(!empty($Id) && is_numeric($Id)){
        $stmt = $conn->prepare("DELETE FROM planning WHERE id=:id");
        $stmt->bindParam(':id', $Id);
        $stmt->execute();
        console_log("SUCCESFULLY DELETED!");
        echo "Game is verwijderd.";
        echo '<a href="index.php">Terug naar homepagina</a>';
        echo '<br>';
        echo '<br>';
    }
    $conn = null;
}

/*============ Rekenfunctie ===============*/

function CalculateDuration($explaintime, $playtime){
    $explaintime = intval($explaintime);
    $playtime = intval($playtime);

    if (isset($playtime) && isset($playtime) && is_numeric($playtime) && is_numeric($playtime)) {
        $duration= $playtime+ $explaintime;
        return $duration;
    }
}

/*============ Checken op submit ===============*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["submit"])){
        $data= Controle();
        if (isset($data) && empty($data["errors"])) {
            AddCreatedGameToBase($data);
        }
    } elseif(isset($_POST["update"])){
        $data= Controle();
        if (isset($data) && empty($data["errors"])) {
            UpdateGame($data);
        }
    } elseif (isset($_POST["delete"])) {
        console_log($_POST["Id"]);
        $Id= $_POST["Id"];
        Delete($Id);
    }
    
} else {
    console_log("ERROR: INPUT IS DECLINED OR EMPTY");
}
