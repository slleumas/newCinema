<?php
require_once BASE_PATH . "models/Review.php";
require_once BASE_PATH . "models/Message.php";

require_once BASE_PATH . "dao/UserDAO.php";
class ReviewDAO implements ReviewDaoInterface
{
    private $conn;
    private $url;
    private $message;


    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildReview($data)
    {
        $reviewObject = new Review();
        $reviewObject->id = $data["id"];
        $reviewObject->rating = $data["rating"];
        $reviewObject->review = $data["review"];
        $reviewObject->user_id = $data["user_id"];
        $reviewObject->movie_id = $data["movie_id"];
        return $reviewObject;
    }
    public function create(Review $reviewObject)
    {

        $stmt = $this->conn->prepare(
            "INSERT INTO reviews(
            rating, review, user_id, movie_id
            )VALUES(
            :rating, :review, :user_id, :movie_id
            )"
        );
        $stmt->bindParam(":rating", $reviewObject->rating);
        $stmt->bindParam(":review", $reviewObject->review);
        $stmt->bindParam(":user_id", $reviewObject->user_id);
        $stmt->bindParam(":movie_id", $reviewObject->movie_id);

        $stmt->execute();

        $this->message->setMessage("Crítica adicionada com sucesso!", "success", "index.php");
    }
    public function getMovieReview($id)
    {
        $reviews = [];

        $stmt = $this->conn->prepare("SELECT * FROM reviews
         WHERE movie_id = :movie_id");
        $stmt->bindParam(":movie_id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $userDao = new UserDAO($this->conn, $this->url);
            $reviewsData = $stmt->fetchAll();
            foreach ($reviewsData as $review) {
                $reviewObject = $this->buildReview($review);
                //dados do usuario
                $user = $userDao->findById($reviewObject->user_id);
                $reviewObject->user = $user;
                $reviews[] = $reviewObject;
            }
        }

        return $reviews;
    }
    public function hasAlreadyReviewed($id, $user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviews
         WHERE movie_id = :movie_id AND user_id = :user_id");
        $stmt->bindParam(":movie_id", $id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    public function getRatings($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviews
         WHERE movie_id = :movie_id");
        $stmt->bindParam(":movie_id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $reviewsData = $stmt->fetchAll();
            $rating = 0;
            foreach ($reviewsData as $review) {
                $rating += $review['rating'];
            }

            return $rating / $stmt->rowCount();
        }
        return "Sem avaliação";
    }
}
