<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$db = "zoo_arcadia";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Fonction pour ajouter un service
function addService($nom, $description) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO services (nom, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $nom, $description);
    $stmt->execute();
    $stmt->close();
}

// Fonction pour récupérer la liste des services
function getServices() {
    global $conn;
    $result = $conn->query("SELECT * FROM services");
    $services = [];

    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }

    return $services;
}
?>
