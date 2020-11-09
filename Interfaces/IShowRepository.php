<?php

namespace Interfaces;


interface IShowRepository{
    function GetAll();
    function GetByCinemaId($cinemaId);
    function GetById($id);
    function AddOne($show);
    function DeleteShow($id);
    function Update($show);
    function GetByDateAndMovieId($dateFrom, $movieId);
    function GetByRoomIdAndMovieId($roomId, $movieId);
    function GetShowByDatePlusMinutes($dateFrom, $minutes);
    function GetShowIsPlayingInDateTime($dateFrom);
}

?>