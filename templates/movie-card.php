<?php
require_once BASE_PATH . 'dao/ReviewDAO.php';
$reviewDao = new ReviewDAO($conn, BASE_URL);
$mediaRating = $reviewDao->getRatings($movie->id);
if (empty($movie->image)) {
    $movie->image = "movie_cover.jpg";
}
?>
<div class="card movie-card">
    <div class="card-img-top" style="background-image: url(<?= BASE_URL ?>img/movies/<?= $movie->image ?>);"></div>
    <div class="card-body">
        <p class="card-rating">
            <i class="fas fa-star"></i>
            <span class="rating"><?= $mediaRating ?></span>
        </p>
        <h5 class="card-title">
            <a href="<?= BASE_URL ?>movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
        </h5>
        <a href="<?= BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary card-btn">Avaliar</a>
        <a href="<?= BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-success card-btn">Conhecer</a>
    </div>
</div>