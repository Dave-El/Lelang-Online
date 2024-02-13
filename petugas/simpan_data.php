<?php
    include '../dbconnect.php';
    $nama_barang=$_POST['nama_barang'];
    $tgl=$_POST['tgl'];
    $harga_awal=$_POST['harga_awal'];
    $deskripsi_barang=$_POST['deskripsi_barang'];
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    
    move_uploaded_file($file_tmp, '../db_img/'.$foto);
    $query=mysqli_query($conn,"INSERT INTO tb_barang VALUES('','$nama_barang','$tgl','$harga_awal','$foto','$deskripsi_barang')");
    
    if($query===TRUE)
    {
        echo 
            "<script>
                alert('Penyimpanan Data Sukses')
                location.href='data_barang.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Penyimpanan Data Gagal')
                location.href='data_barang.php';
            </script>";
    }
?>