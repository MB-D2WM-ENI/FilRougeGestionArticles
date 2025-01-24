<?php

namespace App\Entity;

use DateTimeInterface;

class Commentaire
{
    private $id;
    private $contenu;
    private $datePublication;
    private $auteurId;
    private $articleId;
    private $auteur;
    private $article;

    public function __construct()
    {
        $this->datePublication = new \DateTimeImmutable();
    }

    // Getters er Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }
    public function getDatePublication(): DateTimeInterface
    {
        return $this->datePublication;
    }
    public function setDatePublication(DateTimeInterface $datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }
    public function getAuteurId()
    {
        return $this->auteurId;
    }
    public function setAuteurId($auteurId)
    {
        $this->auteurId = $auteurId;

        return $this;
    }
    public function getArticleId()
    {
        return $this->articleId;
    }
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }
    public function getAuteur()
    {
        return $this->auteur;
    }
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }
    public function getArticle()
    {
        return $this->article;
    }
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    public static function hydrate(array $data): Commentaire
    {
        $commentaire = new Commentaire();
        foreach ($data as $key => $value) {
            $key = lcfirst(str_replace('_', '', ucwords($key, '_')));
            $method = 'set' . ucfirst($key);
            if (method_exists($commentaire, $method)) {
                if (in_array($key, ['datePublication'])) {
                    $value = new \DateTimeImmutable($value);
                }
                $commentaire->$method($value);
            }
        }

        return $commentaire;
    }
}
