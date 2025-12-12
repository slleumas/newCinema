<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "models/User.php";
require_once BASE_PATH . 'dao/UserDAO.php';
require_once BASE_PATH . 'dao/MovieDAO.php';
$user = new User();
$id = filter_input(INPUT_GET, "id");
$userDao = new UserDAO($conn, BASE_URL);
$movieDao = new MovieDAO($conn, BASE_URL);

if (empty($id)) {
    if (!empty($userData)) {
        $id = $userData->id;
    } else {
        $message->setMessage("Usuário não encontrado", "error", "index.php");
    }
} else {
    $userData = $userDao->findById($id);
    if (!$userData) {
        $message->setMessage("Usuário não encontrado", "error", "index.php");
    }
}
$fullName = $user->getFullName($userData);

if ($userData->image == "") {
    $userData->image = "user.png";
}
//lista filmes do usuario
$userMovies = $movieDao->getMoviesByUserId($id);
?>
<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row">
            <div class="col-md-12 profile-container my-4">
                <div id="profile-image-container">
                    <div style="background-image: url(<?= BASE_URL ?>img/users/<?= $userData->image ?>);"></div>
                </div>
                <div class="mx-3 profile-user">
                    <h1 class="p-0 m-0"><?= $fullName ?></h1>
                    <span>Indicações: <?= count($userMovies) ?></span>
                    <h4 class="about-title">Sobre:</h4>
                    <?php if (!empty($userData->bio)): ?>
                        <p class="profile-description"><?= $userData->bio ?></p>
                    <?php else: ?>
                        <p class="profile-description">O usuario ainda não escreveu nada aqui...</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12 added-movies-container">
                <h3>Filmes indicados:</h3>
                <?php if (!empty($userMovies)): ?>
                    <div class="d-flex">
                        <?php foreach ($userMovies as $movie): ?>
                            <?php require BASE_PATH . "templates/movie-card.php"; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="empty-list">O usuario ainda não indicou nenhum filme.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>