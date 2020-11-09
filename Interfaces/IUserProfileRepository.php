<?php

namespace Interfaces;


interface IUserProfileRepository{
    function Add($userProfile);
    function GetAll();
    function updateProfileUser($id, $firstName, $lastName, $dni, $upId);
    function getUserById($id);
}

?>