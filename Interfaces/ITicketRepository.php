<?php

namespace Interfaces;


interface ITicketRepository{
    function GetAll();
    function GetById($id);
}

?>