<?php
require_once('../../mlConfig.php');

@$echo = $_REQUEST['sEcho'];
$dir    = mlConfig::$musicLocation;
$artists = scandir($dir);
$musicCounter = 0;
$returnData = array("sEcho"=>$echo,"aaData"=>array());

foreach($artists as $artist)
{
	if((strlen($artist) > 2) && $artist != 'lost+found' && strrpos ($artist,'.') !== '0')
	{
		$albums = scandir($dir.$artist.'/');
		foreach($albums as $album)
		{
			if((strlen($album) > 2) && $album != 'lost+found' && strrpos (album,'.') !== '0')
			{
				$songs = scandir($dir.$artist.'/'.$album.'/');
				foreach($songs as $song)
				{
					if((strlen($song) > 2) && $song != 'lost+found' && strrpos ($song,'.') !== '0')
					{
						$musicCounter++;
						array_push($returnData["aaData"],array($artist, $album, $song));
					}
				}
			}
		}
	}
}

$returnData["iTotalRecords"] = $musicCounter;
$returnData["iTotalDisplayRecords"] = $musicCounter;

print json_encode($returnData);
?>