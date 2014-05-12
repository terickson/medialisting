<?php
require_once('../../mlConfig.php');

@$echo = $_REQUEST['sEcho'];
$dir    = mlConfig::$movieLocation;
$files = scandir($dir);
$movieCounter = 0;
$returnData = array("sEcho"=>$echo,"aaData"=>array());

foreach($files as $file)
{
	if((strlen($file) > 2) && $file != 'lost+found' && $file != 'imdb' && (strpos($file, '.') > 0 || strpos($file, '.') === false))
	{
		$movieCounter++;
		$imdbId = @file_get_contents ($dir.'imdb/'.$file.'.imdb');
		if($imdbId === false){
                        $imdbId = '<form action="api/createImdbId.php" method="post">
                                   <input type="hidden" name="fileName" value="'.$file.'">
                                   <input type="text" name="imdbId" value=""> 
                                   <input type="submit" value="Create Id">
                                   </form>';
			$datapoint = '<a target="blank" href="http://www.imdb.com/find?s=all&q=';
			$datapoint .= str_replace(array('.m4v', '_'), array('', '+'),$file);
                	$datapoint .= '">';
                }else{
			$datapoint = '<a target="blank" href="http://www.imdb.com/title/'.$imdbId.'/">';
		}
		$datapoint .= str_replace(array('.m4v', '_'), array('', ' '),$file);
                $datapoint .= '</a>';
		array_push($returnData["aaData"],array($datapoint, $imdbId));	
	}
}

$returnData["iTotalRecords"] = $movieCounter;
$returnData["iTotalDisplayRecords"] = $movieCounter;

print json_encode($returnData);
?>
