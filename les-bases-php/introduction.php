<?php

/**
 * COURS PHP - LES BASES
 * Ce fichier contient les notions fondamentales du PHP pour débutants
 *
 * Pour exécuter ce fichier :
 * 1. Placez-le dans le dossier de votre serveur web (ex: htdocs pour XAMPP et MAMP)
 *    Pour savoir comment installer XAMPP/MAMP et faire fonctionner tout ça : https://brotion-gwenaelle.notion.site/Installation-n-cessaire-2d6907323e144139bb47381dc56410fc?pvs=4
 * 2. Accédez-y via votre navigateur (ex: http://localhost/le_nom_du_fichier.php pour XAMPP et http://localhost:8888/le_nom_du_du_fichier.php pour MAMP)
 */

// ========================================
// 1. LES COMMENTAIRES EN PHP
// ========================================

// Ceci est un commentaire sur une ligne
// Utilisez // pour des commentaires courts

/*
   Ceci est un commentaire
   sur plusieurs lignes
   Utilisez / * * /
    pour des explications plus longues
*/

// Les commentaires sont ignorés par PHP lors de l'exécution
// Ils servent à documenter votre code pour vous et les autres développeurs

// ========================================
// 2. LES VARIABLES
// ========================================

// Une variable commence toujours par $
// Le nom peut contenir des lettres, chiffres et underscore (_)
// Mais doit commencer par une lettre ou underscore

$maPremiereVariable = "Bonjour !"; // Type string (chaîne de caractères)
echo "Affichage de ma variable : " . $maPremiereVariable . "<br>"; // Les points servent à la concaténation

// ========================================
// 3. LES TYPES DE VARIABLES
// ========================================

// String (chaîne de caractères)
$prenom = "Marie";
$nom = 'Dupont'; // Les guillemets simples ou doubles fonctionnent

// Integer (nombre entier)
$age = 25;

// Float (nombre décimal)
$taille = 1.75;

// Boolean (vrai/faux)
$estEtudiant = true;
$estDiplome = false;

// Array (tableau)
$fruits = array("pomme", "poire", "banane");
// Ou notation courte :
$legumes = ["carotte", "poireau", "tomate"];

// Null
$variableVide = null;

// Affichage des types
echo "Type de \$prenom : " . gettype($prenom) . "<br>";
echo "Type de \$age : " . gettype($age) . "<br>";
echo "Type de \$taille : " . gettype($taille) . "<br>";
echo "Type de \$estEtudiant : " . gettype($estEtudiant) . "<br>";
echo "Type de \$fruits : " . gettype($fruits) . "<br>";

// ========================================
// 4. LES CONSTANTES
// ========================================

// Définition d'une constante (nom en MAJUSCULES par convention)
// Ancienne façon d'écrire une constante
define("MA_CONSTANTE", "Valeur qui ne changera pas");
// Ou depuis PHP 7
const AUTRE_CONSTANTE = "Autre valeur fixe";

// Les constantes n'ont pas de $ et ne peuvent pas être modifiées
echo AUTRE_CONSTANTE . "<br>";

// ========================================
// 5. LES CONSTANTES PRÉDÉFINIES
// ========================================

// PHP propose de nombreuses constantes prédéfinies
echo "Version de PHP : " . PHP_VERSION . "<br>";
echo "Système d'exploitation : " . PHP_OS . "<br>";
echo "Séparateur de dossier : " . DIRECTORY_SEPARATOR . "<br>";

// ========================================
// 6. LES FONCTIONS
// ========================================

// Définition d'une fonction simple
function direBonjour()
{
    echo "Bonjour tout le monde !<br>";
}

// Fonction avec paramètre
function direMessage($message)
{
    echo $message . "<br>";
}

// Fonction avec paramètres et valeur par défaut
function calculerSomme($a = 0, $b = 0)
{
    return $a + $b;
}

// Appel des fonctions
direBonjour();
direMessage("Comment allez-vous ?");
$resultat = calculerSomme(5, 3);
echo "5 + 3 = " . $resultat . "<br>";

// ========================================
// 7. LES CONDITIONS
// ========================================

// If ... else
$heure = 14;

if ($heure < 12) {
    echo "C'est le matin<br>";
} elseif ($heure < 18) {
    echo "C'est l'après-midi<br>";
} else {
    echo "C'est le soir<br>";
}

// Switch
$jour = "mardi";

switch ($jour) {
    case "lundi":
        echo "Début de semaine<br>";
        break;
    case "mardi":
    case "mercredi":
    case "jeudi":
        echo "Milieu de semaine<br>";
        break;
    case "vendredi":
        echo "Fin de semaine<br>";
        break;
    default:
        echo "C'est le weekend !<br>";
}

// Opérateur ternaire (condition sur une ligne)
$age = 20;
$statut = ($age >= 18) ? "majeur" : "mineur";
echo "Statut : " . $statut . "<br>";

/**
 * EXERCICES SUGGÉRÉS :
 *
 * 1. Créez une variable avec votre nom et affichez-la
 * 2. Créez un tableau avec vos couleurs préférées
 * 3. Écrivez une fonction qui prend un nombre en paramètre et retourne son carré
 * 4. Écrivez une condition qui vérifie si un nombre est positif, négatif ou nul
 */