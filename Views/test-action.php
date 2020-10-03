<?php
$url = "https://api.themoviedb.org/3/movie/550?api_key=601a788e05e35017d437dd9ad9c368c0";
$data = file_get_contents($url);

include("Test.php");
// header("location: Test.php");
?>