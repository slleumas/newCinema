<?php
require_once dirname(__DIR__) . "/globais.php";
require_once BASE_PATH . "db.php";
require_once BASE_PATH . "models/Movie.php";
require_once BASE_PATH . "models/Message.php";
require_once BASE_PATH . "models/Review.php";
require_once BASE_PATH . "dao/UserDAO.php";
require_once BASE_PATH . "dao/MovieDAO.php";
require_once BASE_PATH . "dao/ReviewDAO.php";

$message = new Message(BASE_URL);
$userDao = new UserDAO($conn, BASE_URL);
$movieDao = new MovieDAO($conn, BASE_URL);
$reviewDao = new ReviewDAO($conn, BASE_URL);

//resgata tipo do formulario
$type = filter_input(INPUT_POST, "type");
//resgata dados do usuario
$userData = $userDao->verifyToken();

if ($type === "create") {
    //recebendo dados do post
    $rating = filter_input(INPUT_POST, 'rating');
    $review = filter_input(INPUT_POST, 'review');
    $movie_id = filter_input(INPUT_POST, 'movie_id');

    $reviewObject = new Review;

    $movieData = $movieDao->findById($movie_id);

    if ($movieData) {
        // verificar dados minimos
        if (!empty($rating) && !empty($review) && (!empty($movie_id))) {
            $reviewObject->rating = $rating;
            $reviewObject->review = $review;
            $reviewObject->movie_id = $movie_id;
            $reviewObject->user_id = $userData->id;

            $reviewDao->create($reviewObject);
        } else {
            $message->setMessage("Informações faltando, verifique sua nota e seu comentário!", "error", "back");
        }
    } else {

        $message->setMessage("Filme não encontrado!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
