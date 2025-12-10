<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "models/User.php";
require_once BASE_PATH . 'dao/UserDAO.php';
$user = new User();
$userDao = new UserDAO($conn, BASE_URL);
$userData = $userDao->verifyToken(true);
?>
<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar Filme</h1>
        <p class="page-descrition"><?= $userData->name ?>, prepare-se para adicionar suas criticas e compartilha-las com o mundo!</p>
        <form action="<?= BASE_URL  ?>process/movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group my-2">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o titulo do seu filme!">
            </div>
            <div class="form-group my-2">
                <label for="image">Selecionar imagem:</label>
                <div>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
            </div>
            <div class="form-group my-2">
                <label for="length">Duração:</label>
                <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme!">
            </div>
            <div class="form-group my-2">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Comédia">Comédia</option>
                    <option value="Fantasia / Ficção">Fantasia / Ficção</option>
                    <option value="Romance">Romance</option>
                </select>
            </div>
            <div class="form-group my-2">
                <label for="trailer">Trailer:</label>
                <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group my-2">
                <label for="description">Descrição do filme:</label>
                <textarea name="description" class="form-control" id="description" rows="5" placeholder="Descreva o filme..."></textarea>
            </div>
            <input type="submit" class="btn card-btn btn-success" value="Enviar">

        </form>
    </div>
</div>
<?php
require_once BASE_PATH . "templates/footer.php";
?>