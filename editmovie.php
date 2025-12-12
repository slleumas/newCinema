<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "models/User.php";
require_once BASE_PATH . 'dao/UserDAO.php';
require_once BASE_PATH . 'dao/MovieDAO.php';
$user = new User();
$userDao = new UserDAO($conn, BASE_URL);
$userData = $userDao->verifyToken(true);
$movieDao = new MovieDAO($conn, BASE_URL);
$id = filter_input(INPUT_GET, "id");

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
$alreadyReviewed = false;
?>
<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-6 offset-md-1 ">
                <div class="new-movie-container">
                    <h1 class="page-title "><?= $movie->title ?></h1>
                    <p class="page-description">Altere os dados do filme no formulário abaixo.</p>
                </div>
                <form id="edit-movie-form " action="<?= BASE_URL ?>process/movie_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $movie->id ?>">
                    <div class="form-group my-2">
                        <label for="title">Título</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o titulo do seu filme!" value="<?= $movie->title ?>">
                    </div>
                    <div class="form-group my-2">
                        <label for="image">Selecionar imagem:</label>
                        <div>
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="length">Duração:</label>
                        <input type="text" class="form-control" id="length" name="length" value="<?= $movie->length ?>" placeholder="Digite a duração do filme!">
                    </div>
                    <div class="form-group my-2">
                        <label for="category">Categoria:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Selecione</option>
                            <option value="Ação" <?= $movie->category === "Ação" ? "selected" : "" ?>>Ação</option>
                            <option value="Drama" <?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                            <option value="Comédia" <?= $movie->category === "Comédia" ? "selected" : "" ?>>Comédia</option>
                            <option value="Fantasia / Ficção" <?= $movie->category === "Fantasia / Ficção" ? "selected" : "" ?>>Fantasia / Ficção</option>
                            <option value="Romance" <?= $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="trailer">Trailer:</label>
                        <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o link do trailer" value="<?= $movie->trailer ?>">
                    </div>
                    <div class="form-group my-2">
                        <label for="description">Descrição do filme:</label>
                        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Descreva o filme..."><?= $movie->description ?></textarea>
                    </div>
                    <input type="submit" class="btn card-btn btn-success" value="Enviar">
                </form>
            </div>
            <div class="col-md-3">
                <div class="movie-image-container" style="background-image: url('<?= BASE_URL ?>img/movies/<?= $movie->image ?>');"></div>
            </div>
        </div>
    </div>

</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>