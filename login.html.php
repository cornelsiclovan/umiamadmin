<?php include_once 'includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
<!--Bootstrap include files-->

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>U'miam</title>
	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!--End bootstrap include files -->
	
	
	<head>
		<title>Log In</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		
		<link rel="icon" href="img/ic_cloche.png">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    	<div class="container-fluid">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
				<a class="navbar-brand" href="">U'miam</a>
				
			</div>
				<ul class="nav navbar-nav navbar-right">
				    <li class="navbar-brand" style="color:red; font-size:100%" id="failure"></li>
				    <li class="navbar-brand" style="color:green; font-size:100%" id="success"></li>
                </ul>
			
		</div>
		</nav>	
		<div class="container">
        
            <div class="col-md-4 col-md-offset-0">
                <div class="login-panel panel panel-red">
                    <div class="panel-heading">
                        <h3 class="panel-title">Owner</h3>
                    </div>
                    <div class="panel-body ">
                        <form action="" method="post" autocomplete="off">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" style="width:65%;" placeholder="Password" name="password" type="password"/>
									<input type="submit" style="float:right; margin-top:-35px; padding:5px 20px;" class="btn btn-lg btn-info" value="Log in"/>
								</div>
                                <div class="checkbox" style="float:left; margin-left:-15px">
                                    <label>
                                        <a href="?new_owner">New user?</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="isOwner" value="1">
								<input type="hidden" name="action" value="login"/>
								<p style="margin-top:10px; float:right">forgot password? <a href="#">click here</a></p>
                            </fieldset>
                        </form>
                    </div>
				</div>
				
			</div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Staff</h3>
                    </div>
                    <div class="panel-body ">
                        <form action="" method="post" autocomplete="off">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" style="width:65%;" placeholder="Password" name="password" type="password"/>
									<input type="submit" style="float:right; margin-top:-35px; padding:5px 20px;" class="btn btn-lg btn-info" value="Log in"/>
								</div>
                                <div class="checkbox" style="float:left; margin-left:-15px">
                                    <label>
                                        <a href="?new_staff">New user?</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="isStaff" value="1">
								<input type="hidden" name="action" value="login"/>
								<p style="margin-top:10px; float:right">Forgot password? <a href="#">click here</a></p>
                            </fieldset>
                        </form>
                    </div>
				</div>
			</div>
		
		
            
		  
			<div class="col-md-4 col-md-offset-1">
			
			</div>
			
			
			
			<div class="col-md-4 col-md-offset-3">
			
			</div>
		</div>
	
		
	
	<!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	<script src="js/gradient.js"></script>
	
	<script>
		function O(obj)
		{
			if (typeof obj == 'object') return obj
				else return document.getElementById(obj)
		}
		
		function checkPasswordMatchStaff()
		{
			var password = $("#newpass_staff").val();
			var confirmPassword = $("#newpass_confirm").val();
			
			if (password != confirmPassword)
			{
				$("#divcheckPasswordMatchStaff").html("<span style='color:red'>&nbsp;&#x2718; Parola neconfirmata</span>");
				$("#submit-locatar").prop("disabled", true);
			}
			else
			{
				$("#divcheckPasswordMatchStaff").html("<span style='color:green'>&nbsp;&#x2714; Parola confirmata</span>");
				$("#submit-locatar").prop("disabled", false);
			}		
		}
		
		
		function checkPasswordMatch() {
			var password = $("#newpass_owner").val();
			var confirmPassword = $("#newpass_confirm").val();

			if (password != confirmPassword)
			{
				$("#divCheckPasswordMatch").html("<span style='color:red'>&nbsp;&#x2718; Parola neconfirmata</span>");
				$("#register-submit").prop("disabled", true);
			}
			else
			{
				$("#divCheckPasswordMatch").html("<span style='color:green'>&nbsp;&#x2714; Parola confirmata</span>");
				$("#register-submit").prop("disabled", false);
			}		
		}
		
		
		function checkOwnerUser(user)
		{
			if(user.value == ''){
				O('info_locatar').innerHTML = ''
				return
			}
			
			params = "user=" + user.value
			request = new ajaxRequest()
			request.open("POST", "checkOwnerUser.php", true)
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			request.setRequestHeader("Content-length", params.length)
			request.setRequestHeader("Connection", "close")
			
			request.onreadystatechange = function()
			{
				if (this.readyState == 4)
					if (this.status == 200)
						if (this.responseText != null){
							O('info_locatar').innerHTML = this.responseText
						}
			}
			request.send(params)
			
		}
		
		
		function checkOwnerCode(user)
		{
			if(user.value == ''){
				O('info_code').innerHTML = ''
				return
			}
			
			params = "user=" + user.value
			request = new ajaxRequest()
			request.open("POST", "checkOwnerCode.php", true)
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			request.setRequestHeader("Content-length", params.length)
			request.setRequestHeader("Connection", "close")
			
			request.onreadystatechange = function()
			{
				if (this.readyState == 4)
					if (this.status == 200)
						if (this.responseText != null){
							O('info_code').innerHTML = this.responseText
						}
			}
			request.send(params)
			
		}
		
		function checkOwnerEmail(user)
		{
			if(user.value == ''){
				O('info_email').innerHTML = ''
				return
			}
			
			params = "user=" + user.value
			request = new ajaxRequest()
			request.open("POST", "checkOwnerEmail.php", true)
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			request.setRequestHeader("Content-length", params.length)
			request.setRequestHeader("Connection", "close")
			
			request.onreadystatechange = function()
			{
				if (this.readyState == 4)
					if (this.status == 200)
						if (this.responseText != null){
							O('info_email').innerHTML = this.responseText
						}
			}
			request.send(params)
			
		}
		
		
		
		function ajaxRequest()
		{
			try { var request = new XMLHttpRequest() }
			catch(e1) {
				try { request = new ActiveXObject("Msxml2.XMLHTTP") }
				catch(e2) {
					try { request = new ActiveXObject("Microsoft.XMLHTTP") }
					catch(e3) {
						request = false
			} } }
			return request
		}
	</script>
	</body>
</html>
    