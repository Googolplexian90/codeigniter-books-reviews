<div class="row">
	<div class="col-xs-12">
		<h1
		>Login/Registration</h1>
	</div>
</div>
<div class="row">
<?php if($this->session->flashdata('error')) { ?>
	<div class="errors col-xs-12">
		<?= $this->session->flashdata('error') ?>
	</div>
<?php } ?>
	<div class="col-xs-12 col-sm-6">
		<form action="/sign-up" method="post">
			<h2>Sign-Up</h2>
			<div class="form-group">
				<label for="name">Name:</label><input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="alias">Alias:</label><input type="text" name="alias" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email:</label><input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password:</label><input type="password" name="password" class="form-control">
				<p class="help-block">Password must be at least 8 characters long</p>
			</div>
			<div class="form-group">
				<label for="confirm">Confirm Password:</label><input type="password" name="confirm" class="form-control">
			</div>
			<input type="submit" class="btn btn-default" value="Register">
		</form>
	</div>
	<div class="col-xs-12 col-sm-6">
		<form action="/sign-in" method="post">
			<h2>Sign-In</h2>
			<div class="form-group">
				<label for="email">Email:</label><input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password:</label><input type="password" name="password" class="form-control">
			</div>
			<input type="submit" class="btn btn-default" name="action" value="Login">
		</form>
	</div>
</div>