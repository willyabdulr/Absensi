<?php
include "../config/koneksi.php";

$tampil = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'"));

if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIM ABSENSI</title>
</head>
<body>
	<h1 align="center">Welcome <a href="?menu=lihat_data" title="<?= $tampil[nama]; ?>"><?= @$tampil[nama]; ?></a></h1>
	<h1 align="center">Sistem Absensi Versi 1.0</h1>

</body>
</html>