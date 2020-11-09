<?php

namespace Interfaces;


interface IMovieRepository{
    function GetAll();
    function GetById($id);
    function GetByApiId($id);
    function GetAllFromApi();
    function GetAllByGenreFromApi($genreId);
    function GetAllByGenre($genreId);
}

?>