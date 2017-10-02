
<div class="container">
<div class="col-md-4 col-md-offset-8">
<div class="login-panel panel panel-secondary" style="margin-top:-10px">
	<div class="panel-heading">
		<h3 class="panel-title">New staff? &nbsp; Register</h3>
	</div>
	<div class="panel-body">
		<form action="?addstaff" method="post" autocomplete="off">
			<fieldset>
				<div class="form-group">
					<input class="form-control" placeholder="Name" name="name_staff" type="nume" required='required' autofocus/>
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="E-mail" name="email_staff" type="email" autofocus onBlur="checkOwnerUser(this)"/>
					<span id="info_locatar"></span>
				</div>
				<div class="form-group">
					<input class="form-control" id="newpass_staff" placeholder="Password" name="password_staff" type="password_staff" onChange="checkPasswordMatchStaff()">
				</div>
				<div class="form-group">
					<input class="form-control" id="newpass_confirm" placeholder="Confirm password" name="password_staff_conf" type="password_staff_conf" onChange="checkPasswordMatchStaff()">
					<span class="registrationFormAlert" id="divcheckPasswordMatchStaff"></span>
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Owner Code" name="owner_code" type="owner_code" onChange="checkOwnerCode(this)">
					<span id="info_code"></span>
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Owner email" name="email_owner" type="email_owner" onChange="checkOwnerEmail(this)">
					<span id="info_email"></span>
				</div>
				<input id="submit-locatar" type="submit" style="padding:5px 20px;" class="btn btn-lg btn-secondary" value="Register"/>
			</fieldset>
		</form>
	</div>
</div>
</div>
</div>