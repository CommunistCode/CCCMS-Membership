<form method='post' action='editDetails.php'>
	<table>
		<tr>
			<td width='150'>Location</td>
			<td><input type='text' name='location' value='<?php echo($member->getLocation()); ?>' /></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' value='<?php echo($member->getEmail()); ?>' /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' name='updateDetailsSubmit' value='Update Details' /></td>
		</tr>
	</table>

	<h2>Change Password</h2>

	<table>
		<tr>
			<td width='200'>Current Password</td>
			<td><input type='text' name='currentPassword' /></td>
		</tr>
		<tr>
			<td>New Password</td>
			<td><input type='text' name='newPass' /></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type='text' name='confirmPass' /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' name='changePassword' value='Change Password' /></td>
		</tr>
	</table>
</form>
