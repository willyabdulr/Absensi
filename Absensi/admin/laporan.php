<?php 
date_default_timezone_set('Asia/Bangkok');

include '../config/koneksi.php';

$go = new oop();

if (!empty($_GET['rombel'])) {
	$isinya = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tbl_rombel WHERE id_rombel='$_GET[rombel]'"));
	$id_rombel = $isinya['id_rombel'];
	$rombel = $isinya['rombel'];
}
 ?>
 <title>Laporan Absensi</title>
 <br>
 <center>
 	<font size="+3">Form Laporan Absensi</font>
 </center>
 <hr>
 <form method="post">
 	<table align="center">
 		<tr>
 		<td>Pilih Rombel</td>
 		<td>:</td>
 		<td>
 			<select name="rombel">
 				<option value="<?= @$id_rombel ?>"><?= @$rombel ?></option>
 				<?php 
 				$a = $go->tampil($con, "tbl_rombel");
 				foreach ($a as $r) { ?>
 					<option value="<?= $r['id_rombel'] ?>"><?= @$r['rombel'] ?></option>
 				<?php } ?>
 			</select>
 			<td></td>
 			<td><input type="submit" name="cetak" value="cetak"></td>
 		</td>
 		</tr>

 	</table>
 	<br>
 	<?php 
 	if (isset($_POST['cetak'])) {
 		echo "<script>document.location.href='laporan_today.php?menu=laporan&rombel=$_POST[rombel]'</script>";
 	}
 	?>
 </form>
 <br>