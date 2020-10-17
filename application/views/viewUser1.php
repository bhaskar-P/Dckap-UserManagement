<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h4>User Information</h4>
		<table class="table">
			<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Details</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>Name</td>
				<td><?= $data['name'] ?></td>
			</tr>
			<tr>
				<td>UserName</td>
				<td><?= $data['username'] ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?= $data['email'] ?></td>
			</tr>
			<tr>
				<td>Profile Picture</td>
				<td><img src="<?php echo base_url() ?>assets/images/profile/<?= $data['image'] ?>" height="150" width="150"></td>
			</tr>
			<tr>
				<td>Mobile Number</td>
				<td><?= $data['phone'] ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?= $data['address'] ?></td>
			</tr>
			<tr>
				<td>City</td>
				<td><?= $data['city'] ?></td>
			</tr>
			<tr>
				<td>State</td>
				<td><?= $data['state'] ?></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><?= $data['country'] ?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><?php echo ($data['status'] == 1) ? 'Active' : 'In-active'; ?></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
