<body>
<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<h2> User Login </h2>
		<form method="post" action="<?php echo base_url()?>index.php/admin/userlogin">
			<?php if(isset($error)) { ?>
				<h6 style="color:red"> <?= $error ?> </h6>
			<?php } ?>
			<div class="form-group">
				<label for="userName">Email</label>
				<input type="text" class="form-control" id="email" placeholder="Enter E-mail" name="email" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
			</div>
			<button type="submit" class="btn btn-primary" name="userlogin" value="user" >Login</button>
		</form>
	</div>
</div>
<div class="col-md-3">
</div>
</body>
