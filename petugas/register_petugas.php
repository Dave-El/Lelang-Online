<?php
    include '../dbconnect.php';
    $nama_petugas=$_POST['nama_petugas'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    
    $query=mysqli_query($conn,"INSERT INTO tb_petugas VALUES('','$nama_petugas','$username','$password','2')");
    
    if($query===TRUE)
    {
        echo 
            "<script>
                alert('Register Sukses')
                location.href='data_petugas.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Register Gagal')
                location.href='data_petugas.php';
            </script>";
    }
?>