<head>
<script>
$('form').on('submit',function(){
   if($('#password').val()!=$('#confirmpassword').val()){
       alert('Password does not matched.');
       return false;
   }
   return true;
});
</script>
</head>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
	<h4>
		Add User form
	</h4>
	<?php echo form_open_multipart('index.php/Users/addUserData');?>
<form method="POST" action="<?php echo base_url();?>index.php/Users/addUserData">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="eg : john" name="name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="userName">User name</label>
      <input type="text" class="form-control" id="userName" placeholder="eg : john123" name="username" required>
    </div>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="mail" placeholder="eg : user@dckap.com" name="email" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
  </div>
  <div class="form-group">
    <label for="password2">Confirm Password</label>
    <input type="password" class="form-control" id="password2" placeholder="Confirm password" name="password2" required>
  </div>
  <div class="form-group">
    <label for="password2">Phone</label>
    <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" required>
  </div>
  <div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" class="form-control" id="dob" name="dob" required>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="city">City</label>
      <input type="text" class="form-control" id="city" placeholder ="eg : Chennai" name="city" required>
    </div>
    <div class="form-group col-md-4">
      <label for="state">State</label>
      <input type="text" class="form-control" id="state"  placeholder ="eg : TamilNadu" name="state" required>
    </div>
    <div class="form-group col-md-4">
      <label for="country">Country</label>
      <input type="text" class="form-control" id="country"  placeholder ="eg : India" name="country" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="profileImage">Profile Picture</label>
      <input type="file" class="form-control" id="picture" name="picture" required>
    </div>
  </div>
  <button type="submit" class="btn btn-primary col-md-4" name="adduser" value="user" >Add User</button><br>
	<div style="color:red">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)){print $error;}?>
	</div>
	<div style="color:green">
		<?php if(isset($success)){print $success;}?>
	</div>
</form>
</div>
</div>
</html>
