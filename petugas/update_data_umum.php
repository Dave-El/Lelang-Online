<?php
    include '../dbconnect.php';
    session_start();
    $id_petugas=$_POST['id_petugas'];
	$nama_petugas=$_POST['nama_petugas'];
	$username=$_POST['username'];
    $id_level=$_POST['id_level'];
    if(empty($_POST['password'])){
        $sqla = "SELECT * FROM tb_petugas WHERE id_petugas='$id_petugas'";
        $querya = mysqli_query($conn,$sqla);
        $dataa = mysqli_fetch_array($querya);

        $password=$dataa['password'];
    }
    else
    {
        $password=md5($_POST['password']);
    }
	
	$query=mysqli_query($conn,"UPDATE tb_petugas SET nama_petugas='$nama_petugas',username='$username',password='$password',id_level='$id_level' WHERE id_petugas='$id_petugas'");
	
	if($query===TRUE)
    {
        $sqla = "SELECT * FROM tb_petugas WHERE id_petugas='$id_petugas'";
        $querya = mysqli_query($conn,$sqla);
        $counta = mysqli_num_rows($querya);
        $dataa = mysqli_fetch_array($querya);

        $_SESSION['username']=$dataa['username'];
        $_SESSION['password']=$dataa['password'];
        $_SESSION['id_level']=$dataa['id_level'];
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