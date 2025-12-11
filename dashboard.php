<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "models/User.php";
require_once BASE_PATH . 'dao/UserDAO.php';
require_once BASE_PATH . "dao/MovieDao.php";
$user = new User();

//Dao do fimes
$movieDao = new MovieDAO($conn, BASE_URL);
$userDao = new UserDAO($conn, BASE_URL);
$userData = $userDao->verifyToken(true);
$userMovie = $movieDao->getMoviesByUserId($userData->id);
?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
    <div class="col-md-12 text-end me-4" id="add-movie-container">
        <a href="<?= BASE_URL ?>newmovie.php" class="btn btn-success"><i class="fas fa-plus"></i> Adicionar</a>
    </div>
    <div class="col-md-12 text-center" id="movies-dashboard">
        <table class="table table-dark my-5">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Nota</th>
                <th scope="col" class="actions-column"></th>
            </thead>
            <tbody>
                <?php foreach ($userMovie as $movie): ?>
                    <tr>
                        <td scope="row"><?= $movie->id ?></td>
                        <td><a href="<?= BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="table-movie-title"><?= $movie->title ?></a></td>
                        <td><i class="fas fa-star"></i> 9</td>
                        <td class="actions-column">
                            <a href="<?= BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn edit-btn btn-primary">
                                <i class="far fa-edit"></i>
                            </a>
                            <form action="<?= BASE_URL  ?>process/movie_process.php">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id" value="<?= $movie->id ?>">
                                <button type="submit" class="btn delete-btn btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>