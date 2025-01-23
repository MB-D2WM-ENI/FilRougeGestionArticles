<?php

namespace App\Controller;

class NotFoundController
{
    public function __invoke()
    {
        /*
        Ici, le code d'état de réponse HTTP  est défini à 404 Not Found à l'aide de la fonction header(). Ce code est situé dans la classe NotFoundController, qui est responsable de la gestion des requêtes HTTP entrantes qui ne correspondent à aucune des routes prédéfinies.
        La fonction header() est une fonction PHP intégrée qui permet aux développeurs de définir des en-têtes HTTP pour la réponse en cours. Dans ce cas, la fonction header() est utilisée pour définir le code d'état HTTP à 404 Not Found, qui est le code de réponse standard pour une ressource qui ne peut pas être trouvée sur le serveur.
        En définissant le code d'état HTTP à 404 Not Found, le code est capable d'informer le client que la ressource demandée n'existe pas sur le serveur. Cela est important pour l'optimisation des moteurs de recherche (SEO) et l'expérience utilisateur, car cela permet aux moteurs de recherche et aux utilisateurs d'identifier et de résoudre rapidement les liens cassés ou les ressources manquantes.
        */
        header('HTTP/1.0 404 Not Found');
        require_once '../templates/not-found.php';
    }
}
