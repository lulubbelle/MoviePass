<?php
if (!isset($_SESSION["userId"])) {
    //redirect to homepage
    header("location:".FRONT_ROOT."Login");
}