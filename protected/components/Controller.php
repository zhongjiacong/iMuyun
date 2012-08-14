<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @param 传入参数为url中的lang
	 * zjc 因为这个类是所有控制器的底层类，所以在这里加上语言控制模块，配合layout中main的中文，英文链接便可使用
	 */
	public function init()
    {
    	// 注册jquery核心
    	Yii::app()->clientScript->registerCoreScript('jquery');
		
		// 通过cookie来判断系统语言
        if(isset($_COOKIE['SYSLANG']) && $_COOKIE['SYSLANG']!="") {
            Yii::app()->language=$_COOKIE['SYSLANG'];
        }
        else {
            $lang=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            Yii::app()->language=strtolower(str_replace('-','_',$lang[0]));
        }
    }
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}