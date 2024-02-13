<?php
    include '../dbconnect.php';
    session_start();
    $id_user=$_POST['id_user'];
	$nama_lengkap=$_POST['nama_lengkap'];
    $username=$_POST['username'];
    $telp=$_POST['telp'];
    if(empty($_POST['password'])){
        $sqla = "SELECT * FROM tb_masyarakat WHERE id_user='$id_user'";
        $querya = mysqli_query($conn,$sqla);
        $dataa = mysqli_fetch_array($querya);

        $password=$dataa['password'];
    }
    else
    {
        $password=md5($_POST['password']);
    }
	
	$query=mysqli_query($conn,"UPDATE tb_masyarakat SET nama_lengkap='$nama_lengkap',username='$username',password='$password',telp='$telp' WHERE id_user='$id_user'");
	
	if($query===TRUE)
    {
        $sqla = "SELECT * FROM tb_masyarakat WHERE id_user='$id_user'";
        $querya = mysqli_query($conn,$sqla);
        $counta = mysqli_num_rows($querya);
        $dataa = mysqli_fetch_array($querya);

        $_SESSION['username']=$dataa['username'];
        $_SESSION['password']=$dataa['password'];
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