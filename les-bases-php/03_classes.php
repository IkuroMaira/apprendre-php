<?php

// ========================================
// 1. DÉCLARER UNE CLASSE
// ========================================

// Pour déclarer une classe on utilise le mot clé class. Il est suivi par le nom que l'on souhaite lui attribuer et une paire d'accolade.
class myClass
{
    // Les propriétés de la classe et les méthodes seront ici.
}

// Après avoir créé la classe, un nouvel objet peut être "instancié" depuis cette classe et sera stocké quand une variable en utilisant le mot "new".
$obj = new myClass;

var_dump($obj);

// ========================================
// 2. LES PROPRIÉTÉS D'UNE CLASSE
// ========================================

// Pour ajouter des données à une classe, on utilise des propriétés. En fait, ce sont des variables comme les autres.
// Mais pour bien les différencier des variables hors class, on les appelle propriétés, et on ne peut y accéder qu'en utilisant les objets.
// Les propriétés permettent de définir notre objet.
class MyClassAvecProp
{
    public $prop1 = "Je suis la propriété de la classe MyClasse";
}

$obj = new MyClassAvecProp;

var_dump($obj);
//echo "<br>";
echo $obj -> prop1;

// ========================================
// 2. LES MÉTHODES D'UNE CLASSE
// ========================================

// Les d'une classe sont en fait de simples fonctions, mais qu'on utilise dans des classes.
// Elles ne sont donc accéssible que via la classe dans laquelle elles appartiennent.
// Ce sont des fonctions qui pourront être exécutées depuis l'objet créé.

class MyClassAvecProp
{
    // Propriété
    public $prop1 = "Je suis la propriété de la classe MyClasse";

    // Méthode
    public function setProperty()
    {
        // action
    }
}

$obj = new MyClassAvecProp;

var_dump($obj);
echo $obj -> prop1;

// ========================================
// 3. ACCESSIBILITÉ
// ========================================

//Chaque propriété et méthode à un niveau d’accessibilité défini avec la classe :

//- private : la propriété ne sera accessible et modifiable qu’au sein de sa classe et nul part ailleurs
//- public : la propriété de l’objet sera accessible et modifiable même en-dehors de la classe
//- protected : la propriété ne sera accessible et modifiable qu’au sein même de la classe et également depuis ses classes filles (notion d’héritage)

class MyClassAvecProp
{
    // Propriétés
    public $prop1 = "Je suis la propriété de la classe MyClasse";
    protected $prop2 = "Je suis la propriété protected";
    private $prop3 = "Je suis la proprité private";

}

$obj = new MyClassAvecProp;

var_dump($obj);
echo $obj -> prop1;

// ========================================
// *. MISES EN PRATIQUE
// ========================================

// EXO 1
// On créé nos classes
class Film
{
    public $titre;
    public $date;
    public $realisatrice;
}

class Realisatrice
{
    public $fistName;
    public $lastName;
    public $birthYear;
}

//// Puis on créé un fonction qui affiche nos objets/nos films
//function montrerLeFilm(film: Film)
//{
//    echo $titre ;
//}
//
//// On instancie un nouvel objet avec des valeurs définies
//$anatomy = Film($titre: "Anatomie d'une chute", $date: "2023", $realisatrice)