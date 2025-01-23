<?php

namespace App\Controller;

class HomeController
{
    /*
    Cet extrait de code PHP définit une méthode __invoke() pour la classe HomeController. La méthode __invoke() est une méthode magique en PHP qui permet à un objet d'être appelé comme une fonction. Dans ce cas, la méthode __invoke() est utilisée pour gérer les requêtes HTTP entrantes vers l'URL racine (/) et afficher la page d'accueil de l'application.
    L'instruction require_once est utilisée pour inclure le fichier index.php du répertoire templates, qui contient le balisage HTML et le code PHP pour la page d'accueil de l'application. C'est une pratique courante dans le développement PHP moderne, car elle permet aux développeurs de séparer la logique de présentation (balisage HTML) de la logique d'application (code PHP).
    En définissant la méthode __invoke() pour la classe HomeController, le code est capable de gérer les requêtes HTTP entrantes vers l'URL racine de manière plus modulaire et orientée objet. Cela permet au code d'être plus facile à maintenir et plus facile à lire, car la logique de gestion des requêtes entrantes est encapsulée dans une seule classe.
    */
    public function __invoke()
    {
        require_once '../templates/index.php';
    }
}
