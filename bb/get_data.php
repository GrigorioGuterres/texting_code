<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "administratif_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = $_GET['table'];

if ($table == "posto_administrativo") {
    $municipio_id = $_GET['municipio_id'];
    $sql = "SELECT * FROM posto_administrativo WHERE municipio_id = $municipio_id";
} elseif ($table == "suku") {
    $posto_administrativo_id = $_GET['posto_administrativo_id'];
    $sql = "SELECT * FROM suku WHERE posto_administrativo_id = $posto_administrativo_id";
} elseif ($table == "aldeia") {
    $suku_id = $_GET['suku_id'];
    $sql = "SELECT * FROM aldeia WHERE suku_id = $suku_id";
} else {
    echo json_encode([]);
    exit;
}

$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);
