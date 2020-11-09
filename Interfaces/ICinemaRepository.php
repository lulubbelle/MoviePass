<?php

namespace Interfaces;


interface ICinemaRepository{
    function GetAll();
    function GetById($id);
    function AddOne($cinema);
    function DeleteCinema($id);
    function Update($cinema);
    function GetByCity($cityId);
    function getAllRoomsByCinemaId($id);
}

?>