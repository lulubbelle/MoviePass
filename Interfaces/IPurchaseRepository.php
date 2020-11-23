<?php

namespace Interfaces;


interface IPurchaseRepository{
    function GetAll();
    function GetById($id);
}

?>