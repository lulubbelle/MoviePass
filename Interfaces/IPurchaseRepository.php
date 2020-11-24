<?php

namespace Interfaces;

use Models\Purchase as Purchase;

interface IPurchaseRepository{
    function GetAll();
    function GetById($id);
    function AddOne(Purchase $purchase);
}

?>