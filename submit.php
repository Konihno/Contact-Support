<?php
header('Content-Type: application/json'); 

$dbHost = ''; 
$dbName = '';
$dbUsername = '';
$dbPassword = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $fileName = null; 

    
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide";
    }

    
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '/storage/ssd2/411/21870411/uploads/';
        $fileName = basename($_FILES['file']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            
        } else {
            $errors[] = "Erreur lors du téléchargement du fichier";
            $fileName = null;
        }
    }

    
    if (empty($errors)) {
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO user (Name, Firstname, `Email Adress`, Description, File) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $firstname, $email, $description, $fileName]);

            echo json_encode(["success" => true]); 
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => "Impossible de se connecter à la base de données"]); 
        }
    } else {
        echo json_encode(["success" => false, "errors" => $errors]); 
    }
}
?>