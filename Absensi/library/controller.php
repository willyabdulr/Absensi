<?php 
class oop
{
	//Untuk Simpan Data
	function simpan($con, $tabel, array $field, $redirect)
	{
		$sql = "INSERT INTO $tabel SET";
		foreach ($field as $key => $value) {
		 	$sql.=" $key = '$value',";
		 }
		 $sql = rtrim($sql,',');
		 $jalan = mysqli_query($con, $sql);
		 if ($jalan) {
		 	echo "<script>alert('data disimpan');document.location.href='$redirect'</script>";
		 }else{
		 	echo "<script>alert('data gagal disimpan');document.location.href='$redirect'</script>";
		 }

	}
	//Untuk Menghapus Data
	function hapus($con, $tabel, $where, $redirect) {
        $sql = "DELETE FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        if ($jalan) {
            echo "<script>alert('Data terhapus...');document.location.href='$redirect'</script>";
        } else {
        }
    }
	//Untuk Edit Data
	function tampil($con, $tabel) {
        $sql = "SELECT * FROM $tabel";
        $tampil = mysqli_query($con, $sql);
        while ($data = mysqli_fetch_assoc($tampil))
            $isi[] = $data;
        return @$isi;
    }
    //Untuk Edit
    function edit($con, $tabel, $where) {
        $sql = "SELECT * FROM $tabel WHERE $where";
        $jalan = mysqli_fetch_assoc(mysqli_query($con, $sql));
        return $jalan;
    }
    //Untuk Update
    function ubah($con, $tabel, array $field, $where, $redirect) {
        $sql = "UPDATE $tabel SET";
        foreach ($field as $key => $value) {
            $sql.=" $key = '$value',";
        }
        $sql = rtrim($sql, ',');
        $sql.=" WHERE $where";
        $jalan = mysqli_query($con, $sql);
        if ($jalan) {
            echo "<script>alert('Data terupdate...');document.location.href='$redirect'</script>";
        } else {
            echo mysqli_error();
        }
    }
    //Untuk Upload
    function upload($con, $foto, $folder) {
        $tmp = $foto['tmp_name'];
        $namafile = $foto['name'];
        move_uploaded_file($tmp, "$folder/$namafile");
        return $namafile;
    }
    //Untuk Login
    function login($con, $table, $username, $password, $redirect) {   
        @session_start();
        $sql = "SELECT * FROM $table WHERE username = '$username' and password = '$password'";
        $jalan = mysqli_query($con, $sql);
        $tampil = mysqli_fetch_assoc($jalan);
        $cek = mysqli_num_rows($jalan); 
        if ($cek > 0) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Selamat datang $username');document.location.href='$redirect'</script>";
		} else {
            echo "<script>alert('Username dan Password tidak sesuai !!');document.location.href='?log=wls'</script>";
        }
    }
}	
 ?>