<?php
header("Content-type: text/html; charset=utf-8");
function rrmdir($dir) {
    if(is_dir($dir)) {
        $objects = scandir($dir);
        foreach($objects as $object) {
            if($object != "." && $object != "..") {
                if(filetype($dir."/".$object) == "dir")
                    rrmdir($dir."/".$object);
                else
                    unlink($dir."/".$object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

function docx2text($file) {
    // 1. rename
    $newfile = substr($file,0,strlen($file)-5).'_.zip';
    if(!is_file($newfile))
        shell_exec('cp -f '.$file.' '.$newfile);
    // 2. zip
    $content = "";
    $zip = new ZipArchive();

    if($zip->open($newfile) === true) {
        for($i = 0; $i < $zip->numFiles; $i++) {
            $entry = $zip->getNameIndex($i);
            if(pathinfo($entry, PATHINFO_BASENAME) == "document.xml") {
                $zip->extractTo(pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file, PATHINFO_FILENAME), array($entry));
                $filepath = pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file,PATHINFO_FILENAME)."/".$entry;
                $content = strip_tags(file_get_contents($filepath));
                break;
            }
        }
        $zip->close();
        // 3. rmdir
        rrmdir(pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file, PATHINFO_FILENAME)."_");
        echo $content;
    }
    else {
        echo "";
    }
}

echo docx2text(dirname(__FILE__).'/public/file/test.docx');
?>
