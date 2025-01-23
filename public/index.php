<?php
/*
    L'instruction require_once est utilisée pour inclure le fichier autoload.php, qui est généré par Composer et contient le code nécessaire pour charger automatiquement les classes et les dépendances de l'application. C'est une pratique courante dans le développement PHP moderne, car elle permet aux développeurs de gérer facilement les dépendances et de maintenir leur code organisé.
    L'instruction use est utilisée pour importer la classe App\Router dans l'espace de noms courant, ce qui permet au code d'utiliser la classe sans avoir à spécifier l'espace de noms complet à chaque fois. C'est une autre pratique courante dans le développement PHP moderne, car elle rend le code plus lisible et plus facile à maintenir.
    La variable $router est ensuite instanciée en tant que nouvelle instance de la classe App\Router, qui est responsable de la gestion des requêtes HTTP entrantes et de leur routage vers le contrôleur et l'action appropriés. La méthode run() est ensuite appelée sur l'instance $router, ce qui lance le processus de routage et renvoie la réponse au client.
    Dans l'ensemble, cet extrait de code est une façon simple et concise de démarrer une application PHP et de gérer les requêtes HTTP entrantes à l'aide d'une classe de routage. En utilisant Composer pour gérer les dépendances et les espaces de noms pour organiser le code, le code est plus facile à maintenir et plus facile à lire.
*/

/*
    On démarre une nouvelle session dans le fichier index.php, le seul accessible depuis notre serveur web. Les sessions en PHP vont nous permettre d’authentifier un utilisateur sur notre application et d’être capable de le suivre d’une page à l’autre.
    On définit une constante appelée __ROOT__ en utilisant la fonction define(). La constante est définie comme le chemin absolu vers le répertoire parent du répertoire courant, qui est obtenu en utilisant la fonction dirname().
    La constante __ROOT__ est généralement utilisée pour définir le chemin de base de l'application, qui peut être utilisé pour inclure des fichiers ou des ressources par rapport au répertoire racine de l'application. En définissant la constante comme le répertoire parent du répertoire courant, le code est capable de référencer des fichiers et des ressources de manière cohérente et portable, indépendamment de l'emplacement du script courant.
    La constante DIRECTORY_SEPARATOR est utilisée pour spécifier le caractère de séparation de répertoire pour le système d'exploitation courant. Cela est nécessaire car différents systèmes d'exploitation utilisent des caractères différents pour séparer les noms de répertoire dans les chemins de fichier. Par exemple, Windows utilise un backslash (\) comme séparateur de répertoire, tandis que les systèmes basés sur Unix utilisent un slash (/).
*/
session_start();

require_once '../vendor/autoload.php';

define('__ROOT__', dirname(__DIR__) . DIRECTORY_SEPARATOR);

use App\Router;

$router = new Router();
$router->run();
