<?php
	include '../dbconnect.php';
    $id_barang=$_GET['id_barang'];
    
	$query=mysqli_query($conn,"DELETE FROM tb_barang WHERE id_barang='$id_barang'");
	
	if($query===TRUE)
    {
        echo 
            "<script>
                alert('Delete Sukses')
                location.href='data_barang.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Delete Gagal')
                location.href='data_barang.php';
            </script>";
    }
?>