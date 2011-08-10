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
</form>
