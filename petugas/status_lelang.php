<?php
    include '../dbconnect.php';
    $id_lelang=$_GET['id_lelang'];
    $status=$_GET['status'];
    $sql=mysqli_query($conn,"SELECT * FROM tb_lelang WHERE id_lelang='$id_lelang'");
    $data = mysqli_fetch_array($sql);
    $id_barang=$data['id_barang'];
    $tgl_lelang=$data['tgl_lelang'];
    $harga_akhir=$data['harga_akhir'];
    $id_user=$data['id_user'];
    $id_petugas=$data['id_petugas'];
    
	$query=mysqli_query($conn,"UPDATE tb_lelang SET id_barang='$id_barang',tgl_lelang='$tgl_lelang',harga_akhir='$harga_akhir',id_user='$id_user',id_petugas='$id_petugas',status='$status' WHERE id_lelang='$id_lelang'");
	
	if($query===TRUE)
    {
        echo 
            "<script>
                alert('Update Sukses')
                location.href='index.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Update Gagal')
                location.href='index.php';
            </script>";
    }
?>