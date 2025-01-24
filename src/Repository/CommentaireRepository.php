<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Commentaire;
use DateTimeImmutable;

class CommentaireRepository
{
    public static function insert($commentaire)
    {
        $connection = Database::getInstance();
        $connection->execute(
            'INSERT INTO commentaires (contenu, date_publication, auteur_id, article_id) VALUES (:contenu, :date_publication, :auteur_id, :article_id)',
            [
                'contenu' => $commentaire->getContenu(),
                'date_publication' =>  $commentaire->getDatePublication()->format('Y-m-d H:i:s'),
                'auteur_id' => $commentaire->getAuteurId(),
                'article_id' => $commentaire->getArticleId(),
            ]
        );
    }

    public static function findAllByArticleId($articleId)
    {
        $connection = Database::getInstance();
        $sql = "SELECT * FROM commentaires WHERE article_id = ?";
        $commentaires = $connection->query($sql, [$articleId]);
        foreach ($commentaires as $key => $commentaire) {
            $commentaires[$key] = Commentaire::hydrate($commentaire);
        }

        return $commentaires;
    }
}
