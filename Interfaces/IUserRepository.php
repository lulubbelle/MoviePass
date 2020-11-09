<?php

namespace Interfaces;


interface IUserRepository{
    function Add($user);
    function GetAll();
    function GetUserByMail($mail);
    function GetById($id);
    function Update($id,$password);
    function updateUserName($id, $userName);
    function Delete($mail);

?>