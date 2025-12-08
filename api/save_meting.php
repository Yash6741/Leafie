<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$vocht = $data["vochtigheidPercentage"];
$mac = $data["potMacAdres"];

$conn = new mysqli("localhost", "root", "password", "website_leafie");

$stmt = $conn->prepare("
    INSERT INTO Meting (vochtigheidPercentage, potMacAdres)
    VALUES (?, ?)
");
$stmt->bind_param("is", $vocht, $mac);
$stmt->execute();

echo json_encode(["status" => "ok"]);
