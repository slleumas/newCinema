<?php

class Movie
{
    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $category;
    public $length;
    public $user_id;
}

interface MovieDAOInterface
{
    public function buidMovie($data); // cria o objeto do filme
    public function findAll(); //pega todos os filmes
    public function getLatesMovies(); //pega todos em ordem decrecente
    public function getMoviesCategory($category); //pega por categoria
    public function getMoviesByUserId($id); //pega pelo id do usuario
    public function findById($id); //pela pelo id do filme
    public function findByTitle($title); //pega pelo titulo do filme
    public function create(Movie $movie);
    public function update(Movie $movie);
    public function destroy($id);
}
