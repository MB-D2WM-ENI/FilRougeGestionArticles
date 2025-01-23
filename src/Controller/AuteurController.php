<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Repository\AuteurRepository;

class AuteurController {
    public function inscrire()
    {
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

    public function seDeconnecter() {
        session_destroy();
        header('Location: /');
        exit();
    }
}
