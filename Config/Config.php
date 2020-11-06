<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass/");
define("VIEWS_PATH", "Views/");

define("DATA_PATH", "Data/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "img/");
define("UTILS_PATH", "Utils/");
define("API_KEY","?api_key=601a788e05e35017d437dd9ad9c368c0");
define("API_NOW_PLAYING","movie/now_playing");

define("API_MAIN_LINK","https://api.themoviedb.org/3/");
define("IMG_LINK","https://image.tmdb.org/t/p/w185/");


define("LANGUAGE_ES","es");
define("DB_HOST", "26.177.180.157");
define("DB_NAME", "moviepassdb");
//Se crea usuario con permisos especificos para la aplicación
define("DB_USER", "aplication");
define("DB_PASS", "aplication");


//Custom validations on inputs
define("MAX_LENGTH_255", "255");
define("MIN_PRICE_ROOM", "200");
define("MAX_PRICE_ROOM", "1500");

define("MIN_CAPACITY_ROOM", "10");
define("MAX_CAPACITY_ROOM", "200");

define("CINEMA_UNIQUE_ADDRESS_IX", "CINEMA_UNIQUE_IX1");
define("USER_UNIQUE_MAIL_IX", "MAIL_UNIQUE_IX");

?>




