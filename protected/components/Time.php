<?php
/**
 * 
 */
class Time {
	
	function __construct() {}
	
	public static function timeDisplay($strtime)
	{
		date_default_timezone_set('PRC');
		$time = strtotime($strtime);
		// 判断是否在同一年
		if(date('Y',$time) == date('Y'))
			return date('m-d H:i',$time);
		return date('Y-m-d H:i',$time);
	}
	
}
