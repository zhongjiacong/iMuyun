<?php
	$content = "test test? test.";
	$content = preg_replace("/[(?|…)]+/",".",$content);
	echo $content;
?>