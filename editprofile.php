<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";
require_once BASE_PATH . "models/User.php";
// require_once BASE_PATH . "dao/UserDAO.php";
$user = new User();
$userDao = new UserDAO($conn, BASE_URL);
$userData = $userDao->verifyToken(true);
$fullName = $user->getFullName($userData);

if ($userData->image == "") {
    $userData->image = "user.png";
}
?>
<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <form action="<?= BASE_URL ?>process/user_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row style-row col-edit-data">
                <div class="col-md-4 text-center col-conteiner">
                    <h1><?= $fullName ?></h1>
                    <div class="row-image">
                        <div id="profile-image-container">
                            <div style="background-image: url(<?= BASE_URL ?>img/users/<?= $userData->image ?>);"></div>
                        </div>
                    </div>
                    <p class="page-descrption"><?= $userData->name ?> altere seus dados no formulario abaixo:</p>
                    <div class="form-group my-2 text-start">
                        <label for="image">Foto:</label>
                        <div>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group my-2 text-start">
                        <label for="bio">Sobre você</label>
                        <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Escreva sobre você e o que faz de bom..."><?= $userData->bio ?></textarea>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o seu nome" value="<?= $userData->name ?>">
                    </div>
                    <div class="form-group my-2">
                        <label for="lastname">Sobrenome:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu Sobrenome" value="<?= $userData->lastname ?>">
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" readonly class="form-control disabled" id="email" name="email" placeholder="Digite seu email" value="<?= $userData->email ?>">
                    </div>
                    <input type="submit" class="btn form-btn card-btn btn-success my-2" value="Alterar">
                </div>
            </div>
        </form>
        <hr class="text-primary">
        <hr class="text-success">
        <div class="row style-row text-center mt-5" id="change-password-container">
            <div class="col-md-4">
                <h2>Alterar Senha</h2>
                <p class="page description">Digite nova senha e confirme para alterar.</p>
                <form action="<?= BASE_URL ?>process/user_process.php" method="POST">
                    <input type="hidden" name="type" value="changepassword">
                    <div class="form-group m-2">
                        <label for="password">Nova Senha:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Digite sua nova senha">
                    </div>
                    <div class="form-group m-2">
                        <label for="confirmpassword">Confirmar Nova Senha:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                            placeholder="Confirme sua nova senha">
                    </div>
                    <input type="submit" class="btn btn-primary card-btn my-2" value="Alterar senha">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once BASE_PATH . "templates/footer.php";
?>