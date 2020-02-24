<?php 
include '../config/koneksi.php';

@$go = new oop();

@$tabel = "tbl_rombel";
@$where = "id_rombel = $_GET[id]";
@$redirect = "?menu=rombel";
@$field = array(
	'rombel' => $_POST['rombel']
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
			<td>Rombel</td>
			<td>:</td>
			<td><input type="text" name="rombel" value="<?php echo @$edit['rombel'] ?>" required placeholder="Rombel"></td>
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
		<td>Rombel</td>
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
	 	<td><?= $no ?></td>
	 	<td><?= $r['rombel'] ?></td>
	 	<td><a href="?menu=rombel&edit&id=<?php echo $r['id_rombel'] ?>"><img src="../images/d_edit.png"width="30" height="30"></a></td>
	 	<td><a href="?menu=rombel&hapus&id=<?php echo $r['id_rombel'] ?>" onclick="return confirm('Hapus Data ?')"><img src="../images/d_hapus.png"width="30" height="30"></a></td>
	 </tr>
	<?php } } ?>
</table>
<br>
