<?php

namespace App\Entity;

class Categorie {
    private $id;
    private $titre;


    public function __toString() {
        return $this->getTitre();
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function getTitre() {
        return $this->titre;
    }
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    public static function hydrate(array $data): Categorie {
        $categorie = new Categorie();
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists(Categorie::class, $method)) {
                $categorie->$method($value);
            }
        }
        return $categorie;
    }
}
