<?php
$seg = Segmentation::getInstance();
$result = $seg->getWords("我是一个女生");
foreach($result as $key => $arr) {
	foreach($arr as $key => $value) {
		print_r($value);
		echo "<br />";
	}
}
?>