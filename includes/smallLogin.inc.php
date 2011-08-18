<form action="<?php echo($directoryPath); ?>/membership/login.php" name="login"  method="post">
<table>
	<tr>
		<td align='right'><strong>Username</strong></td>
		<td><input type="text" name="username" class="text" /></td>
	</tr>
	<tr>
		<td align='right'><strong>Password</strong></td>
		<td><input type="password" name="password" class="text" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="button" name="submit" value="Login" /><strong> or <a href='<?php echo($directoryPath); ?>/membership/register.php'>Register</a></strong></td>
	</tr>
</table>
<br />
</form>
