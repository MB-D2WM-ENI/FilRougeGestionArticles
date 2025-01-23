<?php

namespace App\Entity;

class Article
{
    private $id;
    private $titre;
    private $contenu;
    private $datePublication;
    private $auteurId;
    private $auteur;

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
    public function getDatePublication() {
        return $this->datePublication;
    }
    public function getAuteurId() {
        return $this->auteurId;
    }
    public function getAuteur() {
        return $this->auteur;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setTitre($titre) {
        $this->titre = $titre;
    }
    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }
    public function setDatePublication($datePublication) {
        $this->datePublication = $datePublication;
    }
    public function setAuteurId($auteurId) {
        $this->auteurId = $auteurId;
    }
    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    //Permet de mapper les données d'un tableau vers un objet PHP
    public static function hydrate(array $data): Article {
        $article = new Article();
        $article->setId($data["id"] ?? null);
        $article->setTitre($data["titre"] ?? null);
        $article->setContenu($data["contenu"] ?? null);
        $article->setDatePublication($data["date_publication"] ?? null);
        $article->setAuteurId($data["auteur_id"] ?? null);

        return $article;
    }

    public function toArray(): array {
        return [
            "id" => $this->getId(),
            "titre" => $this->getTitre(),
            "contenu" => $this->getContenu(),
            "datePublication" => $this->getDatePublication(),
            "auteurId" => $this->getAuteurId(),
            "auteur" => $this->getAuteur()
        ];
    }
}