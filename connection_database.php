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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    console_log("WAAR!");
    if(isset($_GET["submit"])){
        console_log("WAAROM!");
        $CheckInput= Control();
        AddCreatedGameToIndex($time,$GM,$players);
    }
    
} else {
    console_log("ERROR: INPUT IS DECLINED OR EMPTY");
}
function Control(){
    console_log("WAARHEEN!");
    $time = trimdata($_GET["time"]);
    $GM= trimdata($_GET["GameMaster"]);
    $players= trimdata($_GET["players"]);
    return $time;
    return $GM;
    return $players;
}

//te doen: database maken, spel controleren, spelers controleren, tijd controleren, duration berekenen
// voor database id primaire sleutel en unieke waarde.
function trimdata($var){
    $var= trim($var);
    $var= stripslashes($var);
    $var= htmlspecialchars($var);
    return $var;
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

function AddCreatedGameToIndex($time,$GM,$players){
    console_log("UITJE");
}
?>