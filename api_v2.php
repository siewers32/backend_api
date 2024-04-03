<?php 
$host = '127.0.0.1';
$db   = 'autoverhuur';
$user = 'web';
$pass = '230mod';
$port = 3306;
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);

if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['Kenteken'])) {
    $stmt = $pdo->prepare("SELECT * from autos");
    $stmt->execute();
    http_response_code(200);
    echo json_encode($stmt->fetchAll());
} 

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Kenteken'])) {
    $stmt = $pdo->prepare("SELECT * from autos where kenteken = :kenteken");
    $stmt->bindParam(":kenteken", $_GET["id"]);
    $stmt->execute();
    http_response_code(200);
    echo json_encode($stmt->fetch());
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $req = readFromInput();
    extract($req);
    $stmt = $pdo->prepare("INSERT INTO autos VALUES (?,?,?,?,?)");
    $stmt->execute([$Kenteken, $Merk, $Type, $DatumAPK, $Kilometerstand]);
    http_response_code(201);
    echo json_encode("record added");
}

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $req = readFromInput();
    extract($req);
    $stmt = $pdo->prepare("UPDATE autos set Kenteken = ?, Merk = ?, Type = ?, DatumAPK = ?, Kilometerstand  = ?");
    $stmt->execute([$Kenteken, $Merk, $Type, $DatumAPK, $Kilometerstand]);
    http_response_code(200);
    echo json_encode("record added");
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $req = readFromInput();
    extract($req);
    $stmt = $pdo->prepare("DELETE from autos where Kenteken = ?");
    $stmt->execute([$Kenteken]);
    http_response_code(200);
    echo json_encode("record met kenteken ".$Kenteken." is verwijderd");
}


function readFromInput()
{
    $pre = file_get_contents('php://input');
    parse_str(trim($pre, "\""), $req);
    return $req;
}