<?php
	include '../dbconnect.php';
	$id_petugas=$_GET['id_petugas'];

	$query=mysqli_query($conn,"DELETE FROM tb_petugas WHERE id_petugas='$id_petugas'");
	
	if($query===TRUE)
    {
        echo 
            "<script>
                alert('Delete Sukses')
                location.href='data_petugas.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Delete Gagal')
                location.href='data_petugas.php';
            </script>";
    }
?>