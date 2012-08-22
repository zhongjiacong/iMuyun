<?php

/**
 * This is the model class for table "{{c_article}}".
 *
 * The followings are the available columns in table '{{c_article}}':
 * @property integer $id
 * @property integer $fieldcat_id
 * @property integer $order_id
 * @property integer $wordcount
 * @property integer $srclang_id
 * @property integer $tgtlang_id
 * @property string $starttime
 * @property string $comptime
 * @property string $edittime
 */
class Article extends CActiveRecord
{
	public $artcont;
	public $doccont;
	public $orderlist;
	public $subject;
	
	public $email;
	public $mobile;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{c_article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('srclang_id, tgtlang_id', 'required'),
			//array('doccont', 'file', 'types'=>'jpg, gif, png'),
			array('doccont', 'file',
				'types' => 'pdf',
			    'maxSize' => 1024 * 1024 * 10, // 10MB
			    'tooLarge' => 'The file was larger than 10MB. Please upload a smaller file.',
			    'on' => 'doccreate',
			),
			array('fieldcat_id, order_id, wordcount, srclang_id, tgtlang_id', 'numerical', 'integerOnly'=>true),
			array('starttime, comptime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fieldcat_id, order_id, wordcount, srclang_id, tgtlang_id, starttime, comptime, edittime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('article','ID'),
			'fieldcat_id' => 'Fieldcat',
			'order_id' => Yii::t('article','Order'),
			'wordcount' => Yii::t('article','Word Count'),
			'srclang_id' => Yii::t('article','Source Language'),
			'tgtlang_id' => Yii::t('article','Target Language'),
			'starttime' => Yii::t('article','Start Time'),
			'comptime' => Yii::t('article','Complete Time'),
			'edittime' => Yii::t('article','Edit Time'),
			// ext
			'artcont' => Yii::t('article','Article Content'),
			'doccont' => Yii::t('article','Document Content'),
			'orderlist' => 'Order List',
			'subject' => Yii::t('article','Subject'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fieldcat_id',$this->fieldcat_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('wordcount',$this->wordcount);
		$criteria->compare('srclang_id',$this->srclang_id);
		$criteria->compare('tgtlang_id',$this->tgtlang_id);
		$criteria->compare('starttime',$this->starttime,true);
		$criteria->compare('comptime',$this->comptime,true);
		$criteria->compare('edittime',$this->edittime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return 得到未付款的订单，用于新提交的文档可以选择加入其中的订单
	 */
	public function getPendingOrder()
	{
		$pendingOrder = array();
		$orders = Order::model()->findAll('`paytime` IS NULL AND `customer_id` = :customer',
			array(':customer'=>Yii::app()->user->getId()));
		if($orders != NULL) {
			$orders = array_reverse($orders);
			foreach ($orders as $key => $value) {
				// 去掉重复的选项
				if(!in_array($value->subject,$pendingOrder))
					$pendingOrder[$value->id] = $value->subject;
			}
		}
		return $pendingOrder;
	}
	
	public function wordCount($srclang_id,$content) {
		switch ($srclang_id) {
			case 0:
				$content = preg_replace("|[a-z ]|is","",$content);
				$wordcount = mb_strlen($content,'utf-8');
				break;
			
			case 1:
				$total = mb_strlen($content,'utf-8');
				$content = preg_replace("|[a-z]|is","",$content);
				$wordcount = $total - mb_strlen($content,'utf-8');
				break;
			
			case 2:
				$total = mb_strlen($content,'utf-8');
				$content = preg_replace("|[a-z]|is","",$content);
				$wordcount = $total - mb_strlen($content,'utf-8');
				break;
			
			case 3:
				$total = mb_strlen($content,'utf-8');
				$content = preg_replace("|[a-z]|is","",$content);
				$wordcount = $total - mb_strlen($content,'utf-8');
				break;
			
			default:
				$wordcount = 0;
				break;
		}
		return $wordcount;
	}
	
	public function getText($text_id)
	{
		$artcont = "";
		$sentence = Sentence::model()->findAll('`article_id` = :id',array(':id'=>$text_id));
		foreach ($sentence as $key => $value) {
			$artcont .= $value->original;
		}
		return $artcont;
	}
	
	public function getTrans($text_id)
	{
		$transcont = "";
		$sentence = Sentence::model()->findAll('`article_id` = :id',array(':id'=>$text_id));
		foreach ($sentence as $key => $value) {
			$transcont .= $value->translation;
		}
		return $transcont;
	}
	
	public function fileAddr($text_id,$physical = TRUE)
	{
		date_default_timezone_set('PRC');
		
		$text = Article::model()->findByPk($text_id);
		$time = strtotime($text->edittime);
		$name = $text->filename;
		
		$namearr = explode('.', $name);
		$type = '.'.$namearr[count($namearr)-1];
		unset($namearr[count($namearr)-1]);
		$filename = implode('.', $namearr);
		
		return $physical?dirname(__FILE__).'/../../public/file/'.$time.sha1($filename).$type:
			Yii::app()->request->baseUrl.'/public/file/'.$time.sha1($filename).$type;
	}
	
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

}