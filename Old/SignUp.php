<html>
<head>
<title>Sign Up | My Stand</title>
<style>
</style>
</head>
<body>
<form action="Register.php" method="post">
<table align="center" border="12">
<tr>
<td>Name</td>
<td><input type="text" maxlength="20" id="UserName" name="username"></td>
</tr>
<tr>
<td>Email ID</td>
<td><input type="text" maxlength="30" id="UserEmail" name="useremail"></td>
</tr>
<tr>
<td>Date Of Birth</td>
<td><input type="date" id="UserDOB" name="userdob"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" maxlength="16" id="UserPassword" name="userpass"></td>
</tr>
<tr>
<td>Gender</td>
<td><input type="radio" value="male" name="usergender" checked>Male
<input type="radio" value="female" name="usergender" >Female</td>
</tr>
<td>Phone Number</td>
<td><input type="number"  name="userphone"></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" value="Register"></td>
</tr>
</table>
</form>
</body>
</html>