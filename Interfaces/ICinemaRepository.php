<?php

namespace Interfaces;
use Interfaces\IReadable as IReadable;
use Interfaces\IWritable as IWritable;

interface ICinemaRepository extends IReadable, IWritable{
    function GetAll();
    function GetById($id);
    
}

?>