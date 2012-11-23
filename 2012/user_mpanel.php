<!DOCTYPE html>
<html>
    <head>
        <link href="<?=Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <script src="<?=Yii::app()->theme->baseUrl; ?>/js/jquery.min.js" ></script>
        <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
		<!-- <script src="http://staging.tokbox.com/v0.91/js/TB.min.js" ></script> -->
        <script src="http://static.opentok.com/v0.91/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
        <!-- <script src="http://staging.tokbox.com/v0.91/js/TB.min.js" type="text/javascript" charset="utf-8"></script> -->
        <!-- <script src="http://static.opentok.com/v0.92-alpha/js/TB.min.js" type="text/javascript"></script>-->

        <script src="<?=Yii::app()->theme->baseUrl; ?>/js/bootstrap-dropdown.js" ></script>
    </head>
    <body>
        <div id="container">
            <div class="row">
                <div class="span12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="<?=Yii::app()->request->baseUrl; ?>/article/video">
                            	<?=Yii::t("article","Trilateral video"); ?></a>
                        </li>
                        <li><a href="<?=Yii::app()->request->baseUrl; ?>/article/video/cpanel">
                        	<?=Yii::t("article","Call Translator Only"); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="span8" id="conferencing_area">&nbsp;</div>
                <div class="span4">
                    <form class="well form-inline" id="add_contact_form">
                        <input type="text" class="input-large" id="new_contact" name="follow" placeholder="<?=Yii::t('article','New contact...'); ?>"/>
                        <button type="submit" class="btn btn-success" id="add_contact_button"><?=Yii::t("article","Add"); ?></button>
                    </form>
                    <div class="well">
                        <ul class="nav nav-list" id="contacts-list">
                            <!-- DEBUG PURPOSE-->
                            <li class="nav-header" id="contacts-list-head"><?=Yii::t("article","Contacts"); ?></li>
                        </ul>
                    </div>
                    <div id="btndiv">
                    	<button class="btn btn-success" id="start_conference"><?=Yii::t("article","Start Conference"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
            var HOST = "http://imuyun.com:8001/"
            //var HOST = "http://imuyun.com/muyunvideo/"
            //var HOST = "http://omegaga.net/muyunvideo/"
            var session_id, token;
            var username = "<?=Yii::app()->user->name; ?>";
            var address = "<?=$_SERVER['REMOTE_ADDR']; ?>";
            var session;
            var apiKey = 16937882; 
            var target_language=-1;
            var subscribers = {};
            //DEBUG PURPOSE
            var isPublisher = false;
            var isInVideoCall = false;
 
            TB.setLogLevel(TB.INFO);

            // Obtain contacts
            getContact();

            // Obtain the session ID and token
            $.ajax({
                url: HOST+"session/",
                type: "POST",
                cache: false,
                dataType: "json",
                crossDomain: true,
                data: "username="+username+"&address="+address,
                success: function(data) {
                    session_id = data.sessionId;
                    //token = data.token;
                    
                    // not necessary now
                    //session.connect(apiKey, token);
                    
                }
            });
            
            function showStartBtn() {
            	//alert("show start");
            	$("#btndiv").html('<button class="btn btn-success" id="start_conference"><?=Yii::t("article","Start Conference"); ?></button>');
            }
            
            function showEndBtn() {
            	//alert("show end");
            	$("#btndiv").html('<button class="btn btn-danger" id="end_conference"><?=Yii::t("article","End"); ?></button>');
            }
            
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
                                session_id = data.sessionId;
                                isInVideoCall = true;
                                connect();
                                clearInterval(commingcall);
                                //zjc0920
                                showEndBtn();
                                endConference();
                            }
                        }
                    })
                },
                3000
			);
            
            startConference();
            
            function endConference() {
            	$("#end_conference").click(function() {
            		showStartBtn();
            		$("#conferencing_area").html("&nbsp;");
            		startConference();
            	});
            }

            function startConference() {
            	$("#start_conference").click(function (){
	            	showEndBtn();
	            	isPublisher = true;
	                reciever = $("#contacts-list").find(".active").text();
	                $.ajax({
	                    url: HOST+"videoCallTo/",
	                    type: "POST",
	                    cache: false,
	                    dataType: "json",
	                    crossDomain: true,
	                    // TODO condition
	                    data: "username="+username+"&callToUsername="+reciever+"&language="+target_language,
	                    success: function(data) {
	                        session_id = data.sessionId;
	                        token = data.token;
	                        connect();
	                    }
	                });
	                endConference();
	            });
			}
			
            $(".trans_only_btn").click(function (){
                isPublisher = true;
                target_language = $(this).attr("id");
                    $.ajax({
                        url: HOST+"interpreterVideoCallTo/",
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        crossDomain: true,
                        // TODO condition
                        data: "username="+username+"&targetLanguage="+target_language,
                        success: function(data) {
                            session_id = data.sessionId;
                            token = data.token;
                            connect();
                        }
                    });
            });

            function getContact() {
                $.ajax({
                    url: "<?=Yii::app()->request->baseUrl; ?>/friend/contacts/",
                    type: "POST",
                    cache: false,
                    dataType: "json",
                    data: {},
                    crossDomain: true,
                    success: function(data) {
                    	$('#contacts-list').html('<li class="nav-header" id="contacts-list-head"><?=Yii::t('article','Contacts'); ?></li>');
                        $.each(data.contacts, function(key,val){
                            $('<li class="contact"><a><i class="icon-user"></i>'+
                            	val.email+
                            '</a>').insertAfter($('#contacts-list-head'));
                        });
                        $(".contact").click(function (){
                            if(target = $("#contacts-list").find(".active")){
                                target.removeClass("active");
                            }
                            $(this).addClass("active");
                        });
                    }
                });
            }
            function connect(){
                isInVideoCall = true
                session = TB.initSession(session_id);
                session.addEventListener('sessionConnected', sessionConnectedHandler);
                session.addEventListener('connectionCreated', connectionCreatedHandler);
                session.addEventListener('streamCreated', streamCreatedHandler);
                session.addEventListener('streamDestroyed',streamDestroyedHandler);

                $("#conferencing_area").append("<div id='publisher' />");
                session.connect(apiKey, token);
            }

            function addStream(stream) {
                if (stream.connection.connectionId == session.connection.connectionId) {
                    return;
                }

                $("#conferencing_area").append("<div id='"+stream.streamId+"' />");
                subscribers[stream.streamId] = session.subscribe(stream, stream.streamId);
            }

            function streamCreatedHandler(event) {
                //alert('hey');
                // Subscribe to the newly created streams
                for (var i = 0; i < event.streams.length; i++) {
                    TB.log("streamCreated - connectionId: " + event.streams[i].connection.connectionId);
                    TB.log("streamCreated - connectionData: " + event.streams[i].connection.data);
                    addStream(event.streams[i]);
                }
            }

            function connectionCreatedHandler(event) {
                //alert('hey');
                // TODO
            }
		    function streamDestroyedHandler(event){
		    	//alert("end");
		    	endConference();
		    	window.location.reload();
		    }
            function sessionConnectedHandler(event){
                //alert("hey");
                for (var i = 0; i < event.streams.length; i++) {
                    addStream(event.streams[i]);
                }
                publisher = TB.initPublisher(apiKey, 'publisher', {name:username});
                session.publish(publisher);
            }

            $("#add_contact_form").bind("submit", function () {
                $.ajax({
                    url: "<?=Yii::app()->request->baseUrl; ?>/friend/create/",
                    type: "POST",
                    cache: false,
                    dataType: "json",
                    crossDomain: true,
                    data: $(this).serialize(),
                    success: function (data) {
                    	getContact();
                    }
                });
                return false;
            });
        </script>
    </body>
</html>
