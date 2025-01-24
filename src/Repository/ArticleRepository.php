<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Article;
use DateTimeImmutable;

class ArticleRepository
{
    public static function findAll(): array
    {
        $connection = Database::getInstance();
        $sql = "SELECT * FROM articles";
        $articles = $connection->query($sql);
        foreach ($articles as $key => $article) {
            $articles[$key] = Article::hydrate($article);
        }

        return $articles;
    }

    public static function findAllByPage(int $page = 1): array
    {
        $connection = Database::getInstance();
        $sql = "SELECT * FROM articles LIMIT 10 OFFSET " . (($page - 1) * 10);
        $articles = $connection->query($sql);
        foreach ($articles as $key => $article) {
            $articles[$key] = Article::hydrate($article);
        }

        return $articles;
    }

    public static function count(): int
    {
        $connection = Database::getInstance();
        $sql = "SELECT COUNT(*) FROM articles";
        $count = $connection->queryOne($sql);
        return $count['COUNT(*)'];
    }

    public static function findById(int $id): Article
    {
        $connection = Database::getInstance();
        $sql = "SELECT * FROM articles WHERE id = ?";
        $article = $connection->queryOne($sql, [$id]);
        return Article::hydrate($article);
    }

    public static function update(Article $article)
    {
        $connection = Database::getInstance();
        $connection->execute(
            "UPDATE articles SET titre = ?, contenu = ? WHERE id = ?",
            [
                $article->getTitre(),
                $article->getContenu(),
                $article->getId(),
            ]
        );
    }

    public static function delete(int $id)
    {
        $connection = Database::getInstance();
        $connection->execute(
            "DELETE FROM articles WHERE id = ?",
            [$id]
        );
    }

    public static function insert(Article $article)
    {
        $connection = Database::getInstance();
        $connection->execute(
            "INSERT INTO articles (titre, contenu, date_publication, auteur_id) VALUES (?, ?, ?, ?)",
            [
                $article->getTitre(),
                $article->getContenu(),
                (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                $article->getAuteurId(),
            ]
        );
    }
}
