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
	// judge the order type, old or new
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
	
	/**
	 * @param 源语言，文本
	 * @return 字数，报价
	 */
	public function textInfor($srclang_id,$content) {
		// remove punctuation
		$content = preg_replace("/(·|！|￥|…|（|）|—|【|】|；|：|“|”|‘|’|╗|╚|┐|└|《|》|〈|〉|？|，|。|、)+/","",
			preg_replace("/[[:punct:]]/","",$content));
		
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
		
		// 待完善
		$price = $wordcount / 5;
		
		return array(
			'wordcount'=>$wordcount,
			'price'=>$price,
		);
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
	
	public function saveFile($doccont)
	{
		// cannot upload file format not in the list of allow type
		$allowtype = Yii::app()->params["doctype"];
		if(!in_array($doccont->type, $allowtype))
			throw new CHttpException(400,Yii::t('article','Wrong file format!'));
		
		date_default_timezone_set('PRC');
		$time = time();
		
		$path = pathinfo(urlencode($doccont->getName()));
		$phypath = dirname(__FILE__).'/../../public/file/'.$time.".".$path["filename"].".".$path["extension"];
		$doccont->saveAs($phypath);
		
		// read .doc, .pdf, .xls file though web and count the words
		switch ($doccont->type) {
			case $allowtype[0]:
				$artcont = Article::model()->docx2text($phypath);break;
			case $allowtype[1]:
				$artcont = shell_exec('cat '.$phypath);break;
			case $allowtype[2]:
				$model->artcont = shell_exec(dirname(__FILE__).'/../extensions/antiword-0.37/antiword -m UTF-8.txt '.$phypath);break;
			case $allowtype[3]:
				$model->artcont = shell_exec('pdftotext -layout '.$phypath.' /dev/stdout');break;
			case $allowtype[4]:
				$model->artcont = shell_exec('xls2txt '.$phypath);break;
			default:
				throw new CHttpException(400,Yii::t('article','Wrong file format!'));break;
		}
		
		return array(
			'allowtype'=>$allowtype,
			'time'=>$time,
			'phypath'=>$phypath,
			'filename'=>urldecode($path["basename"]),
			'artcont'=>$artcont,
		);
	}
	
	public function fileAddr($text_id,$physical = TRUE)
	{
		date_default_timezone_set('PRC');

		$text = Article::model()->findByPk($text_id);
		$time = strtotime($text->edittime);
		
		$path = pathinfo(urlencode($text->filename));
		throw new CHttpException(400,$path["filename"]);

		$urlpath = Yii::app()->request->baseUrl.'/public/file/'.$time.".".addslashes($path["filename"]).".".$path["extension"];
		$phypath = dirname(__FILE__).'/../../public/file/'.$time.".".$path["filename"].".".$path["extension"];

		return $physical?$phypath:$urlpath;
	}
	
	function rrmdir($dir) {
	    if(is_dir($dir)) {
	        $objects = scandir($dir);
	        foreach($objects as $object) {
	            if($object != "." && $object != "..") {
	                if(filetype($dir."/".$object) == "dir")
	                    $this->rrmdir($dir."/".$object);
	                else
	                    unlink($dir."/".$object);
	            }
	        }
	        reset($objects);
	        rmdir($dir);
	    }
	}

	// linux
	function docx2text($file) {
	    // 1. rename
	    $newfile = pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file, PATHINFO_FILENAME).'_.zip';
	    if(!is_file($newfile))
	        shell_exec('cp -f '.$file.' '.$newfile);
	    // 2. zip
	    $content = "";
	    $zip = new ZipArchive();
	
	    if($zip->open($newfile) === true) {
	        for($i = 0; $i < $zip->numFiles; $i++) {
	            $entry = $zip->getNameIndex($i);
	            if(pathinfo($entry, PATHINFO_BASENAME) == "document.xml") {
	                $zip->extractTo(pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file, PATHINFO_FILENAME)."_", array($entry));
	                $filepath = pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file,PATHINFO_FILENAME)."_/".$entry;
	                $content = strip_tags(file_get_contents($filepath));
	                break;
	            }
	        }
	        $zip->close();
	        // 3. rmdir
	        $this->rrmdir(pathinfo($file, PATHINFO_DIRNAME)."/".pathinfo($file, PATHINFO_FILENAME)."_");
	        return $content;
	    }
	    else {
	        return "";
	    }
	}

}