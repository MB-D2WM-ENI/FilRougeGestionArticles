<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Categorie;

class CategorieRepository {
    public static function insert(Categorie $categorie): void {
        $connection = Database::getInstance();
        $connection->execute(
            "INSERT INTO categories (titre) VALUES (?)",
            [
                $categorie->getTitre(),
            ]
        );
    }

    public static function findAll(): array {
        $connection = Database::getInstance();
        $sql = "SELECT * FROM categories";
        $categories = $connection->query($sql);
        foreach ($categories as $key => $categorie) {
            $categories[$key] = Categorie::hydrate($categorie);
        }

        return $categories;
    }

    public static function findById(int $id): ?Categorie {
        $connection = Database::getInstance();
        $categorie = $connection->queryOne(
            "SELECT * FROM categories WHERE id = ?",
            [$id]
        );
        if ($categorie === false) {
            return null;
        }

        return Categorie::hydrate($categorie);
    }
}
