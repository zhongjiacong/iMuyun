<?php

// using Yii::app()->params['paramName']
return array(
	// this is used in contact page
	'adminEmail'=>'zhongjiacong@gmail.com',
    
    'mail'=>array(
        'Host'=>'smtp.163.com',
        'Username'=>'muyunfanyi',
        'Password'=>'muyunfanyi2012',
        'From'=>'muyunfanyi@163.com',
        'FromName'=>'牧云翻译',
    ),
    
	// 系统性别
	'gender'=>array(
		'Other',
		'Female',
		'Male',
	),
	
	// 用户类型
	'accountcat'=>array(
		'Personal Account',
		'Business Account',
		'Government Account',
		'Institutions Account',
		'Other Account',
	),
	
	'privilege'=>array(
		'Customer',
		'Customer Service',
		'Translator',
		'Senior Translator',
		'Administrator',
		'Super Administrator',
	),
	
	// 需要进行领域分类的对象
	'classifyobject'=>array(
		'User',
		'Article',
	),
	
	// 领域
	'fieldcategory'=>array(
		'IT'=>array(
			'Computer',
			'Software',
		),
	),
	
	// 发票类型
	'invoicecontent'=>array(
		'Translation',
	),
	
	// 要配合着单词数量判断来改
	'language'=>array(
		'Chinese',
		'English',
		'Spanish',
		'Arabic',
		/*'Japanese',
		'Korean',
		'German',
		'French',
		'Russian',
		'Portuguese',
		'Persian',
		'Swedish',*/
	),
	
	'comptime'=>array(
		'15 mins',
		'30 mins',
		'1 hour',
		'3 hours',
		'1 day',
		'3 days',
	),
	
	// 订单状态
	'orderstate'=>array(
	),
	
	/*'consumeway'=>array(
		'Web Consume',
		'App Consume',
		'Text Spending',
		'Video Spending',
		'Other',
	),*/
	
	'product'=>array(
		'Video',
		'Text',
	),

);
