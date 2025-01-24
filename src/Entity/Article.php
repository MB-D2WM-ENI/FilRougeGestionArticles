<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;

class Article
{
    private $id;
    private $titre;
    private $contenu;
    private $datePublication;
    private $auteurId;
    private $auteur;
    private $categorie;
    private $categorieId;

    public function __construct()
    {
        $this->datePublication = new \DateTimeImmutable();
    }

    public function getId() {
        return $this->id;
    }

    // Getters et setters
    public function getTitre() {
        return $this->titre;
    }

    public function getContenu() {
        return $this->contenu;
    }
    public function getDatePublication(): DateTimeInterface {
        return $this->datePublication;
    }
    public function getAuteurId() {
        return $this->auteurId;
    }
    public function getAuteur() {
        return $this->auteur;
    }
    public function getCategorie() {
        return $this->categorie;
    }
    public function getCategorieId() {
        return $this->categorieId;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }
    public function setContenu($contenu) {
        $this->contenu = $contenu;
        return $this;
    }
    public function setDatePublication(DateTimeInterface $datePublication) {
        $this->datePublication = $datePublication;
        return $this;
    }
    public function setAuteurId($auteurId) {
        $this->auteurId = $auteurId;
        return $this;
    }
    public function setAuteur($auteur) {
        $this->auteur = $auteur;
        return $this;
    }
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
        return $this;
    }
    public function setCategorieId($categorieId) {
        $this->categorieId = $categorieId;
        return $this;
    }

    //Permet de mapper les données d'un tableau vers un objet PHP
    public static function hydrate(array $data): Article {
        $article = new Article();
        $article->setId($data["id"] ?? null);
        $article->setTitre($data["titre"] ?? null);
        $article->setContenu($data["contenu"] ?? null);
        if (isset($data['date_publication'])) {
            $article->setDatePublication(new DateTimeImmutable($data['date_publication']));
        }
        $article->setAuteurId($data["auteur_id"] ?? null);
        $article->setCategorieId($data['categorie_id'] ?? null);

        return $article;
    }

    public function toArray(): array {
        return [
            "id" => $this->getId(),
            "titre" => $this->getTitre(),
            "contenu" => $this->getContenu(),
            "datePublication" => $this->getDatePublication(),
            "auteurId" => $this->getAuteurId(),
            "auteur" => $this->getAuteur(),
            'categorie_id' => $this->getCategorieId(),
            'categorie' => $this->getCategorie(),
        ];
    }
}