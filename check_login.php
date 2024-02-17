<?php
session_start(); 

$myUsername = ''; 
$myPasswordHash = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $myUsername && password_verify($password, $myPasswordHash)) {
        $_SESSION['loggedin'] = true; 
        header("Location: admin.php"); 
        exit;
    } else {
        
        $_SESSION['error'] = "Identifiants incorrects";
        header("Location: login.php"); 
        exit;
    }
} else {
    
    header("Location: login.php");
    exit;
}
?>