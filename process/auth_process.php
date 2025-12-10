<?php
require_once dirname(__DIR__) . "/globais.php";
require_once BASE_PATH . "db.php";
require_once BASE_PATH . "models/User.php";
require_once BASE_PATH . "models/Message.php";
require_once BASE_PATH . "dao/UserDAO.php";

$message = new Message(BASE_URL);
$userDao = new UserDAO($conn, BASE_URL);
// Resgata o tipo de usuario

$type = filter_input(INPUT_POST, "type");


//verificação do tipo do formulario

if ($type === "register") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    //verificação de dados minimos
    if ($name && $lastname && $email && $password) {
        //verificar se as senhas batem
        if ($password === $confirmpassword) {
            //verificar se o email já está está cadastrado
            if ($userDao->findByEmail($email) == false) {
                $user = new User();
                //criar tokem e senha
                $userToken = $user->generateToken();
                $finalPassword = $user->generatePassword($password);

                $user->name = $name;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->password = $finalPassword;
                $user->token = $userToken;

                $auth = true;
                $userDao->create($user, $auth);
            } else {
                $message->setMessage("Esse email já está cadastrado", "error", "back");
            }
        } else {
            $message->setMessage("As senhas não são iguais", "error", "back");
        }
    } else {
        //enviar uma msg de erro, de dados faltando.
        $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
    }
} elseif ($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    //tenta autenticar o usuario
    if ($userDao->authenticateUser($email, $password)) {
        $message->setMessage("Seja bem-vindo!", "success",  "editprofile.php");
        //redireciona caso não autentique
    } else {
        $message->setMessage("Por favor, verifique seu login e senha.", "error", "back");
    }
} else {
    $message->setMessage("informações invalidas.", "error", "index.php");
}
