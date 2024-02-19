[https://konihno.000web]
(https://konihno.000webhostapp.com/)
# Projet Support Client

Ce projet est une application web de support client. Il permet aux utilisateurs de soumettre des demandes de support via un formulaire de contact.

## Fonctionnalités

- Formulaire de contact avec validation côté client et côté serveur
- Enregistrement des demandes de support dans une base de données
- Téléchargement de fichiers optionnel avec chaque demande de support
- Protection contre les spams avec Google reCAPTCHA

## Installation

1. Clonez ce dépôt sur votre serveur local ou votre environnement de développement.

2. Installez les dépendances PHP avec Composer :

    ```
    composer install
    ```

3. Créez une base de données MySQL et importez le schéma à partir du fichier `database.sql`.

4. Configurez vos informations de base de données dans le fichier `submit.php`.

5. Lancez votre serveur PHP et ouvrez l'application dans votre navigateur.

## Utilisation

Ouvrez l'application dans votre navigateur. Vous devriez voir un formulaire de contact. Remplissez le formulaire et cliquez sur "Envoyer" pour soumettre une demande de support.

## Support

Si vous rencontrez des problèmes avec cette application, veuillez ouvrir un problème sur GitHub.
