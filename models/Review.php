<?php

class Review
{
    public $id;
    public $rating;
    public $review;
    public $user_id;
    public $movie_id;
    public ?User $user = null;
}

interface ReviewDaoInterface
{

    public function buildReview($data);
    public function create(Review $review);
    public function getMovieReview($id);
    public function hasAlreadyReviewed($id, $user_id);
    public function getRatings($id);
}
