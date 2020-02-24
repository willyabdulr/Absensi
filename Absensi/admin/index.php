<?php 
session_start();
include '../config/koneksi.php';
include '../library/controller.php';
$go = new oop();
@$tabel = "tbl_user";

@$username = $_POST['user'];
@$password = md5($_POST['pass']);

@$redirect = "hal_admin.php?menu=home";
if (isset($_POST['login'])) {
	$go->login($con, $tabel, $username, $password, $redirect);
}
if (isset($_POST['batal'])) {
	echo "<script>document.location.href='../'</script>";
}
 ?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<form method="post">
	<table>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="user"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="pass"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<input type="submit" name="login" value="LOGIN">
				<input type="submit" name="batal" value="BATAL">
			</td>
		</tr>
	</table>
</form>
</html>