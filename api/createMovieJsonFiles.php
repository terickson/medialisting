<?php
require_once('../../mlConfig.php');
require_once('library/createMovieJson.php');

@$echo = $_REQUEST['sEcho'];
$dir    = mlConfig::$movieLocation;
$files = scandir($dir);
$movieCounter = 0;
$returnData = array("sEcho"=>$echo,"aaData"=>array());

foreach($files as $file)
{
	if((strlen($file) > 2) && $file != 'lost+found' && $file != 'imdb' && (strpos($file, '.') > 0 || strpos($file, '.') === false))
	{
		$imdbId = @file_get_contents ($dir.'imdb/'.$file.'.imdb');
		$imdbJson = @file_get_contents ($dir.'imdb/'.$file.'.json');
		if($imdbId !== false && $imdbJson === false){
			createMovieJson($imdbId, $dir.'imdb/'.$file.'.json');	
		}
	}
}
?>
