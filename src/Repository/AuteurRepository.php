<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Auteur;

class AuteurRepository {
    public static function insert(Auteur $auteur) {
        $connection = Database::getInstance();
        $connection->execute(
            "INSERT INTO auteurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)",
            [
                $auteur->getNom(),
                $auteur->getPrenom(),
                $auteur->getEmail(),
                $auteur->getMotDePasse(),
            ]
        );
    }

    public static function findByEmail(string $email): ?Auteur {
        $connection = Database::getInstance();
        $auteur = $connection->queryOne(
            "SELECT * FROM auteurs WHERE email = ?",
            [$email]
        );
        if ($auteur === false) {
            return null;
        }
        return Auteur::hydrate($auteur);
    }

    public static function findById(int $id): ?Auteur {
        $connection = Database::getInstance();
        $auteur = $connection->queryOne(
            "SELECT * FROM auteurs WHERE id = ?",
            [$id]
        );
        if ($auteur === false) {
            return null;
        }
        return Auteur::hydrate($auteur);
    }
}
