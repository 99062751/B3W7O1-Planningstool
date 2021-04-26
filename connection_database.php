<?php
//console.log om dingen te loggen is makkelijker voor mezelf
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>'; 
    }
    echo $js_code;
}

/*============ Alles met connectie database ===============*/
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

function GetGamesDataFromBase(){
    $conn= connect();

        $stmt = $conn->prepare("SELECT * FROM games");
        $stmt->execute();
        $gameinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $conn = null;
        return $gameinfo;
}

/*============ Geplande data van spel ophalen en in database zetten ===============*/

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["submit"])){
        $CheckInput= Control();
    }
    
} else {
    console_log("ERROR: INPUT IS DECLINED OR EMPTY");
}

function Control(){
    $time = CheckTime($_GET["time"]);
}

function CheckTime($time){
    if(is_numeric($time) && $time < 2400 && $time != ""){
        $explaintime= $_GET["explaintime"];
        CalculateDuration($time, $explaintime);
    } elseif($time > 2400 && $time != ""){
        console_log("ERROR: TIME CAN ONLY BE LESS THAN 24 HOURS");
    }elseif($time == ""){
        console_log("ERROR: TIME IS EMPTY");
    }
    else{
        console_log("ERROR: THIS IS NOT A TIME");
    }
}   

function CalculateDuration($time, $explaintime){
// hier blijft hij nu
    $duration= $time + $explaintime;
    GetAllInfo($duration, $time);
}

//Resultaat ophalen uit database met zelfde id als $id
function Connect_IDS_tobase(){
    $conn= connect();
    $id= $_GET["id"];

    $stmt = $conn->prepare("SELECT * FROM games WHERE id=?");
    $stmt->execute([$id]);
    $gameinfo2 = $stmt->fetch(PDO::FETCH_ASSOC);

    $conn = null;
    return  $gameinfo2;
}

//te doen: spel controleren, spelers controleren
function trimdata(){
    $var= trim($var);
    $var= stripslashes($var);
    $var= htmlspecialchars($var);
    return $var;
}

function GetAllInfo($duration, $time){
    $GameiD= $_GET["GameiD"];
    $GM= $_GET["GameMaster"];
    $players= $_GET["players"];
    AddCreatedGameToBase($duration, $time, $GM, $players, $GameiD);
}

function AddCreatedGameToBase($duration, $time, $GM, $players, $GameiD){
    $conn= connect();
    if(isset($time) && isset($GM) && isset($players)){
        console_log("SUCCESFULLY ADDED: DATA");
        $stmt = $conn->prepare("INSERT INTO `planning`(game, start_time, duration, host, player) VALUES(:game, :start_time, :duration, :host, :players)");
        $stmt->bindParam(':game', $GameiD);
        $stmt->bindParam(':start_time', $time);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':host', $GM);
        $stmt->bindParam(':players', $players);
        $stmt->execute();   
    } else{
        console_log("ERROR: NAME FOR LOCATION IS EMPTY");
    }
    $conn = null;
}    



?>