<?php
    include '../dbconnect.php';
    $id_lelang=$_POST['id_lelang'];
    $id_user=$_POST['id_user'];
    $harga_akhir=$_POST['harga_tawaran'];
    $sql=mysqli_query($conn,"SELECT * FROM tb_lelang WHERE id_lelang='$id_lelang'");
    $data = mysqli_fetch_array($sql);
    $id_barang=$data['id_barang'];
    $tgl_lelang=$data['tgl_lelang'];
    $id_petugas=$data['id_petugas'];
    $status=$data['status'];

    echo "$id_lelang | $id_user | $harga_akhir | $id_barang | $tgl_lelang | $id_petugas | $status";
    
    if($harga_akhir<=$data['harga_akhir'])
    {
        echo 
            "<script>
                alert('Harga yang Anda tawar lebih kecil dari penawaran terakhir');
                location.href='index.php';
            </script>";
    }
    else
    {
        $query=mysqli_query($conn,"UPDATE tb_lelang SET id_barang='$id_barang',tgl_lelang='$tgl_lelang',harga_akhir='$harga_akhir',id_user='$id_user',id_petugas='$id_petugas',status='$status' WHERE id_lelang='$id_lelang'");
	
        if($query===TRUE)
        {
            echo 
                "<script>
                    alert('Penawaran Sukses');
                    location.href='index.php';
                </script>";
        }
        else
        {
            echo 
                "<script>
                    alert('Penawaran Gagal');
                </script>";
        }
    }
?>
