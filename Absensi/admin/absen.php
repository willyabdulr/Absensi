<?php 
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php';

@$go = new oop();

if (!empty($_GET['rombel'])) {
	$isinya = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tbl_rombel WHERE id_rombel='$_GET[rombel]'"));
	$id_rombel = $isinya['id_rombel'];
	$rombel = $isinya['rombel'];
}
?>
 <form method="post">
 	<tr>
 		<td>Pilih Rombel</td>
 		<td>:</td>
 		<td>
 			<select name="rombel">
 				<option value="<?= @$id_rombel ?>"><?= @$rombel ?></option>
 				<?php 
 				$a = $go->tampil($con, "tbl_rombel");
 				foreach ($a as $r) { ?>
 					<option value="<?= @$r['id_rombel'] ?>"><?= @$r['rombel'] ?></option>
 				<?php } ?>
 			</select>
 			<td></td>
 			<td><input type="submit" name="cetak" value="cetak"></td>
 		</td>
 	</tr>
 	<hr>
 <?php 
if (isset($_POST['cetak'])) {
	echo "<script>document.location.href='?menu=absen&rombel=$_POST[rombel]'</script>";
}
if (!empty($_GET['rombel'])) {
	$tgl_sekarang = date('Y-m-d');
	$sql = mysqli_query($con, "SELECT * FROM query_absen WHERE id_rombel = '$_GET[rombel]' and tgl_absen = '$tgl_sekarang'");
	@$cek = mysqli_fetch_array($sql);
	if (@$cek ['tgl_absen'] == @$tgl_sekarang and @$cek['id_rombel'] == @$_GET['rombel']) {
		echo "<script>alert('Rombel $rombel sudah di absen hari ini');document.location.href='?menu=absen'</script>";
	} else { ?>
	<br>
	<table border="1" align="center">
		<tr>
			<td rowspan="2">No</td>
			<td rowspan="2">Nis</td>
			<td rowspan="2">Nama</td>
			<td rowspan="2">Rombel</td>
			<td colspan="4" align="center">Keterangan</td>
		</tr>
		<tr>
			<td>Hadir</td>
			<td>Sakit</td>
			<td>Izin</td>
			<td>Alpa</td>
		</tr>
		<?php 
		$no = 0;
		$sql = "SELECT * FROM query_siswa WHERE id_rombel = '$_GET[rombel]'";
		$query = mysqli_query($con, $sql);
		$cek = mysqli_num_rows($query);
		if ($cek == "") {
			echo "<tr><td align='center' colspan='8'>NO RECORD</td></tr>";
		} else {
			while ($r = mysqli_fetch_array($query)) {
				$no++
		 ?>
		 <tr>
		 	<td><?= $no ?></td>
		 	<td><?= $r['nis'] ?></td>
		 	<td><?= $r['nama'] ?></td>
		 	<td><?= $r['rombel'] ?></td>
		 	<td><input type="radio" checked="checked" name="keterangan<?= $r['nis'] ?>" value="hadir"></td>
		 	<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="sakit"></td>
		 	<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="ijin"></td>
		 	<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="alpa"></td>
		 </tr>
		 <?php 
		 $tgl = date('Y-m-d');
		 $tabel = 'tbl_absen';
		 $redirect = '?menu=absen';

		 if (@$_POST['keterangan' . $r['nis']] == 'hadir') {
		 	$field = array(
		 		'nis' => $r['nis'],
		 		'hadir' => '1',
		 		'sakit' => '0',
		 		'ijin' => '0',
		 		'alpa' => '0',
		 		'tgl_absen' => $tgl
		 	);
		 } elseif (@$_POST['keterangan' . $r['nis']] == 'sakit') {
		 	$field = array(
		 		'nis' => $r['nis'],
		 		'hadir' => '0',
		 		'sakit' => '1',
		 		'ijin' => '0',
		 		'alpa' => '0',
		 		'tgl_absen' => $tgl
		 	);	
		 } elseif (@$_POST['keterangan' . $r['nis']] == 'ijin') {
		 	$field = array(
		 		'nis' => $r['nis'],
		 		'hadir' => '0',
		 		'sakit' => '0',
		 		'ijin' => '1',
		 		'alpa' => '0',
		 		'tgl_absen' => $tgl
		 	);
		 } else {
		 	$field = array(
		 		'nis' => $r['nis'],
		 		'hadir' => '0',
		 		'sakit' => '0',
		 		'ijin' => '0',
		 		'alpa' => '1',
		 		'tgl_absen' => $tgl
		 	);
		 }	
		 if (isset($_REQUEST['simpan'])) {
		 	if ($go->simpan($con, $tabel, $field, $redirect)) {
		 	}
		 }
		}
		  ?>
		  <tr>
		  	<td colspan="10" align="center"><input type="submit" name="simpan" value="Simpan"></td>
		  </tr>
	</table>
	<?php } } } ?>
</form>
<br>