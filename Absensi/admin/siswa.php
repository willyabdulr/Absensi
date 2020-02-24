<?php 
include '../config/koneksi.php';

@$go = new oop();

@$tabel = "tbl_siswa";
@$query = "query_siswa";
@$where = "nis = $_GET[id]";
@$redirect = "?menu=siswa";
@$tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
@$folder = "../foto";
if (isset($_POST['simpan'])) {
	@$foto = $_FILES['foto'];
	$upload = $go->upload($con, $foto, $folder);
	$field = array(
		'nis' => $_POST['nis'],
		'nama' => $_POST['nama'],
		'jk' => $_POST['jk'],
		'id_rayon' => $_POST['rayon'],
		'id_rombel' => $_POST['rombel'],
		'foto' => $upload,
		'tgl_lahir' => $tanggal
	);

	$go->simpan($con, $tabel, $field, $redirect);
}

if (isset($_GET['hapus'])) {
	$go->hapus($con, $tabel, $where, $redirect);
}

if (isset($_GET['edit'])) {
	$edit = $go->edit($con, $query, $where);
	if ($edit['jk'] == "L") {
		$l = "checked";
	}else{
		$p = "checked";
	}
	$date = explode("-", $edit['tgl_lahir']);
	$thn = $date[0];
	@$bln = $date[1];
	@$tgl = $date[2];
}

if (isset($_POST['ubah'])) {
	$foto = $_FILES['foto'];
	$upload = $go->upload($con, $foto ,$folder);
	if (empty($_FILES['foto']['name'])) {
		$field = array(
		'nis' => $_POST['nis'],
		'nama' => $_POST['nama'],
		'jk' => $_POST['jk'],
		'id_rayon' => $_POST['rayon'],
		'id_rombel' => $_POST['rombel'],
		'tgl_lahir' => $tanggal
	);

		$go->ubah($con,$tabel, $field, $where, $redirect);

	}else{
		$field = array(
		'nis' => $_POST['nis'],
		'nama' => $_POST['nama'],
		'jk' => $_POST['jk'],
		'id_rayon' => $_POST['rayon'],
		'id_rombel' => $_POST['rombel'],
		'foto' => $upload,
		'tgl_lahir' => $tanggal
	);

		$go->ubah($con,$tabel, $field, $where, $redirect);

	}
}
 ?>

 <form method="post" enctype="multipart/form-data">
 	<table align="center">
 		<tr>
 			<td>NIS</td>
 			<td>:</td>
 			<td><input type="text" name="nis" value="<?= @$edit['nis'] ?>" required></td>
 		</tr>
 		<tr>
 			<td>Nama</td>
 			<td>:</td>
 			<td><input type="text" name="nama" value="<?= @$edit['nama'] ?>" required></td>
 		</tr>
 		<tr>
 			<td>Jenis Kelamin</td>
 			<td>:</td>
 			<td>
 				<input type="radio" name="jk" required value="L" <?= @$l ?> />Laki-laki
 				<input type="radio" name="jk" required value="P" <?= @$p ?> />Perempuan
 			</td>
 		</tr>
 		<tr>
 			<td>Rayon</td>
 			<td>:</td>
 			<td>
 				<select name="rayon" required>
 					<option value="<?= @$edit['id_rayon'] ?>"><?= @$edit['rayon'] ?></option>
 					<?php 
 					$a = $go->tampil($con, "tbl_rayon");
 					foreach ($a as $r) { ?>
 						<option value="<?= $r['id_rayon'] ?>"><?= @$r['rayon'] ?></option>
 					<?php } ?>
 				</select>
 			</td>
 		</tr>
 		<tr>
 			<td>Rombel</td>
 			<td>:</td>
 			<td>
 				<select name="rombel" required>
 					<option value="<?php echo @$edit['id_rombel'] ?>"><?= @$edit['rombel'] ?></option>
 					<?php 
 					$a = $go->tampil($con, "tbl_rombel");
 					foreach ($a as $r) { ?>
 						<option value="<?php echo $r['id_rombel'] ?>"><?= @$r['rombel'] ?></option>
 					<?php } ?>
 				</select>
 			</td>
 		</tr>
 		<tr>
 			<td>Foto</td>
 			<td>:</td>
 			<td><input type="file" name="foto"></td>
 		</tr>
 		<tr>
 			<td>Tanggal Lahir</td>
 			<td>:</td>
 			<td>
 				<select name="tgl" required>
 					<option value="<?= @$tgl ?>"><?= @$tgl ?></option>
 					<?php 
 					for ($tgl= 1; $tgl <= 31 ; $tgl++) { 
 						if ($tgl <=9 ) { ?>
 							<option value="<?= "0" . $tgl; ?>"><?= "0" . $tgl; ?></option>
 						<?php } else { ?>
 							<option value="<?= $tgl; ?>"><?= $tgl; ?></option>
 					<?php } } ?>
 					 ?>
 				</select>
 				<select name="bln" required>
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
 				<select name="thn" required>
 					<option value="<?= @$thn; ?>"><?= @$thn; ?></option>
 					<?php 
 					for ($thn = 1996; $thn <= 2001 ; $thn++) { ?>
 						<option value="<?= @$thn; ?>"><?= @$thn; ?></option>
 					<?php } ?>
 				</select>
 			</td>
 		</tr>
 		<tr>
 			<td></td>
 			<td></td>
 			<td>
 				<?php if (@$_GET['id'] =="" ) { ?>
 					<input type="submit" name="simpan" value="Simpan">
 				<?php } else { ?>
 					<input type="submit" name="ubah" value="Ubah">
 				<?php } ?>
 			</td>
 		</tr>
 	</table>
 </form>
 <br>
 <table align="center" border="1">
 	<tr>
 		<td>No</td>
 		<td>Nis</td>
 		<td>Nama</td>
 		<td>Jk</td>
 		<td>Rayon</td>
 		<td>Rombel</td>
 		<td>Foto</td>
 		<td>Tanggal</td>
 		<td colspan="2">Aksi</td>
 	</tr>
 	<?php 
 	$a = $go->tampil($con, "query_siswa");
 	$no = 0;
 	if ($a == "") {
 		echo "<tr><td align='center' colspan='10'>NO RECORD</td></tr>";
 	}else{
 		foreach ($a as $r) {
 		$no++;
 	 ?>
 	 <tr>
 	 	<td><?= $no ?></td>
 	 	<td><?= $r['nis'] ?></td>
 	 	<td><?= $r['nama'] ?></td>
 	 	<td><?= $r['jk'] ?></td>
 	 	<td><?= $r['rayon'] ?></td>
 	 	<td><?= $r['rombel'] ?></td>
 	 	<td><img src="../foto/<?= $r['foto'] ?>" width="50" height="50"/></td>
 	 	<td><?= $r['tgl_lahir'] ?></td>
 	 	<td><a href="?menu=siswa&hapus&id=<?php echo $r['nis'] ?>" onclick="return confirm('Hapus Data ?')"><img src="../images/d_hapus.png " width="30" height="30"></a></td>
 	 	<td><a href="?menu=siswa&edit&id=<?php echo $r['nis'] ?>"><img src="../images/d_edit.png" width="30" height="30"></a></td>
 	 </tr>
 	<?php } } ?>
 </table>
 <br>