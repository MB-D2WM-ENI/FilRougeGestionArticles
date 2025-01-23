<div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto d-flex">
        <li class="nav-item <?= in_array($_SERVER['REQUEST_URI'], ['/', '/index.php']) ? 'active' : '' ?>">
            <a class="nav-link <?= in_array($_SERVER['REQUEST_URI'], ['/', '/index.php']) ? 'active' : '' ?>" href="/" aria-current="page">Accueil</a>
        </li>
        <li class="nav-item <?= $_SERVER['REQUEST_URI'] === '/inscrire' ? 'active' : '' ?>">
            <a class="nav-link  <?= $_SERVER['REQUEST_URI'] === '/inscrire' ? 'active' : '' ?>" href="/inscrire">S'inscrire</a>
        </li>
        <?php if (\App\Helper\Session::getAuteurConnecte() !== null) : ?>
            <li class="nav-item <?= preg_match('/^\/article/', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>">
                <a class="nav-link  <?= preg_match('/^\/article/', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>" href="/article/list">Articles</a>
            </li>
        <?php endif; ?>
    </ul>
    <span class="navbar-text d-block w-100">
        <?php if (\App\Helper\Session::getAuteurConnecte() === null) : ?>
            <a class="nav-link float-lg-end" href="/se-connecter">Se connecter <i class="bi bi-person-circle"></i></a>
        <?php else : ?>
            <a class="nav-link float-lg-end" href="/se-deconnecter">Se déconnecter ( <?= \App\Helper\Session::getAuteurConnecte()->getEmail() ?> ) <i class="bi bi-person-circle"></i></a>
        <?php endif; ?>
    </span>
</div>