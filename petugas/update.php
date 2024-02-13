<?php
    include '../dbconnect.php';
    $id_barang=$_POST['id_barang'];
	$nama_barang=$_POST['nama_barang'];
	$tgl=$_POST['tgl'];
    $harga_awal=$_POST['harga_awal'];
    $deskripsi_barang=$_POST['deskripsi_barang'];
    if(empty($_FILES['foto']['name'])){
        $sqla = "SELECT * FROM tb_barang WHERE id_barang='$id_barang'";
        $querya = mysqli_query($conn,$sqla);
        $dataa = mysqli_fetch_array($querya);

        $foto=$dataa['foto'];
    }
    else
    {
        $foto = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($file_tmp, '../db_img/'.$foto);
    }
    
    
	$query=mysqli_query($conn,"UPDATE tb_barang SET nama_barang='$nama_barang',tgl='$tgl',harga_awal='$harga_awal',foto='$foto',deskripsi_barang='$deskripsi_barang' WHERE id_barang='$id_barang'");
	
	if($query===TRUE)
    {
        echo 
            "<script>
                alert('Update Sukses')
                location.href='data_barang.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Update Gagal')
                location.href='data_barang.php';
            </script>";
    }
?>