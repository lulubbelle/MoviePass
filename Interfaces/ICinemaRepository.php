<?php

namespace Interfaces;

<<<<<<< .mine

interface ICinemaRepository{
    function GetAll();
    function GetById($id);
    function AddOne($cinema);
    function DeleteCinema($id);
    function Update($cinema);
    function GetByCity($cityId);
    function getAllRoomsByCinemaId($id);
=======
interface ICinemaRepository extends IReadable, IWritable{
    function GetAll();
    function GetById($id);
    





>>>>>>> .theirs
}

?>