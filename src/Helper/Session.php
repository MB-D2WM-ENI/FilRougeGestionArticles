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
}
