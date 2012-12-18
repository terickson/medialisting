<?php
require_once("../../googleSetup.php");
$title = urlencode($_REQUEST["title"]);
$author = urlencode($_REQUEST["author"]);
$isbn=$_REQUEST["isbn"];

$googleAPI = "https://www.googleapis.com/books/v1/volumes?q=";
if(!empty($isbn)){
	$googleAPI .= 'isbn' . $isbn;
}else{
	$googleAPI .= "intitle:\"$title\"+inauthor:\"$author\"";
}
$googleAPI .= "&maxResults=1&key=$myGoogleKey";
$ch = curl_init($googleAPI);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, $googleAPI);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);

//make the request
$result = curl_exec($ch);
if (curl_errno($ch)) {
	echo "ERROR:" . curl_error($ch);
	exit();
} else {
	curl_close($ch);
}
$decodedObj = json_decode($result);
if(!isset($decodedObj->items[0]->volumeInfo)){
	//echo $result;
	exit('No information found for this book.');
}
echo "<ul>";
if(isset($decodedObj->items[0]->volumeInfo->averageRating)){
        echo '<li>Google Rating: ' . $decodedObj->items[0]->volumeInfo->averageRating . ' </li>';
}
if(isset($decodedObj->items[0]->volumeInfo->pageCount)){
        echo '<li>Page Count: ' . $decodedObj->items[0]->volumeInfo->pageCount . ' </li>';
}
if(isset($decodedObj->items[0]->volumeInfo->categories)){
        echo '<li>Categories: ' . implode($decodedObj->items[0]->volumeInfo->categories,',') . ' </li>';
}
if(isset($decodedObj->items[0]->volumeInfo->publishedDate)){
        echo '<li>Published Date: ' . $decodedObj->items[0]->volumeInfo->publishedDate . ' </li>';
}
if(isset($decodedObj->items[0]->volumeInfo->description)){
	echo '<li>Description: ' . $decodedObj->items[0]->volumeInfo->description . ' </li>';
}
if(isset($decodedObj->items[0]->volumeInfo->canonicalVolumeLink)){
        echo '<li><a target="_blank" href="' . $decodedObj->items[0]->volumeInfo->canonicalVolumeLink . '">More Info</a></li>';
}
echo "</ul>";
?> 
