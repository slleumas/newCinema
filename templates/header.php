<?php
// require_once  dirname(__DIR__) . "/globais.php";
require_once BASE_PATH . "db.php";
require_once BASE_PATH . "models/Message.php";
require_once BASE_PATH . "dao/UserDao.php";
$message = new Message(BASE_URL);
$flassMessage = $message->getMesssage();
if (!empty($flassMessage['msg'])) {
    //limpar a mensagem
    $message->clearMesssage();
}
$userDao = new UserDAO($conn, BASE_URL);
$userData = $userDao->verifyToken(false);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invent Movies</title>
    <link rel="short icon" href="<?= BASE_URL ?>img\invent-icone.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS do projeto -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css\styles.css">


</head>


<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= BASE_URL ?>" class="navbar-brand">
                <img src="<?= BASE_URL ?>img\invent-iconeBr.png" alt="Invent Movies Logo" id="logo">
                <span id="InventCine-title">InventCine</span>
            </a>
            <button class="navbar-toggler border-light mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-light "></i>
            </button>
            <form action="<?= BASE_URL ?>search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0 d-flex">
                <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Pesquisar filmes..." aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <?php if ($userData): ?>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>newmovie.php" class="nav-link">
                                <i class="fa fa-plus-square"></i> Incluir Filme
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>dashboard.php" class="nav-link">
                                Meus Filmes</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>editprofile.php" class="nav-link text-capitalize"><?= $userData->name ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>logout.php" class="nav-link">Sair</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>auth.php" class="nav-link">Entrar/Registrar</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <?php if (!empty($flassMessage['msg'])): ?>
        <div class="msg-conteiner">
            <p class="msg <?= $flassMessage['type'] ?>"><?= $flassMessage['msg'] ?></p>
        </div>
    <?php endif; ?>