<?php
require_once __DIR__ . "/globais.php";
require_once BASE_PATH . "templates/header.php";
?>
<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row style-row " id="auth-row">
            <div class="col-md-4" id="login-container">
                <h2>Entrar</h2>
                <form action="<?= BASE_URL ?>process/auth_process.php" method="POST">
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
                    </div>
                    <div class="form-group my-2">
                        <input type="hidden" name="type" value="login">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Digite sua senha" required>
                    </div>
                    <input type="submit" class="btn card-btn btn-success" value="Entrar">
                </form>
            </div>
            <div class="col-md-4" id="register-container">
                <h2>Criar conta</h2>
                <form action="<?= BASE_URL ?>process/auth_process.php" method="POST">
                    <input type="hidden" name="type" value="register">
                    <div class="form-group my-2">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
                    </div>
                    <div class="form-group my-2">
                        <label for="lastname">Sobrenome:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu Sobrenome">
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Digite sua senha">
                    </div>
                    <div class="form-group my-2">
                        <label for="confirmpassword">Confirmar Senha:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                            placeholder="Confirme sua senha">
                    </div>
                    <input type="submit" class="btn card-btn btn-primary" value="Registrar">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once BASE_PATH . "templates/footer.php";
?>