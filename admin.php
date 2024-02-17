<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$dbHost = '';
$dbName = '';
$dbUsername = '';
$dbPassword = '';
$dsn = "mysql:host=$dbHost;dbname=$dbName";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
    $stmt = $pdo->query("SELECT * FROM user");

    echo "<h2>Liste des contacts</h2>";
    echo "<table>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Description</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>".htmlspecialchars($row['Name'])."</td><td>".htmlspecialchars($row['Firstname'])."</td><td>".htmlspecialchars($row['Email Adress'])."</td><td>".htmlspecialchars($row['Description'])."</td></tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

echo '<p><a href="logout.php">Se déconnecter</a></p>';
?>