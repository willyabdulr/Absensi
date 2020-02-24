<?php 
include '../config/koneksi.php';
include '../library/controller.php';

$go = new oop();
 ?>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>LAPORAN KEHADIRAN DETAIL</title>
 </head>
 <body>
 	<style>
 		.utama{
 			margin: 0 auto;
 			border:thin solid #000;
 			width: 700px;
 		}
 		.print{
 			margin: 0 auto;
 			width: 700px;
 		}
 		a{
 			text-decoration: none;
 		}
 	</style>
 	<div class="print">
 		<a href="#" onclick="document.getElementById('print').style.display='none';window.print();">
 			<img src="../images/print-icon.png" id="print" width="25", height="25" border="0" >
 		</a>
 	</div>
 		<div class="utama">
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top: 10px;">
			<tr>
				<td width="7%" rowspan="3" align="center" valign="top">
					<img src="../images/logo.png" width="55" height="55"></td>
				<td width="93%" valign="top"><strong>&nbsp;LAPORAN KEHADIRAN</strong></td>
			</tr>
			<tr>
				<td valign="top">&nbsp;SMK Wikrama Kota Bogor</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;Ilmu yang Amaliah, Amal yang Ilmiah, Akhlakul Karimah</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td><hr></td>
			</tr>
		</table>
		<table cellspacing="1" align="center" border="1">
			<tr align="center">
				<td rowspan="2">No</td>
				<td rowspan="2" width="100">NIS</td>
				<td rowspan="2" width="150">Nama</td>
				<td rowspan="2" width="100">Rombel</td>
				<td colspan="4">Keterangan</td>
				<td rowspan="2" width="50">Bullan</td>
			</tr>
			<tr align="center">
				<td width="25">H</td>
				<td width="25">S</td>
				<td width="25">I</td>
				<td width="25">A</td>
			</tr>
			<?php 
			$a = $go->tampil($con, "query_absen WHERE nis = '$_GET[nis]'");
			$no = 0;
			if ($a == "") {
				echo "<table><tr><td colspan='9'>NO RECORD</td></tr></table>";
			} else {
				foreach ($a as $r) {
					$no++;
			?>
				<tr align="center">
					<td><?= $no ?></td>
					<td><?= $r['nis'] ?></td>
					<td><?= $r['nama'] ?></td>
					<td><?= $r['rombel'] ?></td>
					<td><?= $r['hadir'] ?></td>
					<td><?= $r['sakit'] ?></td>
					<td><?= $r['ijin'] ?></td>
					<td><?= $r['alpa'] ?></td>
					<td><?= $r['tgl_absen'] ?></td>	
				</tr>
			<?php } } ?>
		</table>
		<br>
 	</div>
 </body>
 <center><p>&copy;<?= date('Y'); ?> SMK WIKRAMA BOGOR</p></center>
 </html>