<?php

namespace Interfaces;


interface ICityRepository{
    function GetAll();
    function GetById($id);
    function GetCityByRoomId($id);
}

?>