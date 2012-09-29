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
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fieldcat_id, order_id, wordcount, srclang_id, tgtlang_id, edittime', 'safe', 'on'=>'search'),
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
		
		$criteria->order = "`id` DESC";

		$criteria->compare('id',$this->id);
		$criteria->compare('fieldcat_id',$this->fieldcat_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('wordcount',$this->wordcount);
		$criteria->compare('srclang_id',$this->srclang_id);
		$criteria->compare('tgtlang_id',$this->tgtlang_id);
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
		if(0 == strlen($content))
			throw new CHttpException(400,Yii::t('article','Translation content cannot be empty!'));
		
		// remove punctuation reserve space
		$content = preg_replace("/(·|！|￥|…|（|）|—|【|】|；|：|“|”|‘|’|╗|╚|┐|└|《|》|〈|〉|？|，|。|、)+/"," ",
			preg_replace("/[[:punct:]]/"," ",
			preg_replace("/(\f|\n|\r|\t|\v|\d)+/"," ",$content)));
		
		// init
		$price = 10000000;
		switch ($srclang_id) {
			case 0:
				$content = preg_replace("/(\s)+/", "",
					preg_replace("|[a-z ]|is","",$content));
				$wordcount = mb_strlen($content,'utf-8');
				$price = Article::model()->difficultyCoefficient($srclang_id, $content) * $wordcount * 0.12;
				break;
			case 1:
				$wordcount = str_word_count(
					preg_replace("/[\x{4e00}-\x{9fff}\x{f900}-\x{faff}]/u", " ", $content));
				$price = Article::model()->difficultyCoefficient($srclang_id, $content) * $wordcount * 0.12;
				break;
			/*case 2:
				$wordcount = strlen(preg_replace("/ +/", " ", $content)) - strlen(preg_replace("/ +/", "", $content));
				break;
			case 3:
				$wordcount = strlen(preg_replace("/ +/", " ", $content)) - strlen(preg_replace("/ +/", "", $content));
				break;*/
			default:
				throw new CHttpException(400,Yii::t('article','Wrong Source Language!'));
				break;
		}
		
		return array(
			'wordcount'=>$wordcount,
			'price'=>round($price,3),
		);
	}

	public function difficultyCoefficient($srclang_id,$content)
	{
		// init
		$coefficient = 8;
		switch ($srclang_id) {
			case 0:
				$coefficient = 0;
				$wordcount = mb_strlen($content,'utf-8');
				$seg = Segmentation::getInstance();
				$result = $seg->getWords($content);
				$arrcount = 0;
				foreach($result as $key => $arr) {
					foreach($arr as $key => $value) {
						$word = Chinese::model()->find("`word` = :word",array(":word"=>addslashes($value["word"])));
						$nums = (NULL == $word)?1:$word->nums;
						$coefficient += 8 / sqrt($nums);
						$arrcount++;
					}
				}
				$coefficient = (0 == $arrcount)?8:$coefficient / $arrcount;
				break;
			case 1:
				$coefficient = 0;
				$wordcount = str_word_count(
					preg_replace("/[\x{4e00}-\x{9fff}\x{f900}-\x{faff}]/u", " ", $content));
				$result = explode(" ", $content);
				foreach($result as $key => $value) {
					$word = English::model()->find("`word` = :word",array(":word"=>$value));
					$nums = (NULL == $word)?1:$word->nums;
					$coefficient += 8 / sqrt($nums);
				}
				$coefficient = (0 == count($result))?8:$coefficient / count($result);
				break;
			default:
				break;
		}
		
		return $coefficient;
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
				shell_exec("iconv ".$phypath." -f gb18030 -t utf-8 > ".$phypath."_");
				shell_exec("rm -rf ".$phypath);
				shell_exec("cp -f ".$phypath."_ ".$phypath);
				shell_exec("rm -rf ".$phypath."_");
				$artcont = shell_exec('cat '.$phypath);break;
			case $allowtype[2]:
				$artcont = shell_exec('antiword -m UTF-8.txt '.$phypath);break;
			case $allowtype[3]:
				$artcont = shell_exec('pdftotext -layout '.$phypath.' /dev/stdout');break;
			case $allowtype[4]:
				$artcont = shell_exec('xls2txt '.$phypath);break;
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
		
		if(NULL != $text->filename) {
			$path = pathinfo(urlencode($text->filename));
	
			$phypath = dirname(__FILE__).'/../../public/file/'.$time.".".$path["filename"].".".$path["extension"];
			$urlpath = Yii::app()->request->baseUrl.'/public/file/'.$time.".".urlencode($path["filename"]).".".$path["extension"];
	
			return $physical?$phypath:$urlpath;
		}
		return NULL;
	}

	public function saveTransFile($text_id,$doccont)
	{
		date_default_timezone_set('PRC');
		
		$text = Article::model()->findByPk($text_id);
		$time = strtotime($text->edittime);
		$comptime = date("Y-m-d H:i:s");
		
		// -- delete last file -- //
		$spreadtable = Spreadtable::model()->find("`article_id` = :article_id and `translator_id` = :translator_id",
			array(":article_id"=>$text_id,":translator_id"=>Yii::app()->user->getId()));
		if(NULL != $spreadtable->filename) {
			$path = pathinfo(urlencode($spreadtable->filename));
			$filepath = dirname(__FILE__).'/../../public/file/'.$time.".".$path["filename"].".".
				Yii::app()->user->getId().".".strtotime($spreadtable->comptime).".".$path["extension"];
			if(is_file($filepath))
				unlink($filepath);
		}
				
		$path = (NULL != $text->filename)?pathinfo(urlencode($text->filename)):pathinfo(urlencode($doccont->getName()));
		
		Spreadtable::model()->updateAll(array('filename'=>$doccont->getName(),'comptime'=>$comptime),
			"`article_id` = :article_id and `translator_id` = :translator_id",
			array(":article_id"=>$text_id,"translator_id"=>Yii::app()->user->getId()));
		
		$phypath = dirname(__FILE__).'/../../public/file/'.$time.".".$path["filename"].".".
			Yii::app()->user->getId().".".strtotime($comptime).".".$path["extension"];
		
		$doccont->saveAs($phypath);
	}
	
	public function transFileAddr($text_id,$user_id)
	{
		date_default_timezone_set("PRC");
		
		$spreadtable = Spreadtable::model()->find("`translator_id` = :translator_id and `article_id` = :article_id",
			array(":translator_id"=>$user_id,":article_id"=>$text_id));
		$text = Article::model()->findByPk($text_id);
		$time = strtotime($text->edittime);
		$comptime = strtotime($spreadtable->comptime);
		
		$path = (NULL != $text->filename)?pathinfo(urlencode($text->filename)):pathinfo(urlencode($spreadtable->filename));
		
		$phypath = dirname(__FILE__).'/../../public/file/'.$time.".".$path["filename"].".".
			$user_id.".".$comptime.".".$path["extension"];
		$urlpath = Yii::app()->request->baseUrl.'/public/file/'.$time.".".urlencode($path["filename"]).".".
			$user_id.".".$comptime.".".$path["extension"];
		
		return array(
			'filename'=>urldecode($path["basename"]),
			'phypath'=>$phypath,
			'urlpath'=>$urlpath,
		);
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
		$path = pathinfo($file);
		
	    // 1. rename
	    $newfile = $path["dirname"]."/".$path["filename"].'_.zip';
	    if(!is_file($newfile))
	        shell_exec('cp -f '.$file.' '.$newfile);
		
	    // 2. zip
	    $zip = new ZipArchive();
	    $content = "";
	    if($zip->open($newfile) === true) {
	        for($i = 0; $i < $zip->numFiles; $i++) {
	            $entry = $zip->getNameIndex($i);
	            if(pathinfo($entry, PATHINFO_BASENAME) == "document.xml") {
	                $zip->extractTo($path["dirname"]."/".$path["filename"]."_", array($entry));
	                $filepath = $path["dirname"]."/".$path["filename"]."_/".$entry;
	                $content = strip_tags(file_get_contents($filepath));
	                break;
	            }
	        }
	        $zip->close();
	        // 3. rmdir
	        $this->rrmdir($path["dirname"]."/".$path["filename"]."_");
	        unlink($path["dirname"]."/".$path["filename"]."_.zip");
	        return $content;
	    }
	    return "";
	}
	
	public function delArt($article)
	{
		if(!Spreadtable::model()->isReceived($article->id)) {
			// recursive deletion
			$artsent = Sentence::model()->findAll('`article_id` = :id',array(':id'=>$article->id));
			foreach ($artsent as $key => $sentvalue) {
				Sentence::model()->deleteByPk($sentvalue->id);
			}
			// delete article price
			Spreadtable::model()->deleteAll('`article_id` = :id',array(':id'=>$article->id));
			if(NULL != $article->filename)
				unlink(Article::model()->fileAddr($article->id));
			Article::model()->deleteByPk($article->id);
			
			return TRUE;
		}
		return FALSE;
	}
	
	public function myStart($article_id) {
		$article = Spreadtable::model()->find("`article_id` = :article_id AND `translator_id` = :translator_id",
			array(":article_id"=>$article_id,":translator_id"=>Yii::app()->user->getId()));

		return (NULL != $article->starttime);
	}
	
	public function startTime($article_id)
	{
		$article = Spreadtable::model()->findAll("`article_id` = :article_id",array(":article_id"=>$article_id));
		$isnull = TRUE;
		date_default_timezone_set("PRC");
		$timearr = array();
		foreach ($article as $key => $value) {
			if(NULL != $value->starttime) {
				$timearr[$key] = strtotime($value->starttime);
				$isnull = FALSE;
			}
		}
		return $isnull?NULL:min($timearr);
	}
	
	public function compTime($article_id)
	{
		$article = Spreadtable::model()->findAll("`article_id` = :article_id",array(":article_id"=>$article_id));
		$isnull = TRUE;
		date_default_timezone_set("PRC");
		$timearr = array();
		foreach ($article as $key => $value) {
			if(NULL != $value->comptime) {
				$timearr[$key] = strtotime($value->comptime);
				$isnull = FALSE;
			}
		}
		return $isnull?NULL:max($timearr);
	}

}