<body>
<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-6">
<h2> Admin Login </h2>
<form method="POST" action="<?php echo base_url()?>index.php/admin/adminlogin">
<?php if(isset($error)) { ?>
   <h6 style="color:red"> <?= $error ?> </h6>
  <?php } ?>
  <div class="form-group">
    <label for="userName">User Name</label>
    <input type="text" class="form-control" id="userName" placeholder="Enter User Name" name="userName">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password"> 
  </div>
  <button type="submit" class="btn btn-primary" name="adminlogin" value="admin">Login</button>
</form>
</div>
</div>
<div class="col-md-3">
</div>
</div>
</body>
</html>