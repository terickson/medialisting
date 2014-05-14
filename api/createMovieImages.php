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
		$imdbJson = @file_get_contents ($dir.'imdb/'.$file.'.json');
		$imdbJpg = @file_get_contents ($dir.'imdb/'.$file.'.jpg');
		if($imdbJson !== false && $imdbJpg === false){
			$jobj = json_decode($imdbJson);
			$posterUrl = str_replace('300', '80',$jobj->Poster);
			createPosterFile($posterUrl,$dir.'imdb/'.$file.'.jpg');		
		}
	}
}
?>
