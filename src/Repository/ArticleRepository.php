<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Article;
use DateTimeImmutable;

class ArticleRepository {
    public static function findAll(int $page = 1, $search = null, $categorieId = null, $auteurId = null): array {
        $connection = Database::getInstance();
        $searchFilters = '';
        $params = [];
        if ($search) {
            $searchFilters .= " AND (titre LIKE :search OR contenu LIKE :search)";
            $params['search'] = '%' . $search . '%';
        }
        if ($categorieId) {
            $searchFilters .= " AND categorie_id = :categorieId ";
            $params['categorieId'] = $categorieId;
        }
        if ($auteurId) {
            $searchFilters .= " AND auteur_id = :auteurId ";
            $params['auteurId'] = $auteurId;
        }
        $sql = "SELECT * FROM articles WHERE 1=1 $searchFilters LIMIT 10 OFFSET " . (($page - 1) * 10);
        $articles = $connection->query($sql, $params);
        foreach ($articles as $key => $article) {
            $articles[$key] = Article::hydrate($article);
        }
        return $articles;
    }

//    public static function findAllByPage(int $page = 1): array
//    {
//        $connection = Database::getInstance();
//        $sql = "SELECT * FROM articles LIMIT 10 OFFSET " . (($page - 1) * 10);
//        $articles = $connection->query($sql);
//        foreach ($articles as $key => $article) {
//            $articles[$key] = Article::hydrate($article);
//        }
//
//        return $articles;
//    }

    public static function count($search = null, $categorieId = null, $auteurId = null): int {
        $connection = Database::getInstance();
        $searchFilters = '';
        $params = [];
        if ($search) {
            $searchFilters .= " AND (titre LIKE :search OR contenu LIKE :search)";
            $params['search'] = '%' . $search . '%';
        }
        if ($categorieId) {
            $searchFilters .= " AND categorie_id = :categorieId ";
            $params['categorieId'] = $categorieId;
        }
        if ($auteurId) {
            $searchFilters .= " AND auteur_id = :auteurId ";
            $params['auteurId'] = $auteurId;
        }
        $sql = "SELECT COUNT(*) FROM articles WHERE 1=1 $searchFilters";
        $count = $connection->queryOne($sql, $params);
        return $count['COUNT(*)'];
    }

    public static function findById(int $id): Article {
        $connection = Database::getInstance();
        $sql = "SELECT * FROM articles WHERE id = ?";
        $article = $connection->queryOne($sql, [$id]);
        return Article::hydrate($article);
    }

    public static function update(Article $article): void {
        $connection = Database::getInstance();
        $connection->execute(
            "UPDATE articles SET titre = ?, contenu = ?, categorie_id = ? WHERE id = ?",
            [
                $article->getTitre(),
                $article->getContenu(),
                $article->getCategorieId(),
                $article->getId(),
            ]
        );
    }

    public static function delete(int $id) {
        $connection = Database::getInstance();
        $connection->execute(
            "DELETE FROM commentaires WHERE article_id = ?",
            [$id]
        );

        $connection->execute(
            "DELETE FROM articles WHERE id = ?",
            [$id]
        );
    }

    public static function insert(Article $article)
    {
        $connection = Database::getInstance();
        $connection->execute(
            "INSERT INTO articles (titre, contenu, date_publication, auteur_id, categorie_id) VALUES (?, ?, ?, ?, ?)",
            [
                $article->getTitre(),
                $article->getContenu(),
                $article->getDatePublication()->format('Y-m-d H:i:s'),
                $article->getAuteurId(),
                $article->getCategorieId(),
            ]
        );
    }
}
