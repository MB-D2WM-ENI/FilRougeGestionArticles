<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Repository\AuteurRepository;

class AuteurController
{
    public function inscrire()
    {
        /*
            Ce code gère les requêtes HTTP POST entrantes vers la classe AuteurController, et plus précisément vers le méthode inscrire() de cette classe. Le code vérifie d'abord si la méthode de requête est POST en utilisant la variable superglobale $_SERVER["REQUEST_METHOD"]. Si la méthode de requête est POST, le code nettoie et valide les données d'entrée de la requête à l'aide des fonctions htmlspecialchars() et filter_var().
            Les données d'entrée sont stockées dans un tableau associatif appelé $utilisateur, qui contient le prénom, le nom, l'adresse e-mail et le mot de passe de l'utilisateur. La fonction htmlspecialchars() est utilisée pour nettoyer le prénom et le nom de l'utilisateur en convertissant tous les caractères spéciaux en leurs équivalents d'entité HTML. La fonction filter_var() est utilisée pour valider l'adresse e-mail et le mot de passe de l'utilisateur en utilisant les filtres FILTER_VALIDATE_EMAIL et FILTER_VALIDATE_REGEXP, respectivement.
            L'expression régulière utilisée pour valider le mot de passe de l'utilisateur exige qu'il soit d'au moins 8 caractères et contienne au moins une lettre minuscule, une lettre majuscule et un chiffre. Si toutes les données d'entrée sont valides, le code définit la variable $success sur un message de réussite qui inclut le prénom et le nom de l'utilisateur, et supprime le tableau $utilisateur.
            Cet extrait de code est un bon exemple de la façon de gérer les requêtes HTTP POST entrantes et de nettoyer et valider les données d'entrée. En utilisant les fonctions htmlspecialchars() et filter_var(), le code est capable de prévenir les vulnérabilités de sécurité courantes telles que les attaques de script intersite (XSS) et les injections SQL. De plus, en utilisant une expression régulière pour valider le mot de passe de l'utilisateur, le code est capable d'imposer des exigences de mot de passe solides et d'empêcher l'utilisation de mots de passe faibles.
        */
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $auteur = [
                'prenom' => htmlspecialchars($_POST['prenom']),
                'nom' => htmlspecialchars($_POST['nom']),
                'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
                'motDePasse' => filter_var($_POST['motDePasse'], FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/"
                    ]
                ])
            ];

            if (array_search(false, $auteur) === false) {
                $auteur['mot_de_passe'] = password_hash($auteur['motDePasse'], PASSWORD_DEFAULT);
                $auteur = Auteur::hydrate($auteur);
                AuteurRepository::insert($auteur);
                header('Location: /se-connecter');
                exit();
            }
        }

        require_once '../templates/inscrire.php';
    }

    public function seConnecter()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $auteur = [
                'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
                'motDePasse' => htmlspecialchars($_POST['motDePasse']),
            ];

            if (array_search(false, $auteur) === false) {
                $auteur = AuteurRepository::findByEmail($auteur['email']);

                if ($auteur !== null && password_verify($_POST['motDePasse'], $auteur->getMotDePasse())) {
                    $_SESSION['auteur'] = json_encode($auteur);
                    header('Location: /');
                    exit();
                }
            }
            $erreur = "L'adresse email ou le mot de passe est incorrect.";
        }

        require_once '../templates/se-connecter.php';
    }

    public function seDeconnecter()
    {
        session_destroy();
        header('Location: /');
        exit();
    }
}
