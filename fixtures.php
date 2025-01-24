<?php

use App\Database\Database;
use App\Repository\ArticleRepository;
use App\Repository\AuteurRepository;

require_once 'vendor/autoload.php';
define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

Database::getInstance()->execute('DELETE FROM `commentaires`');
Database::getInstance()->execute('DELETE FROM `articles`');
Database::getInstance()->execute('DELETE FROM `auteurs`');
Database::getInstance()->execute('DELETE FROM `categories`');
Database::getInstance()->execute('ALTER TABLE commentaires AUTO_INCREMENT = 1');
Database::getInstance()->execute('ALTER TABLE articles AUTO_INCREMENT = 1');
Database::getInstance()->execute('ALTER TABLE auteurs AUTO_INCREMENT = 1');
Database::getInstance()->execute('ALTER TABLE categories AUTO_INCREMENT = 1');

if (($handle = fopen("fixtures/auteurs.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",",'"', "\\")) !== FALSE) {
        $num = count($data);
        $auteur = new \App\Entity\Auteur();
        $auteur->setId($data[0]);
        $auteur->setNom($data[1]);
        $auteur->setPrenom($data[2]);
        $auteur->setEmail($data[3]);
        $auteur->setMotDePasse($data[4]);
        $auteur->setRole($data[5]);
        AuteurRepository::insert($auteur);
    }
    fclose($handle);
}

if (($handle = fopen('fixtures/categories.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ',','"', "\\")) !== FALSE) {
        $num = count($data);
        $categorie = new \App\Entity\Categorie();
        $categorie->setId($data[0]);
        $categorie->setTitre($data[1]);
        \App\Repository\CategorieRepository::insert($categorie);
    }
    fclose($handle);
}

if (($handle = fopen("fixtures/articles.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",",'"', "\\")) !== FALSE) {
        $num = count($data);
        $article = new \App\Entity\Article();
        $article->setId($data[0]);
        $article->setTitre($data[1]);
        $article->setContenu($data[2]);
        $article->setDatePublication(new DateTimeImmutable($data[3]));
        $article->setAuteurId($data[4]);
        $article->setCategorieId(rand(1, 5));
        ArticleRepository::insert($article);
    }
    fclose($handle);
}

if (($handle = fopen("fixtures/commentaires.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",",'"', "\\")) !== FALSE) {
        $num = count($data);
        $commentaire = new \App\Entity\Commentaire();
        $commentaire->setId($data[0]);
        $commentaire->setContenu($data[1]);
        $commentaire->setDatePublication(new DateTimeImmutable($data[2]));
        $commentaire->setAuteurId($data[3]);
        $commentaire->setArticleId($data[4]);
        \App\Repository\CommentaireRepository::insert($commentaire);
    }
    fclose($handle);
}
