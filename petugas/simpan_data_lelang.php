<?php
    include '../dbconnect.php';
    $id_barang=$_POST['id_barang'];
    $tgl_lelang=$_POST['tgl_lelang'];
    $harga_akhir=$_POST['harga_akhir'];
    $id_user=$_POST['id_user'];
    $id_petugas=$_POST['id_petugas'];
    $status=$_POST['status'];

    $query=mysqli_query($conn,"INSERT INTO tb_lelang VALUES('','$id_barang','$tgl_lelang','$harga_akhir','1','$id_petugas','ditutup')");
    
    if($query===TRUE)
    {
        echo 
            "<script>
                alert('Penyimpanan Data Sukses')
                location.href='index.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Penyimpanan Data Gagal')
                location.href='index.php';
            </script>";
    }
?>