<?php

/**
 * 用户类型的一些操作
 */
class Accountcat {
	
	function __construct() {}
	
	public static function getCat()
	{
		$_cats = Yii::app()->params['accountcat'];
		
		// 只有管理员能够添加为译员、客服和普通管理员；可以弄一个申请，管理员审核之后便可更改类型
		if(User::model()->isAdmin())
			return $_cats;
		else {
			$catArr = array_chunk($_cats, 5);
			return $catArr[0];
		}
	}

}
