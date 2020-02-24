<?php 
include '../config/koneksi.php';
@$go = new oop();

@$tabel = "tbl_rayon";
@$where = "id_rayon = $_GET[id]";
@$redirect = "?menu=rayon";
@$field = array(
	'rayon' => $_POST['rayon']
);
if (isset($_POST['simpan'])) {
	$go->simpan($con, $tabel, $field, $redirect);
}
if (isset($_GET['edit'])) {
	$edit = $go->edit($con, $tabel, $where);
}
if (isset($_POST['ubah'])) {
	$go->ubah($con, $tabel, $field, $where, $redirect);
}
if (isset($_GET['hapus'])) {
	$go->hapus($con, $tabel, $where, $redirect);
}
 ?>
<form method="post">
	<table align="center">
		<tr>
			<td>Rayon</td>
			<td>:</td>
			<td><input type="text" name="rayon" value="<?php echo @$edit['rayon'] ?>" required placeholder="Rayon"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<?php if (@$_GET['id'] == "") { ?>
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
		<td>Rayon</td>
		<td colspan="2">Aksi</td>
	</tr>
	<?php 
	$a = $go->tampil($con, $tabel);
	$no = 0;
	if ($a == "") {
		echo "<tr><td align='center' colspan='4'>NO RECORD</td></tr>";
	} else {
		foreach ($a as $r) {
		$no++
	 ?>
	 <tr>
	 	<td><?php echo $no; ?></td>
	 	<td><?php echo $r['rayon'] ?></td>
	 	<td><a href="?menu=rayon&edit&id=<?php echo $r['id_rayon'] ?>"><img src="../images/d_edit.png"width="30" height="30"></a></td>
	 	<td><a href="?menu=rayon&hapus&id=<?php echo $r['id_rayon'] ?>" onclick="return confirm('Hapus Data ?')"><img src="../images/d_hapus.png"width="30" height="30"></a></td>
	 </tr>
	<?php } } ?>
</table>
<br>