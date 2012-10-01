<!DOCTYPE html>
<html>
    <head>
        <script src="http://static.opentok.com/v0.91/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="<?=Yii::app()->theme->baseUrl; ?>/js/bootstrap-dropdown.js" ></script>
        <link href="<?=Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div id="container">
            <div class-"row">
                <div class="span12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="<?=Yii::app()->request->baseUrl; ?>/article/video">
                            	<?=Yii::t("article","Working Space"); ?></a>
                        </li>
                        <?php /*
                        <li><a href="<?=Yii::app()->request->baseUrl; ?>/article/video/cpanel">
                        	<?=Yii::t("article","Control Panel"); ?></a></li>
						*/ ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="span8" id="conferencing_area">
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
            var session_id, token, streamCount;
            var namelist = new Array();
            var username = "<?=Yii::app()->user->name; ?>";
            var address = "<?=$_SERVER['REMOTE_ADDR']; ?>";
            var session;
            var apiKey = "16937882"; 
            var subscribers = {};
            var totalUser = 2;
            //DEBUG PURPOSE
            var isPublisher = false;
            var rid=-1;
            var isInVideoCall = false;
            var HOST = "http://imuyun.com:8000/";
            //var HOST = "http://imuyun.com/muyunvideo/"
 
            TB.setLogLevel(TB.DEBUG);

            // Check comming call
            var commingcall = setInterval(function () {
                    $.ajax({
                        url: HOST+"updateStatus/",
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        crossDomain: true,
                        data: "username="+username,
                        success: function(data) {
                            if (data.sessionId != '' && isInVideoCall==false){
                                token = data.token; 
                                callType = data.callType;
                                session_id = data.sessionId;
                                if ( callType == 1 ){
                                    totalUser = 1;}
                                else{
                                    totalUser = 2;}
                                //alert( session_id );
                                isInVideoCall = true;
                                connect();
                                clearInterval(commingcall);
                            }
                        }
                    })
                },
                3000
            )

            function connect(){
                isInVideoCall = true;
                streamCount = 0;
                session = TB.initSession(session_id);
                session.addEventListener('sessionConnected', sessionConnectedHandler);
                session.addEventListener('connectionCreated', connectionCreatedHandler);
                session.addEventListener('streamCreated', streamCreatedHandler);
                session.addEventListener('streamDestroyed',streamDestroyedHandler);
                $("#conferencing_area").append("<div id='publisher' />");
                session.connect(apiKey, token);
            }

            function addStream(stream) {
                if ( stream.name != "interpreter" ){
                    namelist[streamCount]=stream.name;
                    //alert(stream.name);
                    //alert(streamCount);
                    //alert(namelist[streamCount]);
                    streamCount++;
                }
                if (stream.connection.connectionId == session.connection.connectionId) {
                    return;
                }
                $("#conferencing_area").append("<div id='"+stream.streamId+"' />");
                subscribers[stream.streamId] = session.subscribe(stream, stream.streamId);
            }

            function streamCreatedHandler(event) {
                for (var i = 0; i < event.streams.length; i++) {
                    TB.log("streamCreated - connectionId: " + event.streams[i].connection.connectionId);
                    TB.log("streamCreated - connectionData: " + event.streams[i].connection.data);
                    addStream(event.streams[i]);
                }
                if ( streamCount == totalUser && rid==-1 ) {
                    //alert( "talUser is " + totalUser );
                    if ( totalUser == 1 )
                    {namelist[1] = username;}
                    //alert(namelist[0]);
                    //alert(namelist[1]);
                    $.ajax({
                        url: HOST+"startTimeCount/",
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        crossDomain: true,
                        data: "user1="+namelist[0]+"&user2="+namelist[1]+"&translator="+username,
                        success: function(data) {
                            //alert( data.rid);
                            rid = data.rid;
                        }
	                })
	            }
			}

            function subscribeToStream(event){
                for (var i = 0; i < event.streams.length; i++) {
                    addStream(event.streams[i]);
                }
            }

            function connectionCreatedHandler(event) {
                // TODO
            }
            function streamDestroyedHandler(event) {
                //alert("stream Destroyed!");
                if ( rid != -1 ){
                    $.ajax({
                        url: HOST+"endTimeCount/",
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        crossDomain: true,
                        data: "rid="+rid+"&translator="+username,
                        success: function(data) {
                            rid = -1;
                        }
                    });
                }
		    	// 09210821 -- have some problem to really destroyed the connection
		    	$("#conferencing_area").html("&nbsp;");
		    	window.location.reload();
            }
            function sessionConnectedHandler(event){
                //alert(username+" connected");
                
                
                for (var i = 0; i < event.streams.length; i++) {
                    addStream(event.streams[i]);
                }
                publisher = TB.initPublisher(apiKey, 'publisher', {name:"interpreter"});
                session.publish(publisher);
            }
        </script>
    </body>
</html>
