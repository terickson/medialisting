<?php
 function getBookInfo($fileName)
{
	$bookInfo = simplexml_load_file($fileName);
	return $bookInfo;
}
?>
