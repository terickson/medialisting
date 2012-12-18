<?php
$file = '/tmp/books.tar.gz';
$bookFiles = json_decode($_REQUEST['files']);
exec("rm -f $file", $compressOutput);
$zipCommand = "tar zcvf $file";
foreach($bookFiles as $book){
	$zipCommand .= ' "'.$book.'"';
}
exec($zipCommand, $compressOutput);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file); 
?>
