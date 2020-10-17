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
				<td><?= $detail->name ?></td>
			</tr>
			<tr>
				<td>UserName</td>
				<td><?= $detail->username ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?= $detail->email ?></td>
			</tr>
			<tr>
				<td>Profile Picture</td>
				<td><img src="<?php echo base_url() ?>assets/images/profile/<?= $detail->image ?>" height="150" width="150"></td>
			</tr>
			<tr>
				<td>Mobile Number</td>
				<td><?= $detail->phone ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?= $detail->address ?></td>
			</tr>
			<tr>
				<td>City</td>
				<td><?= $detail->city ?></td>
			</tr>
			<tr>
				<td>State</td>
				<td><?= $detail->state ?></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><?= $detail->country ?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><?php echo ($detail->status == 1) ? 'Active' : 'In-active'; ?></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
