<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


include("db.php");

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Vérifie que les champs ne sont pas vides
if (empty($email) || empty($password)) {
    echo json_encode(["status" => "fail", "message" => "Champs manquants"]);
    exit;
}

// Prépare et exécute la requête SQL
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Analyse le résultat
if ($result && $result->num_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Connexion réussie"]);
} else {
    echo json_encode(["status" => "fail", "message" => "Email ou mot de passe incorrect"]);
}
?>
