
<div class="container">
<div class="col-md-4 col-md-offset-0">
	<div class="login-panel panel panel-secondary" style="margin-top:-10px">
		<div class="panel-heading">
			<h3 class="panel-title">New owner? &nbsp; Register</h3>
		</div>
		<div class="panel-body">
			<form action="?addowner" method="post" autocomplete="off">
				<fieldset>
					<div class="form-group">
						<input class="form-control" placeholder="Name" name="name_owner" type="name" required='required' autofocus/>
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="E-mail" name="email_owner" type="email" autofocus onBlur="checkOwnerUser(this)"/>
						<span id="info_locatar"></span>
					</div>
					<div class="form-group">
						<input class="form-control" id="newpass_staff" placeholder="Password" name="password_owner" type="password" onChange="checkPasswordMatchStaff()">
					</div>
					<div class="form-group">
						<input class="form-control" id="newpass_confirm" placeholder="Confirm password" name="password_owner_conf" type="password" onChange="checkPasswordMatchStaff()">
						<span class="registrationFormAlert" id="divcheckPasswordMatchStaff"></span>
					</div>
					<input id="submit-locatar" type="submit" style="padding:5px 20px;" class="btn btn-lg btn-secondary" value="Register"/>
				</fieldset>
			</form>
		</div>
	</div>
</div>
</div>
<div class='col-md-4 col-md-offset-1'>
							 
</div>