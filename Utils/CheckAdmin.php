<?php
$esAdmin = $_SESSION["esAdmin"];
if (isset($_SESSION["esAdmin"]) && !$esAdmin) {
    //redirect to homepage
    header("location:".FRONT_ROOT);

    //exit previene que se ejecute el codigo que continuaría
    exit;
}