function langSwitch(lang) {
	$.cookie('SYSLANG',lang,{expires:7,path:'/'});
	document.location.reload();
}
