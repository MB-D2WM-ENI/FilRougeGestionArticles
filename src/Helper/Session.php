<?php

namespace App\Helper;

use App\Entity\Auteur;

class Session {
    public static function getAuteurConnecte(): ?Auteur {
        if (isset($_SESSION['auteur'])) {
            return Auteur::hydrate(json_decode($_SESSION['auteur'], true));
        }
        return null;
    }

    public static function hasRole($role): bool {
        if (isset($_SESSION['auteur'])) {
            $auteur = Auteur::hydrate(json_decode($_SESSION['auteur'], true));
            return $auteur->getRole() === $role;
        }
        return false;
    }
}
