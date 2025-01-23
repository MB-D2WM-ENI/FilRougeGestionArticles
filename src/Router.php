<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\RechercherController;
use App\Controller\AuteurController;
use App\Controller\NotFoundController;

class Router
{
    public function run()
    {
        /*
        Cet extrait de code PHP qui gère les requêtes HTTP entrantes et le routage vers le contrôleur et l'action appropriées en fonction du chemin d'URL. Le code utilise l'expression match introduite dans PHP 8 pour faire correspondre le chemin d'URL à un ensemble de routes prédéfinies.
        La variable $url est définie sur la valeur de la variable $_SERVER['REQUEST_URI'], qui contient le chemin d'URL de la requête entrante. L'expression match fait ensuite correspondre la variable $url à un ensemble de routes prédéfinies à l'aide de l'opérateur =>.
        Si la variable $url correspond à la route /, le HomeController est instancié et sa méthode __invoke() est appelée. Si la variable $url correspond à la route /inscrire, le AuteurController est instancié et sa méthode inscrire() est appelée. Si la variable $url correspond à la route /se-connecter, le AuteurController est instancié et sa méthode seConnecter() est appelée. Si la variable $url ne correspond à aucune des routes prédéfinies, le NotFoundController est instancié et sa méthode __invoke() est appelée.
        Cet extrait de code est une façon concise et lisible de gérer les requêtes HTTP entrantes et de les router vers le contrôleur et l'action appropriée. En utilisant l'expression match, le code est plus concis et plus facile à lire que les instructions if traditionnelles ou les instructions switch.
        Cependant, il convient de noter que cet extrait de code suppose que le chemin d'URL pour chaque route est fixe et ne permet pas de gérer des paramètres dynamiques dans l'URL. Pour gérer des paramètres dynamiques, le code devrait utiliser un système de routage plus avancé ou une expression régulière pour faire correspondre le chemin d'URL. C’est ce que nous verrons dans le TP suivant.
        */
        $url = $_SERVER['REQUEST_URI'];

        match ($url) {
            '/' => (new HomeController())(),
            '/inscrire' => (new AuteurController())->inscrire(),
            '/se-connecter' => (new AuteurController())->seConnecter(),
            default => (new NotFoundController())(),
        };
    }
}
