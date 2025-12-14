<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "dao/MovieDao.php";

//Dao do fimes
$movieDao = new MovieDAO($conn, BASE_URL);
//Resgata busca do usuario
$q = filter_input(INPUT_GET, "q");
$movies = $movieDao->findByTitle($q);
?>
<div id="main-container" class="container-fluid">
    <!-- TODOS OS FILMES -->
    <h2 class="section-title">Você está buscando por: <span class="search-result"><?= $q ?> </span></h2>
    <p class="section-description">Resultado de sua pesquisa.</p>
    <div class="movies-container">
        <?php if (count($movies) === 0): ?>
            <p class="empty-list">Nenhum filme foi encontrado. <a href="<?php BASE_URL ?>index.php" class="btn btn-outline-light px-2">Voltar</a> ao catalago.</p>
        <?php else: ?>
            <?php foreach ($movies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php"  ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>