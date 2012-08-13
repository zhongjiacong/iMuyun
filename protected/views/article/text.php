<?php
$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Article', 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);

Yii::app()->clientScript->registerScript('article', "
	$('#Article_tgtlang_id').get(0).selectedIndex = 1;
	
	$('#accept').click(function(){
		if($('#accept').attr('checked') == 'checked') {
			$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
				$('#redbtn').removeAttr('disabled');
			});
		}
		else {
			$('#redbtn').animate({backgroundColor:'rgb(240,240,240)',color:'rgb(109,109,109)'},250,function(){
				$('#redbtn').attr('disabled','disabled');
			});
		}
	});
	
	$('#Article_artcont').keyup(function(){
		$('#wordcount span').html('￥'+wcount($('#Article_artcont').val()) * 0.12);
	});
	
	$('#numform1 div:nth-child(2)').css('background-color','#1BAD7E');
	$('#numform1 div:nth-child(3)').css('background-color','#1BAD7E');
	
	$('dl').click(function(){
		// 注意颜色格式
		if($('#'+$(this).attr('class')+' div:nth-child(2)').css('background-color') == 'rgb(204, 204, 204)'){
			$('.numform div:nth-child(2)').css('background-color','#CCC');
			$('.numform div:nth-child(3)').css('background-color','#CCC');
			$('#'+$(this).attr('class')+' div:nth-child(2)').animate({backgroundColor:'#1BAD7E'},500);
			$('#'+$(this).attr('class')+' div:nth-child(3)').animate({backgroundColor:'#1BAD7E'},500);
		}
	});
	$('#textartbtn').click(function(){
		$('#artcontent').html(
			'<textarea rows=\"10\" cols=\"63\" name=\"Article[artcont]\" id=\"Article_artcont\"></textarea>'+
			'<div class=\"errorMessage\" id=\"Article_artcont_em_\" style=\"display:none\"></div>'
		);
	});
	$('#fileartbtn').click(function(){
		$('#artcontent').html(
			'<input id=\"ytArticle_doccont\" type=\"hidden\" value=\"\" name=\"Article[doccont]\">'+
			'<input name=\"Article[doccont]\" id=\"Article_doccont\" type=\"file\">'+
			'<div class=\"errorMessage\" id=\"Article_doccont_em_\" style=\"display:none\"></div>'
		);
	});
");
Yii::app()->clientScript->registerScript('textform', "
	function selectOrderList() {
		if($('#Article_orderlist').val() == 0) {
			$('#oldOrderList').addClass('hide');
			$('#newOrderList').removeClass('hide');
		}
		else {
			$('#newOrderList').addClass('hide');
			$('#oldOrderList').removeClass('hide');
		}
	}
	
	function wcount(str) {
		// 统计空格数
		var reg = new RegExp(' ',\"gi\");
		var c = str.match(reg);
		var spaceCount = c ? c.length : 0;
		// 计算英文单词数
		var enWcount = en_wcount(str);
		// 计算剩余字符
		var reg = new RegExp(/[a-zA-Z]+/g);// g是往下走
		return str.replace(reg,'').length + enWcount - spaceCount;
	}
	
	/**
	 * 来自网上，计算单词数量 
	 * @param {Object} str
	 */
	function en_wcount(str) {
		var i=0,j=0,c=0;
		var t=/[a-zA-Z]+/;
		var bo=false;
		for(i=0,j=i+1;j<=str.length;i=j++) {
			if(t.test(str.substring(i,j))&&!bo)
			{
				bo=true;
				c++;
			}
			else if(!t.test(str.substring(i,j)))
			{
				bo=false;
			}
		}
		return c;
	}
",CClientScript::POS_HEAD);
?>

<div><?=CHtml::image(Yii::app()->theme->baseUrl.'/img/artcreateimg.jpg','',
	array('class'=>'artcreateimg')); ?></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>