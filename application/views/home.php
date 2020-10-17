<body>
<div id="wrapper">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-9">
			<h4>Welcome to Admin Page.</h4>
			<div>
				<a href="<?php echo  base_url() ?>index.php/Users/addUser">
					<button type='button' class='btn btn-success'>Add User</button>
				</a>
			</div>
			<div class="row">
				<h3>Search Users</h3>
				<form method="post" action="<?php echo base_url() ?>index.php/admin/search">
					<div class="form-row">
						<div class="form-group col-md-4">
							<input type="text" class="form-control" id="username" name="username"  placeholder="User Name">
						</div>
						<div class="form-group col-md-4">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email">
						</div>
					<div class="form-group col-md-4">
						<input type="text" class="form-control" id="phone" placeholder="Mobile number">
					</div>
					<div class="form-group col-md-6">
						<label for="date">DOB</label>
						<input type="date" class="form-control" id="dob" name="dob">
					</div>
						<div class="form-group col-md-6">
							<label for="date">Created Date</label>
							<input type="date" class="form-control" id="date" name="date">
						</div>
						<button type="submit" class="btn btn-primary" name="search" value="search">Search</button>
					</div>
				</form>
			</div>
			<h3>All users</h3>
			<div class="table-responsive table-bordered">
				<table class="table">
					<tr>
						<th>#</th>
						<th>UserName</th>
						<th>Email ID</th>
						<th>Mobile</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>`
					<?php if (count($users)): ?>
					<?php $i = 0 ;foreach ($users as $row): ?>
					<tr>
						<td><?php echo ++$i; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->email; ?></td>
						<td><?php echo $row->phone; ?></td>
						<td><?php echo $row->status; ?></td>
						<td>
							<?php $id = $row->id ?>
							<a href="<?php echo  base_url() ?>index.php/admin/userUpdate/<?= $id ?>">
								<button type='button' class='btn btn-primary'>Update</button>
							</a>
							<a href="<?php echo  base_url() ?>index.php/admin/UserDelete/<?= $id ?>">
								<button type='button' class='btn btn-danger'>Delete</button>
							</a>
							<a href="<?php echo  base_url() ?>index.php/admin/UserView/<?= $id ?>">
								<button type='button' class='btn btn-success'>View</button>
							</a>
						</td>
						<?php endforeach; ?>
						<?php else: ?>
							<p style="margin: 20px;">No users registered</p>
						<?php endif ?>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- JavaScript -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
