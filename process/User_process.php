<?php
require_once dirname(__DIR__) . "/globais.php";
require_once BASE_PATH . "db.php";
require_once BASE_PATH . "models/User.php";
require_once BASE_PATH . "models/Image.php";
require_once BASE_PATH . "models/Message.php";
require_once BASE_PATH . "dao/UserDAO.php";

$message = new Message(BASE_URL);
$userDao = new UserDAO($conn, BASE_URL);


$type = filter_input(INPUT_POST, "type");


//Atulizar usúario
if ($type == "update") {
    //resgata dados do usuario
    $userData = $userDao->verifyToken();

    //receber dados do post
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    //Preencer os dados do usuario
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    //upload da imagem
    if (isset($_FILES['image']) && !empty($_FILES['image']["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];
        //checagem de tipo de imagem
        if (in_array($image["type"], $imageTypes)) {
            //checar tipo jpg
            if (in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                $imageName = Image::imageGenerateName() . ".jpg";
            } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
                $imageName = Image::imageGenerateName() . ".png";
            }
            $path = BASE_PATH . "img/users/" . $imageName;
            imagejpeg($imageFile, $path, 100);
            $userData->image = $imageName;
        } else {
            $message->setMessage('Tipo invalido de imagem, insira png ou jpg!', "error", "back");
        }
    }
    $userDao->update($userData);
    //atualisar senha do usuario
} elseif ($type === "changepassword") {
    //receber dados do post
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    //resgata dados do usuario
    $userData = $userDao->verifyToken();

    if ($password == $confirmpassword) {
        $user = new User;
        $NewPassword = $user->generatePassword($password);
        $user->password = $NewPassword;
        $user->id = $userData->id;
        $userDao->changePassword($user);
    } else {
        $message->setMessage('As senhas não são iguais!', "error", "back");
    }
} else {
    $message->setMessage('Informações inválidas!', "error", "index.php");
}
