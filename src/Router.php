<?php

namespace App;

use App\Controller\AuteurController;
use App\Controller\HomeController;
use App\Controller\NotFoundController;
use App\Controller\ArticleController;
use App\Controller\CommentaireController;

class Router {
    public function run() {
        $url = $_SERVER['REQUEST_URI'];
        $id = preg_match('/^\/article\/\w+\/(\d+)/', $url, $matches) ? $matches[1] : null;
        $page = preg_match('/^\/article\/list\/(\d+)/', $url, $matches) ? $matches[1] : null;
        match ($url) {
            '/' => (new HomeController())(),
            '/inscrire' => (new AuteurController())->inscrire(),
            '/se-connecter' => (new AuteurController())->seConnecter(),
            '/se-deconnecter' => (new AuteurController())->seDeconnecter(),
            '/article/new' => (new ArticleController())->new(),
            '/article/list' => (new ArticleController())->list(),
            sprintf('/article/list/%d', $page) => (new ArticleController())->list($page),
            sprintf('/article/show/%d', $id) => (new ArticleController())->show($id),
            sprintf('/article/edit/%d', $id) => (new ArticleController())->edit($id),
            sprintf('/article/delete/%d', $id) => (new ArticleController())->delete($id),
            sprintf('/article/show/%d/commentaire', $id) => (new CommentaireController())->new($id),
            default => (new NotFoundController())(),
        };
    }
}
