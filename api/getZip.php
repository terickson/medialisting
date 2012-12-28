<?php
require_once('../../mlConfig.php');

$fileName = mlConfig::$tarFileDir . $_REQUEST['fileName'];
$files = json_decode($_REQUEST['files']);
exec("rm -f $fileName", $compressOutput);
$zipCommand = "tar zcvf $fileName";
foreach($files as $file){
	$zipCommand .= ' "'.$file.'"';
}
exec($zipCommand, $compressOutput);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($fileName));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($fileName));
ob_clean();
flush();
readfile($fileName); 
?>
