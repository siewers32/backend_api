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

if ($_GET["q"] == 'all') {
    $stmt = $pdo->prepare("SELECT * from autos");
    $stmt->execute();
    http_response_code(200);
    echo json_encode($stmt->fetchAll());
}

if ($_GET["q"] == 'search') {
    $stmt = $pdo->prepare("SELECT * from autos where kenteken = :kenteken");
    $stmt->bindParam(":kenteken", $_POST["Kenteken"]);
    $stmt->execute();
    http_response_code(200);
    echo json_encode($stmt->fetch());
}

if ($_GET["q"] == 'create') {
    extract($_POST);
    $stmt = $pdo->prepare("INSERT INTO autos VALUES (?,?,?,?,?)");
    $stmt->execute([$Kenteken, $Merk, $Type, $DatumAPK, $Kilometerstand]);
    http_response_code(201);
    echo json_encode("record added");
}

if ($_GET["q"] == 'update') {
    extract($_POST);
    $stmt = $pdo->prepare("UPDATE autos set Kenteken = ?, Merk = ?, Type = ?, DatumAPK = ?, Kilometerstand  = ? where Kenteken = ?");
    $stmt->execute([$Kenteken, $Merk, $Type, $DatumAPK, $Kilometerstand, $Kenteken]);
    http_response_code(200);
    echo json_encode("record updated");
}

if ($_GET["q"] == 'delete') {
    extract($_POST);
    $stmt = $pdo->prepare("DELETE from autos where Kenteken = ?");
    $stmt->execute([$Kenteken]);
    http_response_code(200);
    echo json_encode("record met kenteken " . $Kenteken . " is verwijderd");
}
