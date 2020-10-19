<?php
if (!isset($_SESSION["userId"])) {
    //redirect to homepage
    header(VIEWS_PATH."login.php");
}