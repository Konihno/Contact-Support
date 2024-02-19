<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>
<body>
<div class="container">
    <h1 class="title">Connexion Admin</h1>
    <form action="check_login.php" method="post">
        <div class="field">
            <label class="label" for="username">Utilisateur :</label>
            <div class="control">
                <input class="input" type="text" id="username" name="username" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="password">Mot de passe :</label>
            <div class="control">
                <input class="input" type="password" id="password" name="password" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Se connecter</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
