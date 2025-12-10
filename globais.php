<?php
session_start();

// Caminho absoluto da raiz do projeto
define("BASE_PATH", __DIR__ . "/");
define("BASE_URL", "http://" . $_SERVER["SERVER_NAME"] . "/");
// define("BASE_URL", "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["REQUEST_URI"] . "?"));
