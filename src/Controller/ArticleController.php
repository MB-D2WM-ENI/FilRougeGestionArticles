<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Entity\Article;
class ArticleController {

    public function list() {
        $articles = ArticleRepository::findAll();
        require_once '../templates/article/list.php';
    }

    public function new() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = [
                'titre' => htmlspecialchars($_POST['titre']),
                'contenu' => htmlspecialchars($_POST['contenu']),
            ];

            if (array_search(false, $article) === false) {
                $article = Article::hydrate($article);
                $article->setAuteurId(json_decode($_SESSION['auteur'], true)['id']);
                ArticleRepository::insert($article);
                header('Location: /article/list');
                exit();
            }
        }
        require_once '../templates/article/new.php';
    }

    public function show($id) {
        $article = ArticleRepository::findById($id);
        require_once '../templates/article/show.php';
    }

    public function edit($id) {
        $article = ArticleRepository::findById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = [
                'id' => $id,
                'titre' => htmlspecialchars($_POST['titre']),
                'contenu' => htmlspecialchars($_POST['contenu']),
            ];
            if (array_search(false, $article) === false) {
                $article = Article::hydrate($article);
                ArticleRepository::update($article);
                header('Location: /article/list');
                exit();
            }
        }
        if ($article instanceof Article) {
            $article = $article->toArray();
        }
        require_once '../templates/article/edit.php';
    }

    public function delete($id) {
        ArticleRepository::delete($id);
        header('Location: /article/list');
        exit();
    }
}