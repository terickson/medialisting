<?php
require_once("../../mlConfig.php");
$dir    = mlConfig::$movieLocation.'/imdb/';
file_put_contents ($dir.$_REQUEST['fileName'].'.imdb', $_REQUEST['imdbId']);
header( 'Location: /medialisting/#/movies' )
?> 
