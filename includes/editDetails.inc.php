<form method='post' action='editDetails.php'>
	<table class='editDetails'>
    <tr>
      <td class='spacer'></td>
    </tr>
		<tr>
			<th width='150'>Location</th>
			<td><input type='text' name='location' value='<?php echo($_member->getLocation()); ?>' /></td>
		</tr>
    <tr> 
      <td class='spacer'></td>
    </tr>
		<tr>
			<th>Email</th>
			<td><input type='text' name='email' value='<?php echo($_member->getEmail()); ?>' /></td>
		</tr>
	  <tr> 
      <td class='spacer'></td>
    </tr>
	  <tr>
			<td></td>
			<td><input type='submit' name='updateDetailsSubmit' value='Update Details' /></td>
		</tr>
	</table>
  <br />
	<h2>Change Password</h2>
  <br />
	<table class='editDetails'>
		<tr>
			<th width='200'>Current Password</th>
			<td><input type='password' name='currentPassword' /></td>
		</tr>
		<tr>
      <td class='spacer'></td>
    </tr>
    <tr>
			<th>New Password</th>
			<td><input type='password' name='newPass' /></td>
		</tr>
    <tr>
      <td class='spacer'></td>
    </tr>
		<tr>
			<th>Confirm Password</th>
			<td><input type='password' name='confirmPass' /></td>
		</tr>
    <tr>
      <td class='spacer'></td>
    </tr>
		<tr>
			<td></td>
			<td><input type='submit' name='changePassword' value='Change Password' /></td>
		</tr>
	</table>
</form>
