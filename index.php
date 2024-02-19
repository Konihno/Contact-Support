<?php

require_once 'autoload.php';
$nameErr = $firstnameErr = $emailErr = $descriptionErr = $fileErr = "";
$name = $firstname = $email = $description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    
    if (empty(trim($_POST["name"]))) {
        $nameErr = "Le nom est requis";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) {
        $nameErr = "Seuls les lettres et les espaces blancs sont autorisés";
        $valid = false;
    } else {
        $name = sanitize_input($_POST["name"]);
    }

    
    if (empty(trim($_POST["firstname"]))) {
        $firstnameErr = "Le prénom est requis";
        $valid = false;
    } else {
        $firstname = sanitize_input($_POST["firstname"]);
    }

    if (empty(trim($_POST["email"]))) {
        $emailErr = "L'adresse email est requise";
        $valid = false;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format d'email invalide";
        $valid = false;
    } else {
        $email = sanitize_input($_POST["email"]);
    }

    if (empty(trim($_POST["description"]))) {
        $descriptionErr = "La description est requise";
        $valid = false;
    } else {
        $description = sanitize_input($_POST["description"]);
    }


    if ($valid) {
        echo "Merci de nous avoir contactés, " . htmlspecialchars($name) . "!";
        $name = $firstname = $email = $description = "";
    }
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['submit'])) {
  $recaptcha = new \ReCaptcha\ReCaptcha('6LfoIHIpAAAAAETWOeQqzDgI1r6uZ2AWp5SaWHOU');
  $gRecaptchaResponse = $_POST['g-recaptcha-response'];
  $resp = $recaptcha->setExpectedHostname('variable.test')
                    ->verify($gRecaptchaResponse, $remoteIp);
  if ($resp->isSuccess()) {
     echo "Captcha valid";
  } else {
      $errors = $resp->getErrorCodes();
      var_dump($errors);
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact Support</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script src="./formValidation.js"></script>
    <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>

</head>
<body>
<div class="container">
    <h1 class="title">Support Client</h1>
    <div id="submitMessage" class="notification is-hidden"></div>

    <form action="submit.php" method="post" enctype="multipart/form-data" id="contactForm">
        <div class="field">
            <label class="label" for="name">Nom :</label>
            <div class="control">
                <input class="input" type="text" id="name" name="name" required minlength="2" maxlength="255">
            </div>
            <!-- <p class="help is-danger"><?= $nameErr ?></p> -->
        </div>

        <div class="field">
            <label class="label" for="firstname">Prénom :</label>
            <div class="control">
                <input class="input" type="text" id="firstname" name="firstname" required minlength="2" maxlength="255">
            </div>
            <!-- <p class="help is-danger"><?= $firstnameErr ?></p> -->
        </div>

        <div class="field">
            <label class="label" for="email">Adresse Email :</label>
            <div class="control">
                <input class="input" type="email" id="email" name="email" required minlength="2" maxlength="255">
            </div>
            <!-- <p class="help is-danger"><?= $emailErr ?></p> -->
        </div>

        <div class="field">
            <label class="label" for="file">Fichier (optionnel) :</label>
            <div class="control">
                <input class="input" type="file" id="file" name="file" accept=".jpg,.png,.gif">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description :</label>
            <div class="control">
                <textarea class="textarea" id="description" name="description" required minlength="2" maxlength="1000"></textarea>
            </div>
            <!-- <p class="help is-danger"><?= $descriptionErr ?></p> -->
        </div>

        <div required class="g-recaptcha" data-sitekey="6LfoIHIpAAAAAETWOeQqzDgI1r6uZ2AWp5SaWHOU" data-action="LOGIN"></div>

        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Envoyer</button>
            </div>
        </div>
    </form>

    <p>Admin? <a href="login.php">Connexion</a></p>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); 
        var formData = new FormData(this); 

        fetch('submit.php', { 
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
            if(data.success) {
                
                var submitMessage = document.getElementById('submitMessage');
                submitMessage.textContent = 'Données soumises avec succès.';
                submitMessage.classList.remove('is-hidden');  
                this.reset();
            }
        })
        .catch(error => {
            document.getElementById('submitMessage').textContent = 'Une erreur est survenue.';
        });
    });
});
</script>
</body>
</html>