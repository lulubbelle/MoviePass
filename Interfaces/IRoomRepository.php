<?php

namespace Interfaces;


interface IRoomRepository{
    function GetAll();
    function GetById($id);
    function Add(Room $room);
    function DeleteRoom($id);
    function UpdateRoom($room);
    function getAllRoomsByCinemaId($id);
}

?>