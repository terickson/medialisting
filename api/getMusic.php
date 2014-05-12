<?php
require_once('../../mlConfig.php');

@$echo = $_REQUEST['sEcho'];
$dir    = mlConfig::$musicLocation;
$artists = scandir($dir);
$musicCounter = 0;
$returnData = array("sEcho"=>$echo,"aaData"=>array());

foreach($artists as $artist)
{
	if($artist != '.' && $artist != '..' && $artist != 'lost+found' && is_dir($dir.$artist.'/'))
	{
		$albums = scandir($dir.$artist.'/');
		foreach($albums as $album)
		{
			if($album != '.' && $album != '..' && $album != 'lost+found'  && is_dir($dir.$artist.'/'.$album.'/'))
			{
				$songs = scandir($dir.$artist.'/'.$album.'/');
				foreach($songs as $song)
				{
					if($song != '.' && $song != '..' && $song != 'lost+found' && is_file($dir.$artist.'/'.$album.'/'.$song) !== 0)
					{
						$musicCounter++;
						array_push($returnData["aaData"],array('<input name="songCh[]" type="checkbox" value="'.$dir.$artist.'/'.$album.'/'.$song.'"/>', 
							$artist, $album, str_replace(array('.mp3','.m4a','.ogg'), array('','',''),$song), 
							'<a target="_blank" href="http://lyrics.wikia.com/'.str_replace(' ','_',$artist).':'.str_replace(array(' ','.mp3','.m4a','.ogg'), array('_','','',''),preg_replace('/^\d\d /','',$song)).'"><button id="Lyric'.$musicCounter.'" class="btn btn-small">Get Lyrics</button></a>'));
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