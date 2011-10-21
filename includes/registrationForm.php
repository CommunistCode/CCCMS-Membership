<br />
<p>Please fill in the form below to register at Mantis Market.</p>
<br />
<form action="register.php" name="login" method="post">
	<table class='registrationForm'>
		<tr>
			<th>Username</th>
			<td><input type="text" name="username" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<th>Confirm Password</th>
			<td><input type="password" name="confirmPassword" /></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><input type="text" name="email" /></td>
		</tr>
		<tr>
			<th>Town/City</th>
			<td><input type="text" name="town" /></td>
		</tr>
		<tr>
			<th>Country</th>
			<td><?php include("includes/countryList.inc.php"); ?></td>
		</tr>
		<tr>
			<td></td>
			<td><p><input type='checkbox' name='tandc' />By clicking here you agree to our <a href='includes/termsAndConditions.txt'>terms and conditions</a></p></td>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Register" /></td>
		</tr>
	</table>
	<br />
</form>

