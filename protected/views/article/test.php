<input type="button" id="myinput" name="myinput" value="开始" />

<script type="text/javascript">
	$("#myinput").click(function() {
		$("#audio").html(
			'<audio controls="controls" autoplay="autoplay">'+
				'<source src="<?=Yii::app()->theme->baseUrl; ?>/audio/SuperMario.mp3" type="audio/mp3" />'+
				'<source src="<?=Yii::app()->theme->baseUrl; ?>/audio/SuperMario.wav" type="audio/wav" />'+
				'Your browser does not support the audio element.'+
			'</audio>'
		);
	});
</script>