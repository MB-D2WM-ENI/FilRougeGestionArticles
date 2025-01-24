<?php

namespace App\Controller;

use App\Helper\Session;
use App\Repository\ArticleRepository;
use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Entity\Article;
class ArticleController {

    public function list($page = 1, $search = null, $categorieId = null, $auteurId = null)
    {
        $search = ($search !== null) ? urldecode($search) : null;
        $count = ArticleRepository::count($search, $categorieId, $auteurId);
        $articles = ArticleRepository::findAll((int) $page, $search, $categorieId, $auteurId);
        $categories = CategorieRepository::findAll();
        $auteurs = AuteurRepository::findAll();
        require_once '../templates/article/list.php';
    }

    public function new(): void {
        if (Session::hasRole('lecteur')) {
            header('HTTP/1.0 403 Forbidden');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = [
                'titre' => htmlspecialchars($_POST['titre']),
                'contenu' => htmlspecialchars($_POST['contenu']),
                'categorie_id' => htmlspecialchars($_POST['categorie_id']),
            ];

            if (array_search(false, $article) === false) {
                $article = Article::hydrate($article);
                $article->setAuteurId(json_decode($_SESSION['auteur'], true)['id']);
                ArticleRepository::insert($article);
                header('Location: /article/list');
                exit();
            }
        }
        $categories = CategorieRepository::findAll();
        require_once '../templates/article/new.php';
    }

    public function show($id): void {
        $article = ArticleRepository::findById($id);
        $commentaires = CommentaireRepository::findAllByArticleId($id);
        require_once '../templates/article/show.php';
    }

    public function edit($id): void {
        $article = ArticleRepository::findById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = [
                'id' => $id,
                'titre' => htmlspecialchars($_POST['titre']),
                'contenu' => htmlspecialchars($_POST['contenu']),
                'categorie_id' => htmlspecialchars($_POST['categorie_id']),
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
        $categories = CategorieRepository::findAll();
        require_once '../templates/article/edit.php';
    }

    public function delete($id) {
        ArticleRepository::delete($id);
        header('Location: /article/list');
        exit();
    }
}