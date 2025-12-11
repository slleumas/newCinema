<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "models/Message.php";
require_once BASE_PATH . "models/Movie.php";
require_once BASE_PATH . 'dao/movieDAO.php';

//Pegar o id do filme
$id = filter_input(INPUT_GET, "id");
$movie;
$movieDao = new MovieDAO($conn, BASE_URL);
if (empty($id)) {
    $message->setMessage("O filme desejado não foi encontrado", "error", "index.php");
} else {
    $movie = $movieDao->findById($id);
    if (!$movie) {
        $message->setMessage("O filme desejado não foi encontrado", "error", "index.php");
    }
}
//checar se o filme é do usuario
if (!empty($userData)) {
    if ($userData->id == $movie->user_id) {
        $userOwnsMovie = true;
    }
}
//checar se o filme tem imagem
if ($movie->image == "") {
    $movie->image = "movie_cover.jpg";
}
//Regatar as revies do filme
?>

<div id="main-container" class="container-fluid">
    <!-- FILMES -->
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title"><?= $movie->title ?></h1>
            <p class="movie-details">
                <span>Duração:<?= $movie->length ?></span>
                <span class="pipe"></span>
                <span><?= $movie->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> 9</span>
            </p>
            <iframe src="<?= $movie->trailer ?>" frameborder="0" width="560" height="315"
                allow="accelerometer; autoplay; clipboard-write; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p><?= $movie->description ?></p>
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image: url('<?= BASE_URL ?>/img/movies/<?= $movie->image ?>');"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações:</h3>
            <!-- Verifica se habilita a review para o usuario ou não -->
            <div class="col-md-12" id="review-form-container">
                <h4>Envie sua avaliação</h4>
                <p class="page-description">Preencha o formulario com a nota e comentário sobre o filme</p>
                <form action="<?= BASE_URL ?>process/review_process.php" id="review-form-id" method="post">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
                    <div class="form-group">
                        <label for="rating">Nota do filme:</label>
                        <div class="star-rating">
                            <?php for ($i = 10; $i > 0; $i--) {
                                echo "<input type='radio'id='star$i' name='rating' value='$i'><label for='star$i'><i class='fa fa-star'></i></label>";
                            } ?>
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="review">Seu Comentário:</label>
                        <textarea name="review" id="review" rows="3" class="form-control" placeholder="Digite um comentario..."></textarea>
                    </div>
                    <input type="submit" class="btn btn-success px-4 my-4" value="Enviar Comentário">
                </form>
            </div>
            <!-- Comentário -->
            <div class="col-md-12 review">
                <div class="row">
                    <div class="col-md-1">
                        <div class="profile-image-container review-image" style="background-image: url(<?= BASE_URL ?>img/users/user.png);"></div>
                    </div>
                    <div class="col-md-9 author-details-container">
                        <h4 class="auth-name">
                            <a href="#">Teste da Silva</a>
                        </h4>
                        <p><i class="fas fa-star"></i>9</p>
                    </div>
                    <div class="col-md-12">
                        <p class="comment-title">Comentários:</p>
                        <p>Este é o comentário do usuario teste</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>