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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["time-input"]) && isset($_GET["personexplain_input"]) && isset($_GET["personsplay_input"])) {
    console_log("WAAR!");
    if(isset($_GET["submit"])){
        console_log("Geplande spel gepost");
        $time = trimdata($_GET["time-input"]);
        $GM= trimdata($_GET["personexplain_input"]);
        $players= trimdata($_GET["personsplay_input"]);
        console_log("Gecontroleeerd");
        return $time;
        return $GM;
        return $players;
        AddCreatedGameToIndex();
    }
}else{
    console_log("ERROR: INPUT IS DECLINED OR EMPTY");
}

//Check geplande spel is compleet 
function CheckCreateLocation(){
    //controle 
    if(isset($_POST["create_location"]) && $_POST["create_location"] != ""){
        $selected2= trimdata($_POST["create_location"]);
        console_log("SUCCESFULLY CHECKED: " . $selected2);
        return $selected2;
    }else{
        console_log('ERROR: LOCATION IS EMPTY OR IS DECLINED');
    }
}

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
?>