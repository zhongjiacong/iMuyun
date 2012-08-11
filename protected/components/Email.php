<?php
/**
 * 
 */
class Email {
	
	function __construct() {
		
	}
    
    public static function sendEmail($address, $subjet, $body, $options = array())
    {
        Yii::app()->mailer->CharSet = "UTF-8";
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->SMTPDebug  = 1;
        Yii::app()->mailer->SMTPAuth = TRUE;
        Yii::app()->mailer->Host = Yii::app()->params['mail']['Host'];
        Yii::app()->mailer->Port = 25;
        Yii::app()->mailer->Username  = Yii::app()->params['mail']['Username'];
        Yii::app()->mailer->Password   = Yii::app()->params['mail']['Password'];
        Yii::app()->mailer->From = Yii::app()->params['mail']['From'];
        Yii::app()->mailer->FromName = Yii::app()->params['mail']['FromName'];
        if(isset($options['addressname']))
            Yii::app()->mailer->AddAddress($address,$options['addressname']);
        else
            Yii::app()->mailer->AddAddress($address);
        Yii::app()->mailer->Subject = $subjet;
        Yii::app()->mailer->MsgHTML(eregi_replace("[\]",'',$body));
        //Yii::app()->mailer->Body = $body;
        Yii::app()->mailer->Send();
    }
    
}
