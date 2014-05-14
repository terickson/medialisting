<?php
 function createMovieJson($imdbId, $fileLocation)
{	
	$method = 'GET';
	$url="http://www.omdbapi.com/?i=$imdbId&tomatoes=true";
	$movieJson = CallAPI($method, $url);
	file_put_contents($fileLocation, $movieJson);
}

function createPosterFile($posterUrl,$fileLocation)
{
	$posterBin = file_get_contents($posterUrl);
	file_put_contents($fileLocation, $posterBin);
}

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    /* Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    */

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    return curl_exec($curl);
}

?>
