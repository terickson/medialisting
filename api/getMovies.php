<?php
require_once('../../mlConfig.php');

@$echo = $_REQUEST['sEcho'];
$dir    = mlConfig::$movieLocation;
$files = scandir($dir);
$movieCounter = 0;
$returnData = array("sEcho"=>$echo,"aaData"=>array());

foreach($files as $file)
{
	if((strlen($file) > 2) && $file != 'lost+found')
	{
		$movieCounter++;
		$datapoint = '<a target="blank" href="http://www.imdb.com/find?s=all&q=';
		$datapoint .= str_replace(array('.m4v', '_'), array('', '+'),$file);
		$datapoint .= '">';
		$datapoint .= str_replace(array('.m4v', '_'), array('', ' '),$file); 
		$datapoint .= '</a>';
		array_push($returnData["aaData"],array($datapoint));	
	}
}

$returnData["iTotalRecords"] = $movieCounter;
$returnData["iTotalDisplayRecords"] = $movieCounter;

print json_encode($returnData);
?>