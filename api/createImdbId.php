<?php
require_once("../../mlConfig.php");
require_once('library/createMovieJson.php');
$dir    = mlConfig::$movieLocation.'/imdb/';
file_put_contents ($dir.$_REQUEST['fileName'].'.imdb', $_REQUEST['imdbId']);
createMovieJson($_REQUEST['imdbId'], $dir.$_REQUEST['fileName'].'.json');
$imdbJson = file_get_contents ($dir.$_REQUEST['fileName'].'.json');
$imdbJson = json_decode($imdbJson);
$posterUrl = str_replace('300', '80',$imdbJson->Poster);
createPosterFile($posterUrl,$dir.$_REQUEST['fileName'].'.jpg');
header( 'Location: /medialisting/#/movies' )
?> 
