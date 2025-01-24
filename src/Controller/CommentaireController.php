<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use App\Entity\Commentaire;

class CommentaireController
{
    public function new(int $articleId): void {
        $article = ArticleRepository::findById($articleId);
        $commentaires = CommentaireRepository::findAllByArticleId($articleId);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $commentaire = [
                'contenu' => htmlspecialchars($_POST['contenu']),
            ];

            if (array_search(false, $commentaire) === false) {
                $commentaire = Commentaire::hydrate($commentaire);
                $commentaire->setAuteurId(json_decode($_SESSION['auteur'], true)['id']);
                $commentaire->setArticleId($articleId);
                CommentaireRepository::insert($commentaire);
                header('Location: /article/show/' . $articleId);
                exit();
            }
        }


        require_once '../templates/article/show.php';
    }
}
