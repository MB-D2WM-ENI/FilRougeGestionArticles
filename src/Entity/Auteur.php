<?php

namespace App\Entity;

use JsonSerializable;

class Auteur implements JsonSerializable {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;

    public function __toString() {
        return $this->getPrenom() . ' ' . $this->getNom();
    }

   // Getters et Setters
    public function getMotDePasse() {
        return $this->motDePasse;
    }
    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
        return $this;
    }
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public static function hydrate(array $data) {
        $auteur = new Auteur();
        $auteur->setId($data['id'] ?? null);
        $auteur->setNom($data['nom'] ?? null);
        $auteur->setPrenom($data['prenom'] ?? null);
        $auteur->setEmail($data['email'] ?? null);
        $auteur->setMotDePasse($data['mot_de_passe'] ?? null);

        return $auteur;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'email' => $this->getEmail(),
        ];
    }
}
