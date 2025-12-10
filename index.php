<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "dao/MovieDao.php";

//Dao do fimes
$movieDao = new MovieDAO($conn, BASE_URL);

$lastesMovies = $movieDao->getLatesMovies();
$actionMovies = $movieDao->getMoviesCategory("Ação");
$comedyMovies = $movieDao->getMoviesCategory("Comédia");
$novelMovies = $movieDao->getMoviesCategory("Romance");
$tragedyMovies = $movieDao->getMoviesCategory("Drama");
$fantasyMovies = $movieDao->getMoviesCategory("Fantasia / Ficção");


$movieData = "";
if (isset($movieData) || $movieData == "") {
    $movieData = "movie_cover.jpg";
}
?>
<div id="main-container" class="container-fluid">
    <!-- TODOS OS FILMES -->
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados!</p>
    <div class="movies-container">
        <?php if (count($lastesMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes cadastrados</p>
        <?php else: ?>
            <?php foreach ($lastesMovies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php" ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <hr class="text-primary">
    <hr class="text-success">
    <!-- FILMES DE AÇÃO -->
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação!</p>
    <div class="movies-container">
        <?php if (count($actionMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de ação cadastrados</p>
        <?php else: ?>
            <?php foreach ($actionMovies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php" ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <hr class="text-primary">
    <hr class="text-success">
    <!-- FILMES DE COMÉDIA -->
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de Comédia!</p>
    <div class="movies-container">
        <?php if (count($comedyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
        <?php else: ?>
            <?php foreach ($comedyMovies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php" ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <hr class="text-primary">
    <hr class="text-success">
    <!-- FILMES DE ROMANCE -->
    <h2 class="section-title">Romances</h2>
    <p class="section-description">Veja os melhores filmes de Romance!</p>
    <div class="movies-container">
        <?php if (count($novelMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de romances cadastrados</p>
        <?php else: ?>
            <?php foreach ($novelMovies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php" ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <hr class="text-primary">
    <hr class="text-success">
    <!-- FILMES DE DRAMA -->
    <h2 class="section-title">Drama</h2>
    <p class="section-description">Veja os melhores filmes de drama!</p>
    <div class="movies-container">
        <?php if (count($tragedyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de dramas cadastrados</p>
        <?php else: ?>
            <?php foreach ($tragedyMovies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php"; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <hr class="text-primary">
    <hr class="text-success">
    <!-- FILMES DE FANTASIA E FICÇÃO -->
    <h2 class="section-title">Fantasia e Ficção</h2>
    <p class="section-description">Veja os melhores filmes de fantasia e ficção!</p>
    <div class="movies-container">
        <?php if (count($fantasyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de romances cadastrados</p>
        <?php else: ?>
            <?php foreach ($fantasyMovies as $movie): ?>
                <?php require BASE_PATH . "templates/movie-card.php"; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>