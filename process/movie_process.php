<?php
require_once dirname(__DIR__) . "/globais.php";
require_once BASE_PATH . "db.php";
require_once BASE_PATH . "models/Movie.php";
require_once BASE_PATH . "models/Message.php";
require_once BASE_PATH . "models/Image.php";
require_once BASE_PATH . "dao/UserDAO.php";
require_once BASE_PATH . "dao/MovieDAO.php";

$message = new Message(BASE_URL);
$userDao = new UserDAO($conn, BASE_URL);
$movieDao = new MovieDAO($conn, BASE_URL);

//resgata tipo do formulario
$type = filter_input(INPUT_POST, "type");
//resgata dados do usuario
$userData = $userDao->verifyToken();


if ($type == "create") {
    //receber dados do post
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    //validação minima de dados
    if (!empty($title) && !empty($description) && !empty($category)) {
        //Preencer os dados do usuario
        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $movie->length = $length;
        $movie->user_id = $userData->id;

        // upload da imagem do filme
        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES['image'];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgarray = ["image/jpeg", "image/jpg"];

            //checando o tipo da imagem
            if (in_array($image["type"], $imageTypes)) {
                //checa se é jpge
                if (in_array($image["type"], $jpgarray)) {
                    $imageFile = imagecreatefromjpeg($image['tmp_name']);
                    $imageName = Image::imageGenerateName() . ".jpg";
                } else {
                    $imageFile = imagecreatefrompng($image['tmp_name']);
                    $imageName = Image::imageGenerateName() . ".png";
                }
                $path = BASE_PATH . "img/movies/" . $imageName;
                imagejpeg($imageFile, $path, 100);
                $movie->image = $imageName;
            } else {
                $message->setMessage("Formato de imagem incorreto, insira jpge ou png!", "error", "back");
            }
        }
        $movieDao->create($movie);
    } else {
        $message->setMessage("Informações minima: Title, Descrição e Categoria!", "error", "back");
    }
} elseif ($type == "delete") {
    //recebe os dados do formulario

    $id = filter_input(INPUT_POST, "id");
    $movie = $movieDao->findById($id);
    if ($movie) {
        //verifica se o filme é do usuario
        if ($movie->user_id === $userData->id) {
            $movieDao->destroy($id);
        } else {
            $message->setMessage("Informações inválidas!", "error", "index.php");
        }
    }
} elseif ($type == "update") {
    //receber dados do post
    $id = filter_input(INPUT_POST, "id");
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movieData = $movieDao->findById($id);
    if ($movieData) {
        //verifica se o filme é do usuario
        if ($movieData->user_id === $userData->id) {
            //validação minima de dados
            if (!empty($title) && !empty($description) && !empty($category)) {
                //Preencer os dados do usuario
                $movieData->title = $title;
                $movieData->description = $description;
                $movieData->trailer = $trailer;
                $movieData->category = $category;
                $movieData->length = $length;
                $movieData->length = $length;

                // upload da imagem do filme
                if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

                    $image = $_FILES['image'];
                    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                    $jpgarray = ["image/jpeg", "image/jpg"];

                    //checando o tipo da imagem
                    if (in_array($image["type"], $imageTypes)) {
                        //checa se é jpge
                        if (in_array($image["type"], $jpgarray)) {
                            $imageFile = imagecreatefromjpeg($image['tmp_name']);
                            $imageName = Image::imageGenerateName() . ".jpg";
                        } else {
                            $imageFile = imagecreatefrompng($image['tmp_name']);
                            $imageName = Image::imageGenerateName() . ".png";
                        }
                        $path = BASE_PATH . "img/movies/" . $imageName;
                        imagejpeg($imageFile, $path, 100);
                        $movieData->image = $imageName;
                    } else {
                        $message->setMessage("Formato de imagem incorreto, insira jpge ou png!", "error", "back");
                    }
                }

                $movieDao->update($movieData);
            } else {
                $message->setMessage("Informações inválidas!", "error", "index.php");
            }
        } else {
            $message->setMessage("Informações inválidas!", "error", "index.php");
        }
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
