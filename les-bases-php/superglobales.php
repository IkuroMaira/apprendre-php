<?php
/**
 * COURS PHP AVANCÉ - INCLUSIONS, SUPERGLOBALES ET SÉCURITÉ
 *
 * Dans ce cours, nous allons explorer :
 * - Les méthodes d'inclusion de fichiers
 * - Les variables superglobales en détail
 * - La gestion des formulaires
 * - La sécurisation des données
 */

// =============================================
// 1. MÉTHODES D'INCLUSION DE FICHIERS
// =============================================

/*
Il existe quatre fonctions principales pour inclure des fichiers en PHP :
- include     : Inclut et évalue le fichier spécifié
- require     : Même chose que include mais génère une erreur fatale si le fichier n'existe pas
- include_once: Comme include mais vérifie si le fichier a déjà été inclus
- require_once: Comme require mais vérifie si le fichier a déjà été inclus
*/

// Exemple de structure de projet
/*
mon_site/
    ├── config/
    │   └── database.php
    ├── includes/
    │   ├── header.php
    │   └── footer.php
    └── index.php
*/

// Inclusion du fichier header.php (s'il n'existe pas, le script continue)
include 'includes/header.php';

// Inclusion du fichier de configuration (s'il n'existe pas, erreur fatale)
require 'config/database.php';

// Inclusion unique de bibliothèques
require_once 'lib/functions.php';

// Bonnes pratiques pour les chemins d'inclusion
$root = __DIR__; // Utilisation d'une constante magique pour le chemin absolu
require_once $root . '/config/database.php';

// =============================================
// 2. LES SUPERGLOBALES EN DÉTAIL
// =============================================

/**
 * $_GET : Récupération des données de l'URL
 *
 * Exemple d'URL : mapage.php?nom=Dupont&age=25&ville=Paris
 * Les paramètres sont visibles dans l'URL et séparés par &
 */

// Récupération sécurisée des données GET
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$age = isset($_GET['age']) ? intval($_GET['age']) : 0;
$ville = filter_input(INPUT_GET, 'ville', FILTER_SANITIZE_STRING);

echo "<h3>Données GET :</h3>";
echo "Nom: $nom<br>";
echo "Age: $age<br>";
echo "Ville: $ville<br>";

/**
 * $_POST : Récupération des données de formulaire
 *
 * Les données POST ne sont pas visibles dans l'URL
 * Utilisé pour les données sensibles et les grands volumes de données
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération sécurisée des données POST
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    echo "<h3>Données POST reçues :</h3>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Message: " . htmlspecialchars($message) . "<br>";
}

/**
 * $_SESSION : Stockage de données côté serveur
 *
 * Les sessions permettent de conserver des données entre les pages
 * Très utile pour l'authentification et les préférences utilisateur
 */

// Démarrage ou reprise de la session
session_start();

// Stockage de données en session
$_SESSION['user_id'] = 123;
$_SESSION['user_name'] = "John Doe";
$_SESSION['is_logged'] = true;

// Utilisation des données de session
echo "<h3>Données de session :</h3>";
if (isset($_SESSION['user_name'])) {
    echo "Utilisateur connecté : " . htmlspecialchars($_SESSION['user_name']) . "<br>";
}

// Suppression d'une variable de session
unset($_SESSION['temporary_data']);

// Destruction complète de la session
// session_destroy(); // Décommentez pour détruire la session

/**
 * $_COOKIE : Stockage de données côté client
 *
 * Les cookies sont stockés sur l'ordinateur de l'utilisateur
 * Utiles pour les préférences et le tracking
 */

// Création d'un cookie (nom, valeur, expiration, chemin)
setcookie(
    "theme",                     // Nom du cookie
    "dark",                      // Valeur
    time() + (86400 * 30),      // Expiration dans 30 jours
    "/",                         // Chemin sur le serveur
    "",                         // Domaine
    true,                       // Secure (HTTPS uniquement)
    true                        // HttpOnly (non accessible en JavaScript)
);

// Lecture d'un cookie
$theme = isset($_COOKIE['theme']) ? htmlspecialchars($_COOKIE['theme']) : 'light';
echo "<h3>Préférences utilisateur :</h3>";
echo "Thème choisi : $theme<br>";

// Suppression d'un cookie
setcookie("theme", "", time() - 3600);

// =============================================
// 3. EXEMPLE PRATIQUE : FORMULAIRE SÉCURISÉ
// =============================================
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de contact</title>
</head>
<body>
<h2>Formulaire de contact</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div>
        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea>
    </div>

    <!-- Protection CSRF -->
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] = bin2hex(random_bytes(32)); ?>">

    <button type="submit">Envoyer</button>
</form>

<?php
// Traitement du formulaire avec sécurisation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du token CSRF
    if (!isset($_POST['token']) || !isset($_SESSION['token']) || $_POST['token'] !== $_SESSION['token']) {
        die("Erreur de sécurité : token CSRF invalide");
    }

    // Nettoyage et validation des données
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div style='color: red;'>Erreur : email invalide</div>";
    } else {
        // Traitement des données...
        echo "<div style='color: green;'>Message envoyé avec succès !</div>";
    }
}

/**
 * EXERCICES PRATIQUES :
 *
 * 1. Créez une page de connexion qui utilise les sessions pour garder
 *    l'utilisateur connecté
 *
 * 2. Développez un système de préférences utilisateur avec des cookies
 *    (thème, langue, etc.)
 *
 * 3. Créez un formulaire d'inscription qui :
 *    - Valide les données côté serveur
 *    - Stocke les informations en session
 *    - Affiche un message de confirmation
 *
 * 4. Créez un mini-site avec plusieurs pages qui partagent un header
 *    et un footer inclus avec require_once
 */
?>

</body>
</html>