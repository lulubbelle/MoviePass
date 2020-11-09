<?php

namespace Interfaces;

use Models\Room as Room;

interface IRoomRepository{
    function GetAll();
    function GetById($id);
    function Add(Room $room);
    function DeleteRoom($id);
    function UpdateRoom($room);
    function getAllRoomsByCinemaId($id);
}

?>