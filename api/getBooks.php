<?php
require 'parseBookXML.php';

$dir    = '../../ebooks/';
@$echo = $_REQUEST['sEcho'];
$files = opendir($dir);
$fileDir = '/var/www/ebooks/';

$bookCounter = 0;
$fileCheck = array();
$responce->sEcho = $echo;
$responce->aaData = array();
while(false !== ($file = readdir($files))){
        if((strlen($file) > 2) && $file != 'lost+found'){
                $file = str_replace('._', '', $file);
                $typeArray = explode('.', $file);
                if(in_array('epub', $typeArray) || in_array('pdf', $typeArray)){
			$fileName = '';
                        for($i = 0; $i < (count($typeArray) - 1); $i++)
                        {
                                if($i > 0){
                                        $fileName .= '.';
                                }
                                $fileName .= $typeArray[$i];
                        }

                        $bookArray = explode(' - ', $fileName);
                        $row = array();
			
			$title = '';
			$author = '';
			for($j = 0; $j < (count($bookArray) - 1); $j++)
                        {
				if($j > 0)
				{
					$title .= ' - ';
				}

				$title .= $bookArray[$j];
			}
			$author = @$bookArray[count($bookArray) - 1];
				
			//Fix Dupes Obtained through Directory Listing Quirk
			if(!in_array($file,$fileCheck))
			{
				array_push($fileCheck, $file);
			}
			else
			{
				//if already in rows don't re-add
				continue;
			}				
			@$bookInfo = getBookInfo($dir . str_replace(array('epub', 'pdf'),array('opf','opf'), $file));
			//setup return variables
			$identifier = null;
			$description = null;
			$date = null;
			$subject = null;
			$jpgFile = null;
			
			if(isset($bookInfo->metadata))
			{	
				$identifierArray = $bookInfo->metadata->children('dc', true)->identifier;
				$identifier = $identifierArray[(count($identifierArray) -1)]->__toString();
				$description = strip_tags ($bookInfo->metadata->children('dc', true)->description);
                        	$date = $bookInfo->metadata->children('dc', true)->date->__toString();
                        	$subjectArray = $bookInfo->metadata->children('dc', true)->subject;
				$subcount = 0;
				foreach($subjectArray as $sub)
				{
					if($subcount > 0)
					{
						 $subject .= ',';
					}
					$subcount++;
					$subject .= $sub->__toString();
                        	}
				if(isset($bookInfo->guide->reference))
					$jpgFile = $bookInfo->guide->reference->attributes()->href;
			}
			$fileLocation = $fileDir . $file;
			$row = array("<input name=\"bookCh[]\" type=\"checkbox\" value=\"$fileLocation\"/>",$author, $title,$subject,
			"<button id=\"MI$bookCounter\" class=\"btn btn-small\" onClick=\"$('#infoRequest').val('MI$bookCounter'); $('#infoRequest').click();\">More Info</button>"
			,$file,$identifier,$description,$date,$jpgFile);
			array_push($responce->aaData, $row);
			$bookCounter++;
                }
        }
} 
$responce->iTotalRecords = count($responce->aaData); 
$responce->iTotalDisplayRecords = count($responce->aaData);
echo json_encode($responce);
?>
