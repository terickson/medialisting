<?php
require_once("../../mlConfig.php");
require_once('library/createMovieJson.php');
$dir    = mlConfig::$movieLocation.'/imdb/';
file_put_contents ($dir.$_REQUEST['fileName'].'.imdb', $_REQUEST['imdbId']);
createMovieJson($_REQUEST['imdbId'], $dir.$_REQUEST['fileName'].'.json');
header( 'Location: /medialisting/#/movies' )
?> 
