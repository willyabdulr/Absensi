<?php 
date_default_timezone_set('Asia/Bangkok');

include '../config/koneksi.php';

@$go = new oop();

@$tabel = "tbl_rombel";
@$id = $_GET['id'];
@$query = "query_absen";
@$where = "nis = $_GET[nis]";

if (!empty($_GET['rombel'])) {
	$sql = mysqli_query($con, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'");
	$isinya = mysqli_fetch_array($sql);
}
 ?>
<form method="post">
	<table align="center">
 	<tr>
 		<td>Pilih Rombel</td>
 		<td>:</td>
 		<td>
 			<select name="rombel">
 				<option value="<?= @$isinya['id_rombel'] ?>"></option>
 				<?php 
 				$a = $go->tampil($con, "tbl_rombel");
 				foreach ($a as $r) { ?>
 					<option value="<?= $r['id_rombel'] ?>"><?= $r['rombel'] ?></option>
 				<?php } ?>
 			</select>
 		</td>
 	</tr>
 	<tr>
 		<td>Tanggal Absen</td>
 		<td>:</td>
 		<td>
 			<select name="tgl">
 				<option  value="<?= @$tgl ?>"><?= @$tgl ?></option>
 				<?php 
 				for ($tgl = 1; $tgl <= 31; $tgl++) { 
 					if ($tgl <= 9) { ?>
 						<option value="<?= "0" . $tgl; ?>"><?= "0" . $tgl ?></option>
 					<?php } else { ?>
 						<option value="<?= $tgl; ?>"><?= $tgl; ?></option>
 				 <?php } } ?>
 			</select>
 			<select name="bln">
 					<option value="<?= @$bln; ?>"><?= @$bln; ?></option>
 					<?php 
 					for ($bln = 1; $bln <= 12; $bln++) { 
 						if ($bln <=9) { ?>
 							<option value="<?= "0" . $bln; ?>"><?= "0" . $bln; ?></option>
 						<?php } else { ?>
 							<option value="<?= $bln; ?>"><?= $bln; ?></option>
 					<?php } } ?>
 					?>
 			</select>
 			<select name="thn">
 					<option value="<?= @$thn; ?>"><?= @$thn; ?></option>
 					<?php 
 					for ($thn = 2011; $thn <= date('Y') ; $thn++) { ?>
 						<option value="<?= @$thn; ?>"><?= @$thn; ?></option>
 					<?php } ?>
 			</select>
 		</td>
 	</tr>
 	<td><input type="submit" name="cetak" value="Cetak"></td>
 	</table>
 	<hr>
 	<?php 
 	if (isset($_POST['cetak'])) {
 		echo "<script>document.location.href='?menu=ubahabsen&rombel=$_POST[rombel]&thn=$_POST[thn]&bln=$_POST[bln]&tgl=$_POST[tgl]'</script>";
 	}
 	if (!empty($_GET['rombel'])) { ?>
 		<br>
 	<table border="1" cellspacing="0" align="center">
 		<tr align="center">
 			<td rowspan="2">No</td>
 			<td rowspan="2">Nis</td>
 			<td rowspan="2">Nama</td>
 			<td rowspan="2">Rombel</td>
 			<td colspan="4" align="center">Keterangan</td>
 		</tr>
 		<tr>
			<td>Hadir</td>
			<td>Sakit</td>
			<td>Ijin</td>
			<td>Alpa</td>
		</tr>
		<?php 
		$a = $go->tampil($con, "query_absen WHERE id_rombel = '$_GET[rombel]' and tgl_absen = '$_GET[thn]-$_GET[bln]-$_GET[tgl]'");
		$no = 0;
		if ($a == "") {
			echo "<tr><td align='center' colspan='8'>NO RECORD</td></tr>";
		} else {
			foreach ($a as $r) {
				$no++;
				if ($r['hadir'] == 1) {
					$hadir = "checked";
					$sakit = "";
					$ijin ="";
					$alpa = "";
				}
				if ($r['sakit'] == 1) {
					$hadir = "";
					$sakit = "checked";
					$ijin ="";
					$alpa = "";
				}
				if ($r['ijin'] == 1) {
					$hadir = "";
					$sakit = "";
					$ijin ="checked";
					$alpa = "";
				}
				if ($r['alpa'] == 1) {
					$hadir = "";
					$sakit = "";
					$ijin ="";
					$alpa = "checked";
				}

			?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $r['nis'] ?></td>
				<td><?= $r['nama'] ?></td>
				<td><?= $r['rombel'] ?></td>
				<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="hadir"<?= $hadir ?>></td>
				<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="sakit"<?= $sakit ?>></td>
				<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="ijin"<?= $ijin ?>></td>
				<td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="alpa"<?= $alpa ?>></td>
			</tr>
			<?php } ?>
			<?php 
			$tgl = date('Y-m-d');
			$tabel ="tbl_absen";
			$redirect = '?menu=ubahabsen';
			$where = "nis = $r[nis]";

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
		 if (isset($_REQUEST['ubah'])) {
		 	if ($go->ubah($con,$tabel, $field, $where,$redirect)); {
		 	}
		 }
		?>
		<td colspan="10" align="center"><input type="submit" name="ubah" value="Ubah"></td>
 	</table>
 	<?php } }  ?>
 </form>
 <br>
