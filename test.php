<?php
/** 
* Read Docx File 
* 
* @param string $file filepath 
* @return string file content 
*/ 
function parseWord($file) { 
    $content = ""; 
    $zip = new ZipArchive ( ); 
    if ($zip->open ( $file ) === tr ) { 
        for($i = 0; $i < $zip->numFiles; $i ++) { 
            $entry = $zip->getNameIndex ( $i ); 
            if (pathinfo ( $entry, PATHINFO_BASENAME ) == "document.xml") { 
                $zip->extractTo ( pathinfo ( $file, PATHINFO_DIRNAME ) . "/" . pathinfo ( $file, PATHINFO_FILENAME ), array ( 
                        $entry 
                ) ); 
                $filepath = pathinfo ( $file, PATHINFO_DIRNAME ) . "/" . pathinfo ( $file, PATHINFO_FILENAME ) . "/" . $entry; 
                $content = strip_tags ( file_get_contents ( $filepath ) ); 
                break; 
            } 
        } 
        $zip->close (); 
        rrmdir ( pathinfo ( $file, PATHINFO_DIRNAME ) . "/" . pathinfo ( $file, PATHINFO_FILENAME ) ); 
        return $content; 
    } else { 
        return ""; 
    } 
}
// 1. rename
// $newfile = '_'.substr($file,0,strlen($file)-4).'zip';
// shell_exec('cp -f '.$file.' '.$newfile);
// 2. zip
//
// 3.
// echo parseWord(dirname(__FILE__).'/public/file/test.docx');
?>