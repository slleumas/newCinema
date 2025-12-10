<?php
require_once "globais.php";
require_once BASE_PATH . "templates/header.php";

if ($userDao) {
    $userDao->destroyToken();
}
